<?php

namespace MRS\SgeBundle\Repository;

/**
 * Created by PhpStorm.
 * User: marcio
 * Date: 28/11/16
 * Time: 17:38
 */

use Doctrine\ORM\EntityRepository;


class FinancasRepository extends EntityRepository
{

    public function findAllFinancasPendentes()
    {

        $date = new \DateTime('now');

        return $this->createQueryBuilder('f')
            ->where('f.status = :status')
            ->andWhere('f.dataVencimento < :hoje')
            ->setParameters(array('status'=>'1','hoje'=>$date))
            ->orderBy('f.dataVencimento')
            ->getQuery()
            ->getResult();

    }

    public function findAllFinancasFiltered($data)
    {

        return $this->createQueryBuilder('f')
            ->where('f.status LIKE :status')
            ->andWhere('f.dataVencimento > :dataInicial AND f.dataVencimento < :dataFinal')
            ->setParameters(array('status'=>$data['status'],
                                  'dataInicial'=>$data['dataInicial'],
                                  'dataFinal'=>$data['dataFinal']))
            ->orderBy('f.aluno','DESC')
            ->getQuery()
            ->getResult();

    }


    public function sumFinancasFiltered($data)
    {

        return $this->createQueryBuilder('f')
            ->select('SUM(f.valorTotalPago) AS soma','AVG(f.valorTotalPago) AS media')
            ->where('f.status LIKE :status')
            ->andWhere('f.dataVencimento > :dataInicial AND f.dataVencimento < :dataFinal')
            ->setParameters(array('status'=>$data['status'],
                'dataInicial'=>$data['dataInicial'],
                'dataFinal'=>$data['dataFinal']))
            ->orderBy('f.aluno','DESC')
            ->getQuery()
            ->getSingleResult();

    }

}