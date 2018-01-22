<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Room;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Room controller.
 *
 * @Route("/room")
 */
class RoomController extends Controller
{
    /**
     * Liste des rooms en fonction de l'id de l'utilisateur.
     *
     * @Route("/", name="workshop_room_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $id = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $rooms = $em->getRepository('AppBundle:Room')->findAllRoom($id);
        var_dump($rooms);
        
        return $this->render('room/index.html.twig', array(
            'rooms' => $rooms,
        ));
    }


    /**
     * Affiche les details d'une salle.
     *
     * @Route("/{id}", name="workshop_room_show")
     * @Method("GET")
     */
    public function showAction(Room $room)
    {
        
        if ($this->checkUserLegacy($room)) {

            $deleteForm = $this->createDeleteForm($room);

            return $this->render('room/show.html.twig', array(
                'room' => $room,
                'delete_form' => $deleteForm->createView(),
            ));
        }else {
            return new Response('accès refusé');
        }

    }

    /**
     * Edite une salle.
     *
     * @Route("/{id}/edit", name="workshop_room_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Room $room)
    {
        if ($this->checkUserLegacy($room)) {

            $deleteForm = $this->createDeleteForm($room);
            $editForm = $this->createForm('AppBundle\Form\RoomEditType', $room);
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('workshop_room_edit', array('id' => $room->getId()));
            }

            return $this->render('room/edit.html.twig', array(
                'room' => $room,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
        } else {
            return new Response('accès refusé');
        }
    }

    /**
     * Deletes a room entity.
     *
     * @Route("/{id}", name="workshop_room_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Room $room)
    {
        $form = $this->createDeleteForm($room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($room);
            $em->flush();
        }

        return $this->redirectToRoute('workshop_room_index');
    }

    /**
     * Creates a form to delete a room entity.
     *
     * @param Room $room The room entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Room $room)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('workshop_room_delete', array('id' => $room->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }





    public function checkUserLegacy(Room $room)
    {
        
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("AppBundle:Event")->findOneByRooOid($room);
        $workshop = $event->getWorOid();
        if ($workshop->getUsrOid() === $this->getUser()) {
            return true;
        }else {
            return false;
        }

    }

}
