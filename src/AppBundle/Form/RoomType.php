<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoomType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
  //------------------------------------------------------------------------
//formulaire de création de salle
//-------------------------------------------------------------------------      
        
        ->add('Name',null,array(
            'label' => 'Nom de la salle',
            'label_attr' => ['class'=> 'room-new '],
            
            'attr' => [
                'class' => 'form-control form-bottom-margin room-new reset ',
                'placeholder' => 'Nom de la salle',
            ]

        ))
        ->add('Address', null, array(
            'label' => 'Adresse',
            'label_attr' => ['class'=> 'room-new '],
            
            'attr' => [
                'class' => 'form-control form-bottom-margin room-new reset ',
                'placeholder' => 'Adresse',
            ]
        ))

        ->add('City', null, array(
            'label' => 'Ville',
            'label_attr' => ['class'=> 'room-all '],
            
            'attr' => [
                'class' => 'form-control form-bottom-margin room-all reset',
                'placeholder' => 'Ville',
            ]
        ))

        ->add('Zipcode', null, array(
            'label' => 'Code Postal',
            'label_attr' => ['class'=> 'room-all '],
            
            'attr' => [
                'class' => 'form-control form-bottom-margin room-all reset',
                'placeholder' => 'Code Postal',
            ]
        ))

        ->add('Country', null, array(
            'label' => 'Pays',
            'label_attr' => ['class'=> 'room-new '],
            
            'attr' => [
                'class' => 'form-control form-bottom-margin room-new reset',
                'placeholder' => 'Pays',
            ]
        ))

        ->add('Area', null, array(
            'label' => 'Nombre de m²',
            'label_attr' => ['class'=> 'room-new '],
            
            'attr' => [
                'class' => 'form-control form-bottom-margin room-new reset',
                'placeholder' => 'Nombre de m²',
            ]
        ))


        ->add('MaxPeople', null, array(
            'label' => 'Nombre de personnes',
            'label_attr' => ['class'=> 'room-new '],
            
            'attr' => [
                'class' => 'form-control form-bottom-margin room-new reset',
                'placeholder' => 'Nombre de personnes',
            ]
        ))

        ->add('Islet', null, array(
            'label' => 'Ilôts',
            'label_attr' => ['class'=> 'room-new '],
            
            'attr' => [
                'class' => 'form-control form-bottom-margin room-new reset-box',
                'placeholder' => 'Ilôts',
            ]
        ))

        ->add('Projection', null, array(
            'label' => 'Projection',
            'label_attr' => ['class'=> 'room-new '],
            
            'attr' => [
                'class' => 'form-control form-bottom-margin room-new reset-box',
                'placeholder' => 'Projection',
            ]
        ))

        ->add('Exit', null, array(
            'label' => 'Sorties',
            'label_attr' => ['class'=> 'room-new '],
            
            'attr' => [
                'class' => 'form-control form-bottom-margin room-new reset-box',
                'placeholder' => 'Sorties',
            ]
        ))

        ->add('Wall', null, array(
            'label' => 'Murs',
            'label_attr' => ['class'=> 'room-new '],
            
            'attr' => [
                'class' => 'form-control form-bottom-margin room-new reset-box',
                'placeholder' => 'Murs',
            ]
        ))

        ->add('Paperboard', null, array(
            'label' => 'Paperboard',
            'label_attr' => ['class'=> 'room-new '],
            
            'attr' => [
                'class' => 'form-control form-bottom-margin room-new reset-box',
                'placeholder' => 'Paperboard',
            ]
        ))
//------------------------------------------------------------------------
// formulaire de demande de salle
//-------------------------------------------------------------------------

        ->add('NeedPlace', null, array(
            'label' => 'J\'ai besoin d\'une salle',
            'label_attr' => ['class'=> 'hidden'],            
            'attr' => [
                'class' => 'form-control form-bottom-margin hidden reset',
                'placeholder' => 'J\'ai besoin d\'une salle',
            ]
        ))

        ->add('PlaceNumberPeople', null, array(
            'label' => 'Nombre de personnes',
            'label_attr' => ['class'=> 'room-need '],
            'attr' => [
                'class' => 'form-control form-bottom-margin room-need reset',
                'placeholder' => 'Nombre de personnes',
            ]
        ))

        ->add('PlaceArea', null, array(
            'label' => 'Nombre de m²',
            'label_attr' => ['class'=> 'room-need '],
            'attr' => [
                'class' => 'form-control form-bottom-margin room-need reset',
                'placeholder' => 'Nombre de m²',
            ]
            ))
                    ->add('PlaceNumberIslet', null, array(
            'label' => 'Nombre de ilots',
            'label_attr' => ['class'=> 'room-need '],
            'attr' => [
                'class' => 'form-control form-bottom-margin room-need reset',
                'placeholder' => 'Nombre de ilots',
            ]
            ));
      
    }/**

     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Room'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_room';
    }


}

