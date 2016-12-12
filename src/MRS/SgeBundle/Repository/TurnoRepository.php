<?php

namespace MRS\SgeBundle\Repository;

/**
 * Created by PhpStorm.
 * User: marcio
 * Date: 28/11/16
 * Time: 17:38
 */

use Doctrine\ORM\EntityRepository;


class TurnoRepository extends EntityRepository
{

    public function finOneByFirstResult()
    {
        return $this->createQueryBuilder('t')
            ->select('t')
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleResult();

    }

}