<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Repository\RoomRepository;

class EventSelectType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['user'];
        $builder->add(
            'rooOid',
            EntityType::class,
            [
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
                        ->setParameter('user', $user->getId());
                }
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Event',
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
