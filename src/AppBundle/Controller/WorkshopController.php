<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Workshop;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Workshop controller.
 *
 * @Route("workshop")
 */
class WorkshopController extends Controller
{
    /**
     * Choix de l'action à mener
     *
     * @Route("/", name="workshop_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        //indexAction terminer
        return $this->render("workshop/index.html.twig");
    }
    //function de la liste des atelier, argument archive vrai ou faux
    public function workshopList(bool $archive)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        return $workshops = $em->getRepository('AppBundle:Workshop')->findBy(array("usrOid" => $user->getId(), "isArchived" => $archive));
    }
    /**
     * Liste les ateliers de l'utilisateur non archivés.
     *
     * @Route("/list", name="workshop_list")
     * @Method("GET")
     */
    public function listAction()
    {
        $workshops = $this->workshopList(false);
        return $this->render('workshop/list.html.twig', array(
            'workshops' => $workshops,
            'archive' => false,
        ));
    }
    /**
     * Liste les ateliers de l'utilisateur archivés.
     *
     * @Route("/archived_list", name="workshop_archived_list")
     * @Method("GET")
     */
    public function archivedListAction()
    {
        $workshops = $this->workshopList(true);
        return $this->render('workshop/list.html.twig', array(
            'workshops' => $workshops,
            'archive' => true,
        ));
    }
    /**
     * Création d'un atelier
     *
     * @Route("/new", name="workshop_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $user = $this->getUser();
        $workshop = new Workshop();
        $workshop->setUsrOid($user);
        $workshop->setIsArchived(false);
        

        $form = $this->createForm('AppBundle\Form\WorkshopType', $workshop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($workshop);
            $em->flush();

            return $this->redirectToRoute('workshop_show', array('id' => $workshop->getId()));
        }

        return $this->render('workshop/new.html.twig', array(
            'workshop' => $workshop,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a workshop entity.
     *
     * @Route("/{id}", name="workshop_show")
     * @Method("GET")
     */
    public function showAction(Workshop $workshop)
    {
        $deleteForm = $this->createDeleteForm($workshop);
        return $this->render('workshop/show.html.twig', array(
            'workshop' => $workshop,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing workshop entity.
     *
     * @Route("/{id}/edit", name="workshop_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Workshop $workshop)
    {
        $deleteForm = $this->createDeleteForm($workshop);
        $editForm = $this->createForm('AppBundle\Form\WorkshopType', $workshop);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('workshop_edit', array('id' => $workshop->getId()));
        }

        return $this->render('workshop/edit.html.twig', array(
            'workshop' => $workshop,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a workshop entity.
     *
     * @Route("/{id}", name="workshop_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Workshop $workshop)
    {
        $form = $this->createDeleteForm($workshop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($workshop);
            $em->flush();
        }

        return $this->redirectToRoute('workshop_index');
    }

    /**
     * Creates a form to delete a workshop entity.
     *
     * @param Workshop $workshop The workshop entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Workshop $workshop)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('workshop_delete', array('id' => $workshop->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
