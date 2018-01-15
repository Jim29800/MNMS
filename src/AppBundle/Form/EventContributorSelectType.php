<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Repository\ContributorRepository;



class EventContributorSelectType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['user'];
        $builder->add(
            'conOid', 
            EntityType::class,
            [
                'label' => "Sélection de l'intervenant : ",
                'placeholder' => "Sélectionner l'intervenant",
                'attr' => [
                    'class' => 'form-control form-bottom-margin',
                ],
                'class' => 'AppBundle:Contributor',
                'query_builder' => function (ContributorRepository $repository) use ($user) {
                    $qb = $repository->createQueryBuilder('c');
                    return $qb
                    //contributor - EventContributor NEC - EVENT - WORKSHOP
                        ->from('AppBundle:EventContributor', 'ec')
                        ->leftJoin('ec.eveOid', 'e')
                        ->leftJoin('e.worOid', 'w')                        
                        ->where('w.usrOid = :user')
                        ->andWhere('w.id = e.worOid')
                        ->andWhere('e.id = ec.eveOid')
                        ->andWhere('c.id = ec.conOid')                        
                        ->orWhere('c.isMnms = true')
                        ->orderBy('c.isMnms', 'ASC')
                        ->setParameter('user', $user);
                }
            ]
        )
        ->add('neededNumber', 
        null,
        ['label' => "Nombre nécessaire",
        
        'attr' => [
            'placeholder' => "Nombre nécessaire",
            'class' => 'form-control form-bottom-margin',
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\EventContributor',
            'user' => 'AppBundle\Entity\User',
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
