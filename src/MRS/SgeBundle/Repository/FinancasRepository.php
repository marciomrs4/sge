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

        //$date->modify('-10 month');

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
            ->andWhere('f.dataVencimento >= :dataInicial AND f.dataVencimento <= :dataFinal')
            ->setParameters(array('status'=>$data['status'],
                'dataInicial'=>$data['dataInicial'],
                'dataFinal'=>$data['dataFinal']))
            ->orderBy('f.aluno','DESC')
            ->getQuery()
            ->getResult();

    }


    public function recebidoNoPeriodo($data)
    {

        return $this->createQueryBuilder('f')
            ->select('SUM(f.valorTotalPago) AS soma')
            ->where('f.status LIKE :status')
            ->andWhere('f.dataVencimento >= :dataInicial AND f.dataVencimento <= :dataFinal')
            ->setParameters(array('status'=>$data['status'],
                'dataInicial'=>$data['dataInicial'],
                'dataFinal'=>$data['dataFinal']))
            ->orderBy('f.aluno','DESC')
            ->getQuery()
            ->getSingleResult();

    }

    public function pendenteNoPeriodo($data)
    {
        $query = ("SELECT
                        SUM(AL.valor_mensalidade - (IFNULL(valor_total_pago, 0.00))) AS pendente,
                        SUM(AL.valor_mensalidade) AS a_receber
                    FROM
                        financas AS FIN
                            INNER JOIN
                        contratos AS CON ON FIN.contrato_id = CON.id
                            INNER JOIN
                        aluno AS AL ON CON.aluno_id = AL.id
                    WHERE
                        data_vencimento >= :dataInicial
                            AND data_vencimento <= :dataFinal;
                    ");

        $stmt = $this->getEntityManager()->getConnection()
            ->prepare($query);

        $stmt->execute(array('dataInicial' => $data['dataInicial'],
                             'dataFinal' => $data['dataFinal']));

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

}