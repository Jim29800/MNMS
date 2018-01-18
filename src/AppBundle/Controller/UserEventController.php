<?php

namespace AppBundle\Controller;

use AppBundle\Entity\UserEvent;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * Userevent controller.
 *
 * @Route("workshop/event/participant")
 */
class UserEventController extends Controller
{
    /**
     * Lists all userEvent entities.
     *
     * @Route("/", name="workshop_event_participant_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $userEvents = $em->getRepository('AppBundle:UserEvent')->findAll();

        return $this->render('userevent/index.html.twig', array(
            'userEvents' => $userEvents,
        ));
    }

    /**
     * Creates a new userEvent entity.
     *
     * @Route("/new", name="workshop_event_participant_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $userEvent = new Userevent();
        $form = $this->createForm('AppBundle\Form\UserEventType', $userEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($userEvent);
            $em->flush();

            return $this->redirectToRoute('workshop_event_participant_show', array('id' => $userEvent->getId()));
        }

        return $this->render('userevent/new.html.twig', array(
            'userEvent' => $userEvent,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a userEvent entity.
     *
     * @Route("/{id}", name="workshop_event_participant_show")
     * @Method("GET")
     */
    public function showAction(UserEvent $userEvent)
    {
        $deleteForm = $this->createDeleteForm($userEvent);

        return $this->render('userevent/show.html.twig', array(
            'userEvent' => $userEvent,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing userEvent entity.
     *
     * @Route("/{id}/edit", name="workshop_event_participant_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, UserEvent $userEvent)
    {
        $deleteForm = $this->createDeleteForm($userEvent);
        $editForm = $this->createForm('AppBundle\Form\UserEventType', $userEvent);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('workshop_event_participant_edit', array('id' => $userEvent->getId()));
        }

        return $this->render('userevent/edit.html.twig', array(
            'userEvent' => $userEvent,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a userEvent entity.
     *
     * @Route("/{id}", name="workshop_event_participant_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, UserEvent $userEvent)
    {
        $form = $this->createDeleteForm($userEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($userEvent);
            $em->flush();
        }

        return $this->redirectToRoute('workshop_event_participant_index');
    }

    /**
     * Creates a form to delete a userEvent entity.
     *
     * @param UserEvent $userEvent The userEvent entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UserEvent $userEvent)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('workshop_event_participant_delete', array('id' => $userEvent->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }




    /**
     * select
     * 
     * @Route("/select/{id}", name="workshop_event_participant")
     *  @Method({"GET", "POST"})
     */
    public function selectAction(Request $request, $id){

        $user = new User();

        $em = $this->getDoctrine()->getManager();

        $form1 = $this->createForm('AppBundle\Form\UserRepertoireType', $user);
        $form1->handleRequest($request);

        if($form1->isSubmitted() && $form1->isValid()) {

            $em = $this->getDoctrine()->getManager();
 //-----on crée une variable $lastUserId qui contient un id unique pour chaque participant en concaténant l'id du dernier utilisateur connecté+1 . le prénom  . le nom  
            $lastUserId = $em->getRepository(User::class)->findLastUser()->getId();
            $lastUserId ++;
            $firstName = $user->getFirstname();
            $lastName = $user->getLastname();

            $userName = $lastUserId . $firstName . $lastName;

//------on set l'objet LeaderOid avec l'objet user connecté 
            $user->setLeaderOid($this->getUser());

//------on set le password avec un mot de passe généré aléatoirement
            $user->setPassword(password_hash($this->generatePassword(), PASSWORD_BCRYPT));
            
            $user->setUsername($userName);


//------on set l'avatar avec l'image de l'utilisateur connecté
            // $user->setAvatar($this->getUser());


            $event = $em->getRepository("AppBundle:Event")->findOneById($id);
// //----- on persist dans la base

            $userEvent = new UserEvent();

            $userEvent->setEveOid($event);
            $userEvent->setUsrOid($user);
            $userEvent->setIsParticipating(false);
            
            
            $em->persist($user);
            $em->persist($userEvent);

            $em->flush();
//------quand on crée un participant, on est redirigé vers la page select
            return $this->redirectToRoute('workshop_event_participant', array('id' => $id));
        }
return  $this->render('event/select_participant.html.twig', array(
            'form1' => $form1->createView() ,
        ));

        }// fin de la méthode select


function generatePassword($length = 13) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);

        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }

        return $result;
    }
    


     }


