<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Vich\UploaderBundle\Form\Type\VichImageType;
// ...

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
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
// ==================================================================================
        ->add('avatarFile', VichImageType::class, array(
            'required' => false,
            'label' => 'Choisir votre avatar (jpg,gif,png):',
            'attr' => ['class' => 'form-bottom-margin imgInp',]
            ))
// ==================================================================================
        ->add('email', null, array(
            'attr' => ['class' => 'form-control form-bottom-margin',
                        'placeholder' => 'Adresse email']
            ))
        ->add('username', null, array(
            'attr' => ['class' => 'form-control form-bottom-margin',
                        'placeholder' => 'Nom d\'utilisateur']
            ))
        ->add('plainPassword', RepeatedType::class, array(
            'type' => PasswordType::class,
            'invalid_message' => 'Les mots de passe ne correspondent pas.',
            'options' => array('attr' => array('class' => 'form-control form-bottom-margin')),
            'required' => true,
            'first_options' => array('attr' => ['class' => 'form-control form-bottom-margin', 'placeholder' => 'Mot de passe']),
            'second_options' => array('attr' => ['class' => 'form-control form-bottom-margin', 'placeholder' => 'Confirmer le mot de passe']),
        ));
        // ==================================================================
        // if(!$participant){
        //     return $builder;
        // }else{
        //     $builder->add('function', null, array(
        //     'label' => 'Fonction',
        //     'attr' => ['class' => 'form-control']
        // ))
        // ->add('leaderOid', null, array(
        //     'label' => 'Id du leader (à changer)',
        //     'attr' => ['class' => 'form-control']
        // ));
        // }
        // ==================================================================
    }
    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
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



    