<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Repository\UserRepository;

class UserEventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $userConnected = $options["userConnected"];
        $builder
        //->add('isParticipating')
        //->add('eveOid')
        ->add('usrOid', 
        EntityType::class,
            [
                'label' => "Sélection des participants : ",
                'placeholder' => 'Sélectionner les participants',
                'attr' => [
                    'class' => 'form-control form-bottom-margin',
                ],
                'class' => 'AppBundle:User',

                'query_builder' => function (UserRepository $repository) use ($userConnected) {
                    $qb = $repository->createQueryBuilder('u');
                    return $qb
                        ->where('u.leaderOid = :userConnected')
                        ->setParameter('userConnected', $userConnected);
                },
                // pour récupérer le nom et le prénom pour afficher dans le select
                'choice_label' => function($obj){
                    return $obj->getLastName()." ".$obj->getFirstName() ;
                },
                "expanded" => true,
                "multiple" => true,
            ]
        );
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\UserEvent',
            'userConnected' => "AppBundle\Entity\User",
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_userevent';
    }


}
