<?php

namespace MRS\SgeBundle\Repository;

/**
 * Created by PhpStorm.
 * User: marcio
 * Date: 28/11/16
 * Time: 17:38
 */

use Doctrine\ORM\EntityRepository;


class FrequenciaRepository extends EntityRepository
{

    public function countFrequenciaBy($turno, $date)
    {
        return $this->createQueryBuilder('f')
            ->select('count(f.entregar) AS total_entregar, count(f.levar) AS total_levar')
            ->where('f.turno = :turno')
            ->andWhere('f.diaSemana = :hoje')
            ->setParameters(array('hoje' => $date,
                                 'turno' => $turno))
            ->getQuery()
            ->getSingleResult();

    }

}