<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkshopType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', null, array(
            'label' => 'Titre de l\'atelier ',
            'attr' => [
                'class' => 'form-control form-bottom-margin',
                'placeholder' => ' Titre de l\'atelier '
            ]
        ))
        ->add('problem', null, array(
                'label' => 'Problème à résoudre ',
                'attr' => [
                    'class' => 'form-control form-bottom-margin',
                    'placeholder' => ' Problème à résoudre '
                ]
            ))
        ->add('goal', null, array(
                'label' => 'Objectif ',
                'attr' => [
                    'class' => 'form-control form-bottom-margin',
                    'placeholder' => ' Objectif '
                ]
            ))
        ->add('isPublic', null, array(
                'label' => 'Publique ',

            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Workshop'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_workshop';
    }


}
