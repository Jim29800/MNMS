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
 * @Route("register")
 */
class RegisterController extends Controller
{
    
    /**
     * Creates a new user entity.
     *
     * @Route("/", name="register")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        if(($this->getUser())){
            return $this->redirectToRoute('homepage');
        }else{
            $user = new User();
            $user->setEnabled(1);
            $form = $this->createForm('AppBundle\Form\UserType', $user);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                return $this->redirectToRoute('fos_user_security_login');
            }

            return $this->render('default/register.html.twig', array(
                'user' => $user,
                'form' => $form->createView(),
            ));
        }
        
    }
}
