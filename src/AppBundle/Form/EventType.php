<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
class EventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date', DateTimeType::class, array(
            'label' => 'date', 
            'date_widget' => 'single_text',
            'time_widget' => 'single_text',
            'format' => 'dd-MM-yyyy HH:mm',
            'input'=> 'datetime' ,
            'attr' => array('data-date-format' => 'dd-MM-yyyy HH:mm')
            ))
        ->add('title');        
        //->add('isOver')
        //->add('isReturned')
        //->add('rooOid')
        //->add('worOid');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Event'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_event';
    }


}
