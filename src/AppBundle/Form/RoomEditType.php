<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoomEditType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('Name',null,array(
            'label' => 'Nom de la salle',
            'attr' => [
                'class' => 'form-control form-bottom-margin',
                'placeholder' => 'Nom de la salle',
            ]

        ))
        ->add('Address', null, array(
            'label' => 'Adress',
            'attr' => [
                'class' => 'form-control form-bottom-margin',
                'placeholder' => 'Adresse',
            ]
        ))

        ->add('City', null, array(
            'label' => 'City',
            'attr' => [
                'class' => 'form-control form-bottom-margin',
                'placeholder' => 'Ville',
            ]
        ))

        ->add('Zipcode', null, array(
            'label' => 'Zipcode',
            'attr' => [
                'class' => 'form-control form-bottom-margin',
                'placeholder' => 'Zipcode',
            ]
        ))

        ->add('Zipcode', null, array(
            'label' => 'Zipcode',
            'attr' => [
                'class' => 'form-control form-bottom-margin',
                'placeholder' => 'Code postal',
            ]
        ))

        ->add('Country', null, array(
            'label' => 'Country',
            'attr' => [
                'class' => 'form-control form-bottom-margin',
                'placeholder' => 'Pays',
            ]
        ))

        ->add('Area', null, array(
            'label' => 'Area',
            'attr' => [
                'class' => 'form-control form-bottom-margin',
                'placeholder' => 'Nombre de mètres carrés',
            ]
        ))
// add-on pour indiquer metre carré
//         <div class="input-group">
//   <input type="text" class="form-control" placeholder="Recipient's username" aria-describedby="basic-addon2">
//   <span class="input-group-addon" id="basic-addon2">@example.com</span>
// </div>

        ->add('MaxPeople', null, array(
            'label' => 'MaxPeople',
            'attr' => [
                'class' => 'form-control form-bottom-margin',
                'placeholder' => 'Nombre de personnes',
            ]
        ))

        ->add('Islet', null, array(
            'label' => 'Islet',
            'attr' => [
                'class' => 'form-control form-bottom-margin',
                'placeholder' => 'Ilots',
            ]
        ))

        ->add('Projection', null, array(
            'label' => 'Projection',
            'attr' => [
                'class' => 'form-control form-bottom-margin',
                'placeholder' => 'Projection',
            ]
        ))

        ->add('Exit', null, array(
            'label' => 'Exit',
            'attr' => [
                'class' => 'form-control form-bottom-margin',
                'placeholder' => 'Sorties',
            ]
        ))

        ->add('Wall', null, array(
            'label' => 'Wall',
            'attr' => [
                'class' => 'form-control form-bottom-margin',
                'placeholder' => 'Murs',
            ]
        ))

        ->add('Paperboard', null, array(
            'label' => 'Paperboard',
            'attr' => [
                'class' => 'form-control form-bottom-margin',
                'placeholder' => 'Paperboard',
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
