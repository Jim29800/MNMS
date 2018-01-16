<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use AppBundle\Entity\User;
use AppBundle\Entity\Room;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\EventType;
use Doctrine\ORM\EntityRepository;



/**
 * Event controller.
 *
 * @Route("workshop/event")
 */
class EventController extends Controller
{


    //Creation d'un evenement avec redirection pout ajout de salle : workshop_event_select
    /**
     * Creates a new event entity.
     *
     * @Route("/{id}/new", name="workshop_event_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $event = new Event();
        $workshop = $em->getRepository("AppBundle:Workshop")->findOneById($id);
        $event->setWorOid($workshop);
        $event->setIsOver(false)
            ->setIsReturned(false);
        $form = $this->createForm('AppBundle\Form\EventType', $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('workshop_event_select', array('id' => $event->getId()));
        }

        return $this->render('event/new.html.twig', array(
            'event' => $event,
            'form' => $form->createView(),
        ));
    }
    /**
     * workshop_event_select : selecteur des rooms lier à l'utilisateur
     *
     * @Route("/{id}/room/select", name="workshop_event_select")
     * @Method({"GET", "POST"})
     */
    public function selectAction(Request $request, Event $event)
    {

        //$data = $request->getContent();
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $form = $this->createForm('AppBundle\Form\EventSelectType', $event, ["user" => $user]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('workshop_event_contributor', array('id' => $event->getId()));
        }

        return $this->render('event/select.html.twig', array(
            'event' => $event,
            'form' => $form->createView(),

        ));
    }


    /**
     * workshop_event_room_new : selecteur des rooms lier à l'utilisateur
     *
     * @Route("/{id}/room/new", name="workshop_event_room_new")
     * @Method({"GET", "POST"})
     */
    public function roomNewAction(Request $request, Event $event)
    {
        $room = new Room();
        $form = $this->createForm('AppBundle\Form\RoomType', $room);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $form = $this->createForm('AppBundle\Form\RoomType', $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //room
            $em = $this->getDoctrine()->getManager();
            $em->persist($room);
            $em->flush();
            //event


            $last_room = $this->getDoctrine()->getRepository(Room::class)->findLastRoom();
            $event->setRooOid($last_room);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('workshop_event_contributor', array('id' => $event->getId()));
        }

        return $this->render('room/new.html.twig', array(
            'form' => $form->createView(),
            'room' => $room,
            'id' => $event->getId(),
        ));
    }
















































    /**
     * Lists all event entities.
     *
     * @Route("/", name="workshop_event_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('AppBundle:Event')->findAll();

        return $this->render('event/index.html.twig', array(
            'events' => $events,
        ));
    }
    /**
     * Finds and displays a event entity.
     *
     * @Route("/{id}", name="workshop_event_show")
     * @Method("GET")
     */
    public function showAction(Event $event)
    {
        $deleteForm = $this->createDeleteForm($event);

        return $this->render('event/show.html.twig', array(
            'event' => $event,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing event entity.
     *
     * @Route("/{id}/edit", name="workshop_event_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Event $event)
    {
        $deleteForm = $this->createDeleteForm($event);
        $editForm = $this->createForm('AppBundle\Form\EventType', $event);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('workshop_event_edit', array('id' => $event->getId()));
        }

        return $this->render('event/edit.html.twig', array(
            'event' => $event,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a event entity.
     *
     * @Route("/{id}", name="workshop_event_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Event $event)
    {
        $form = $this->createDeleteForm($event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($event);
            $em->flush();
        }

        return $this->redirectToRoute('workshop_event_index');
    }

    /**
     * Creates a form to delete a event entity.
     *
     * @param Event $event The event entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Event $event)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('workshop_event_delete', array('id' => $event->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
