<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Workshop;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Workshop controller.
 *
 * @Route("workshop")
 */
class WorkshopController extends Controller
{
    /**
     * Lists all workshop entities.
     *
     * @Route("/", name="workshop_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $workshops = $em->getRepository('AppBundle:Workshop')->findAll();

        return $this->render('workshop/index.html.twig', array(
            'workshops' => $workshops,
        ));
    }

    /**
     * Creates a new workshop entity.
     *
     * @Route("/new", name="workshop_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $workshop = new Workshop();
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
