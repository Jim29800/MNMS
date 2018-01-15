<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EventContributor;
use AppBundle\Entity\Event;
use AppBundle\Entity\Contributor;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\EventContributorSelectType;


/**
 * Eventcontributor controller.
 *
 * @Route("workshop/contributor")
 */
class EventContributorController extends Controller
{



    /**
     * workshop_event_contributor : selecteur des contributor lier à l'utilisateur
     *
     * @Route("/event/{id}/select", name="workshop_event_contributor")
     * @Method({"GET", "POST"})
     */
    public function selectContribtorAction(Request $request,$id)
    {
        $eventContributor = new Eventcontributor();
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $event = $em->getRepository('AppBundle:Event')->findOneById($id);

        $form = $this->createForm('AppBundle\Form\EventContributorSelectType', $eventContributor, ["user" => $user]);
        $form->handleRequest($request);
        
        $contributorList = $em->getRepository("AppBundle:EventContributor")->findByEveOid($event);
        
        $contributor = new Contributor;
        $form2 =$this->createForm("AppBundle\Form\ContributorType", $contributor);
        $form2->handleRequest($request);


        
        if ($form->isSubmitted() && $form->isValid()) {

            $eventContributor->setEveOid($event);

            $em->persist($eventContributor);
            $em->flush();


            return $this->redirectToRoute('workshop_event_contributor', array('id' => $id));
        }


        if ($form2->isSubmitted() && $form2->isValid()) {

            $contributor->setIsMnms(0);

            $eventContributor->setEveOid($event);            
            $eventContributor->setConOid($contributor);
            $eventContributor->setNeededNumber(1);


            $em->persist($contributor);
            $em->persist($eventContributor);            
            $em->flush();

            return $this->redirectToRoute('workshop_event_contributor', array('id' => $id));
        }

        return $this->render('event/select_contributor.html.twig', array(
            'eventContributor' => $eventContributor,
            'event' => $id,         
            'form' => $form->createView(),
            'form2' => $form2->createView(),
            'contributorList' => $contributorList,
        ));
    }

    /**
     * workshop_event_delete_contributor : suppression du contributor lier à l'utilisateur
     *
     * @Route("/event/{id}/delete", name="workshop_event_delete_contributor")
     * @Method({"GET", "POST"})
     */
    public function deleteContributorAction(Request $request, EventContributor $eventContributor, $id)
    {



            $em = $this->getDoctrine()->getManager();
            $eventContributor = $em->getRepository('AppBundle:EventContributor')->findOneById($id);
            $idEvent = $eventContributor->getEveOid()->getId();
            $idContributor = $eventContributor->getConOid();

            $em->remove($eventContributor);
            $em->flush();

            $contributorVerificationRestant = $em->getRepository("AppBundle:EventContributor")->findByConOid($idContributor);
            
            if (empty($contributorVerificationRestant)) {
                $contributor = $em->getRepository('AppBundle:Contributor')->findOneById($idContributor);
                if (!$contributor->getIsMnms()) {
                    $em->remove($contributor);
                    $em->flush();
                }
            }

        return $this->redirectToRoute('workshop_event_contributor', array('id' => $idEvent));
    }















































    /**
     * Lists all eventContributor entities.
     *
     * @Route("/", name="workshop_contributor_list_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $eventContributors = $em->getRepository('AppBundle:EventContributor')->findAll();

        return $this->render('eventcontributor/index.html.twig', array(
            'eventContributors' => $eventContributors,
        ));
    }

    /**
     * Creates a new eventContributor entity.
     *
     * @Route("/new", name="workshop_contributor_list_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $eventContributor = new Eventcontributor();
        $form = $this->createForm('AppBundle\Form\EventContributorType', $eventContributor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($eventContributor);
            $em->flush();

            return $this->redirectToRoute('workshop_contributor_list_show', array('id' => $eventContributor->getId()));
        }

        return $this->render('eventcontributor/new.html.twig', array(
            'eventContributor' => $eventContributor,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a eventContributor entity.
     *
     * @Route("/{id}", name="workshop_contributor_list_show")
     * @Method("GET")
     */
    public function showAction(EventContributor $eventContributor)
    {
        $deleteForm = $this->createDeleteForm($eventContributor);

        return $this->render('eventcontributor/show.html.twig', array(
            'eventContributor' => $eventContributor,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing eventContributor entity.
     *
     * @Route("/{id}/edit", name="workshop_contributor_list_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EventContributor $eventContributor)
    {
        $deleteForm = $this->createDeleteForm($eventContributor);
        $editForm = $this->createForm('AppBundle\Form\EventContributorType', $eventContributor);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('workshop_contributor_list_edit', array('id' => $eventContributor->getId()));
        }

        return $this->render('eventcontributor/edit.html.twig', array(
            'eventContributor' => $eventContributor,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a eventContributor entity.
     *
     * @Route("/{id}", name="workshop_contributor_list_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, EventContributor $eventContributor)
    {
        $form = $this->createDeleteForm($eventContributor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($eventContributor);
            $em->flush();
        }

        return $this->redirectToRoute('workshop_contributor_list_index');
    }

    /**
     * Creates a form to delete a eventContributor entity.
     *
     * @param EventContributor $eventContributor The eventContributor entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(EventContributor $eventContributor)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('workshop_contributor_list_delete', array('id' => $eventContributor->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
