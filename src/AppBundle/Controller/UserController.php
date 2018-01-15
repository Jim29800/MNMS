<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 * @Route("user")
 */
class UserController extends Controller
{
    /**
     * Affiche 2 boutons pour créer ou accéder à la liste des participants
     *
     * @Route("/", name="user_index")
     * @Method("GET")
     */
    public function indexAction()
    {
       
        return $this->render('user/index.html.twig');
    }

    /**
     * Creates a new participant.
     *
     * @Route("/new", name="user_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $user = new User();
//--on appelle le formulaire pour participant
        $form = $this->createForm('AppBundle\Form\UserRepertoireType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          
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
            $user->setPassword( "uniqid(): %s\r\n", uniqid());
            $user->setUsername($userName);

//------on set l'avatar avec l'image de l'utilisateur connecté
            $user->setAvatar($this->getUser());
  
            

//----- on persist dans la base
            $em->persist($user);
            $em->flush();
//------quand on crée un participant, on est redirigé vers le détail du participant
            return $this->redirectToRoute('user_show', array('id' => $user->getId()));
        }
//------le controller appelle la vue correspondante
        return $this->render('user/new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }


/**
     * Liste tous les participants en fonction du user qui les a créés et par ordre alphabétique
     *
     * @Route("/list", name="user_list")
     * @Method("GET")
     */
    public function listAction()
    {

        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')
        ->findBy(array("leaderOid" => $user), array('lastname' => 'ASC'));
        return $this->render('user/list.html.twig', array(
            'users' => $users,
        ));
    }



    /**
     * Finds and displays a user entity.
     *
     * @Route("/{id}", name="user_show")
     * @Method("GET")
     */
    public function showAction(User $user)
    {
        $deleteForm = $this->createDeleteForm($user);
        return $this->render('user/show.html.twig', array(
            'user' => $user,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, User $user)
    {
        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('AppBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_edit', array('id' => $user->getId()));
        }

        return $this->render('user/edit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a user entity.
     *
     * @Route("/{id}", name="user_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, User $user)
    {
        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param User $user The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
