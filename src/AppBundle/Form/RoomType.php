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
        $builder->add('Name',null,array(
            'label' => 'Nom de la salle',
            'attr' => [
                'class' => 'form-control form-bottom-margin',
                'placeholder' => 'Nom de la salle',
            ]

        ))
        ->add('Address', null, array(
            'label' => 'Adresse',
            'attr' => [
                'class' => 'form-control form-bottom-margin',
                'placeholder' => 'Adresse',
            ]
        ))

        ->add('City', null, array(
            'label' => 'Ville',
            'attr' => [
                'class' => 'form-control form-bottom-margin',
                'placeholder' => 'Ville',
            ]
        ))

        ->add('Zipcode', null, array(
            'label' => 'Code Postal',
            'attr' => [
                'class' => 'form-control form-bottom-margin',
                'placeholder' => 'Code Postal',
            ]
        ))

        // ->add('Zipcode', null, array(
        //     'label' => 'Zipcode',
        //     'attr' => [
        //         'class' => 'form-control form-bottom-margin',
        //         'placeholder' => 'Code postal',
        //     ]
        // ))

        ->add('Country', null, array(
            'label' => 'Pays',
            'attr' => [
                'class' => 'form-control form-bottom-margin',
                'placeholder' => 'Pays',
            ]
        ))

        ->add('Area', null, array(
            'label' => 'Nombre de m²',
            'attr' => [
                'class' => 'form-control form-bottom-margin',
                'placeholder' => 'Nombre de m²',
            ]
        ))
// add-on pour indiquer metre carré
//         <div class="input-group">
//   <input type="text" class="form-control" placeholder="Recipient's username" aria-describedby="basic-addon2">
//   <span class="input-group-addon" id="basic-addon2">@example.com</span>
// </div>

        ->add('MaxPeople', null, array(
            'label' => 'Nombre de personnes',
            'attr' => [
                'class' => 'form-control form-bottom-margin',
                'placeholder' => 'Nombre de personnes',
            ]
        ))

        ->add('Islet', null, array(
            'label' => 'Ilôts',
            'attr' => [
                'class' => 'form-control form-bottom-margin',
                'placeholder' => 'Ilôts',
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
            'label' => 'Sorties',
            'attr' => [
                'class' => 'form-control form-bottom-margin',
                'placeholder' => 'Sorties',
            ]
        ))

        ->add('Wall', null, array(
            'label' => 'Murs',
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
        ))

        ->add('NeedPlace', null, array(
            'label' => 'J\'ai besoin d\'une salle',
            'attr' => [
                'class' => 'form-control form-bottom-margin',
                'placeholder' => 'J\'ai besoin d\'une salle',
            ]
        ))

        ->add('PlaceNumberPeople', null, array(
            'label' => 'Nombre de personnes',
            'attr' => [
                'class' => 'form-control form-bottom-margin',
                'placeholder' => 'Nombre de personnes',
            ]
        ))

        ->add('PlaceArea', null, array(
            'label' => 'Nombre de m²',
            'attr' => [
                'class' => 'form-control form-bottom-margin',
                'placeholder' => 'Nombre de m²',
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
