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
        if (($this->getUser())) {
            return $this->redirectToRoute('homepage');
        } else {
            $user = new User();
            $user->setEnabled(1);
            $form = $this->createForm('AppBundle\Form\UserType', $user);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                if ($this->checkPassword($user->getPlainPassword()) === "") {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($user);
                    $em->flush();
                } else {
                    $message = $this->checkPassword($user->getPlainPassword());
                    $this->addFlash('checkPwd', $message);
                    return $this->render('default/register.html.twig', array(
                        'user' => $user,
                        'form' => $form->createView(),
                    ));
                }

                return $this->redirectToRoute('fos_user_security_login');
            }

            return $this->render('default/register.html.twig', array(
                'user' => $user,
                'form' => $form->createView(),
            ));
        }

    }


    public function checkPassword($password, $pwdLength = 8)
    {
        $message = "";
        if (strlen($password) < $pwdLength) {
            $message .= "<li>Votre mot de passe doit contenir au moins " . $pwdLength . " caractères</li>";
        }
        if (!preg_match('/[A-Z]/', $password)) {
            $message .= "<li>Votre mot de passe doit contenir au moins 1 Majuscule</li>";
        }
        if (!preg_match('/[a-z]/', $password)) {
            $message .= "<li>Votre mot de passe doit contenir au moins 1 Minuscule</li>";
        }
        if (!preg_match('/[0-9]/', $password)) {
            $message .= "<li>Votre mot de passe doit contenir au moins 1 Chiffre</li>";
        }
        return $message;
    }
}
