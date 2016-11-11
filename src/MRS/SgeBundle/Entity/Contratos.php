<?php

namespace MRS\SgeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contratos
 *
 * @ORM\Table(name="contratos", indexes={@ORM\Index(name="contrato_id_aluno_id_idx", columns={"aluno_id"})})
 * @ORM\Entity
 */
class Contratos
{
    /**
     * @var string
     *
     * @ORM\Column(name="termo_compromisso", type="text", length=65535, nullable=false)
     */
    private $termoCompromisso;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \MRS\SgeBundle\Entity\Aluno
     *
     * @ORM\ManyToOne(targetEntity="MRS\SgeBundle\Entity\Aluno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="aluno_id", referencedColumnName="id")
     * })
     */
    private $aluno;



    /**
     * Set termoCompromisso
     *
     * @param string $termoCompromisso
     * @return Contratos
     */
    public function setTermoCompromisso($termoCompromisso)
    {
        $this->termoCompromisso = $termoCompromisso;

        return $this;
    }

    /**
     * Get termoCompromisso
     *
     * @return string 
     */
    public function getTermoCompromisso()
    {
        return $this->termoCompromisso;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set aluno
     *
     * @param \MRS\SgeBundle\Entity\Aluno $aluno
     * @return Contratos
     */
    public function setAluno(\MRS\SgeBundle\Entity\Aluno $aluno = null)
    {
        $this->aluno = $aluno;

        return $this;
    }

    /**
     * Get aluno
     *
     * @return \MRS\SgeBundle\Entity\Aluno 
     */
    public function getAluno()
    {
        return $this->aluno;
    }
}
