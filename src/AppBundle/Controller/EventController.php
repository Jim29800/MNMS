<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use AppBundle\Entity\User;
use AppBundle\Entity\Room;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Form\EventType;
use Doctrine\ORM\EntityRepository;
use AppBundle\Repository\RoomRepository;
use AppBundle\Repository\EventRepository;


/**
 * Event controller.
 *
 * @Route("workshop/event")
 */
class EventController extends Controller
{
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
     * workshop_event_select : selecteur des rooms lier à l'utilisateur
     *
     * @Route("/{id}/room/select", name="workshop_event_select")
     * @Method({"GET", "POST"})
     */
    public function selectAction(Request $request, Event $event)
    {
        $data = $request->getContent();
        $em = $this->getDoctrine()->getManager();

        // $repository = $this->getDoctrine()->getRepository(User::class);
        // $user = $repository->findOneById(1);
        $user = $this->getUser();
        $rooms = $em->getRepository('AppBundle:Room')->findAllRoom($this->getUser());
        
        
        
        $form = $this->createForm('AppBundle\Form\EventType', $event)
        ->add('rooOid'
        , EntityType::class, [
            'class' => 'AppBundle:Room',
            'query_builder' => function (RoomRepository $repository) use ($user) {
                $qb = $repository->createQueryBuilder('r');
                var_dump($user);
                
                return $qb
                            ->from('AppBundle:Event', 'e')
                            ->leftJoin('e.worOid', 'w')
                            ->where('w.usrOid = :user')
                            ->andWhere('e.rooOid = r.id')                            
                            ->andWhere('w.id = e.worOid')
                            ->setParameter('user', $user->getId())
                ;
                
                    }
                ])
                // 'SELECT r.Name, r.id
                //     FROM AppBundle:Room r 
                //     INNER JOIN AppBundle:Event e WITH r.id = e.rooOid
                //     INNER JOIN AppBundle:Workshop w WITH e.worOid = w.id
                //     WHERE w.usrOid = :id'
                ;



        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('workshop_event_select', array('id' => $event->getId()));
        }

        return $this->render('event/select.html.twig', array(
            'rooms' => $rooms,
            'form' => $form->createView(),
            
        ));
    }
    //Creation d'un evenement avec redirection pout ajout de salle : workshop_event_select
    /**
     * Creates a new event entity.
     *
     * @Route("/new", name="workshop_event_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $event = new Event();
        $event->setIsOver(false)
            ->setIsReturned(false);
        $form = $this->createForm('AppBundle\Form\EventType', $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
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
