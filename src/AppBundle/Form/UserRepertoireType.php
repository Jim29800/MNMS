<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
// ...

class UserRepertoireType extends AbstractType
{
    /**
     * {@inheritdoc}
     */

//---- formulaire pour créer un participant--------------------------------------
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('firstname', null, array(
            'attr' => ['class'=> 'form-control form-bottom-margin',
                        'placeholder' => 'Prénom' ]
        ))
        ->add('lastname', null, array(
                'attr' => ['class' => 'form-control form-bottom-margin',
                'placeholder' => ' Nom ']
            ))
        
        ->add('email', null, array(
            'attr' => ['class' => 'form-control form-bottom-margin',
                    'placeholder' => 'Adresse email']
            ))
        
        
        ->add('function', null, array(
            'label' => 'Fonction',
            'attr' => ['class' => 'form-control form-bottom-margin', 'placeholder' => 'Fonction']
        ));
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}


