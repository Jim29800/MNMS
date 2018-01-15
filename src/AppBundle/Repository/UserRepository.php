<?php

namespace AppBundle\Repository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
    function FindLastUser() {
// on donne un alias à la table
       $qb = $this->createQueryBuilder('uc');
       $qb->setMaxResults(1); // fonction qui indique qu'on ne veut qu'un résultat
       $qb->orderBy('uc.id', 'DESC'); // tri par l'id de l'entité User

       return $qb->getQuery()->getSingleResult();
    }
}
