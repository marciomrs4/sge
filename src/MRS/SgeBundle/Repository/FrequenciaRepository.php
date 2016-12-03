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

    public function listFrequenciaByTurno($turno)
    {
        $data = new \DateTime('now');

        $query = "SELECT A.id AS id, A.nome AS aluno, E.nome AS escola, T.descricao AS turno,
                        (IF (F.dia_semana = :date_dia,F.levar,'')) AS levar,
                        (IF (F.dia_semana = :date_dia,F.entregar,'')) AS entregar,
                        (IF (F.dia_semana = :date_dia,F.dia_semana,'')) AS dia
                    FROM aluno AS A
                    LEFT join frequencia as F
                    ON F.aluno_id = A.id
                    INNER JOIN escola AS E
                    ON E.id = A.escola_id
                    INNER JOIN turno AS T
                    ON T.id = A.turno_id
                    WHERE A.turno_id = :turno
                    GROUP BY A.id, F.dia_semana, A.nome, E.nome, T.descricao, F.levar,F.entregar, F.dia_semana";

        $stmt = $this->getEntityManager()
            ->getConnection()
            ->prepare($query);

            $stmt->execute(array(':date_dia'=>$data->format('Y-m-d'),
                                 ':turno' => $turno));

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }

}