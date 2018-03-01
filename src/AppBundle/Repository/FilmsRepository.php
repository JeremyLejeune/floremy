<?php

namespace AppBundle\Repository;

/**
 * FilmsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FilmsRepository extends \Doctrine\ORM\EntityRepository
{

    public function searchFilm($search)
    {
        $qb = $this->createQueryBuilder('f')
            ->where('f.name like :search')
            ->setParameter('search', '%' . $search . '%');

        return $qb
            ->getQuery()
            ->getResult();
    }
}
