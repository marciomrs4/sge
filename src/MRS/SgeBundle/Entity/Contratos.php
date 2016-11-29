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
     * @var string
     *
     * @ORM\Column(name="financas_criada", type="text", length=1, nullable=false)
     */
    private $financasCriada;

    /**
     * @var string
     *
     * @ORM\Column(name="finalizado", type="text", length=1, nullable=false)
     */
    private $finalizado;

    /**
     * @var \DateTime
     * @ORM\Column(name="data_contrato_inicial", type="date", nullable=false)
     */
    private $dataContratoInicial;

    /**
     * @var \DateTime
     * @ORM\Column(name="data_contrato_final", type="date", nullable=false)
     */
    private $dataContratoFinal;

    /**
     * @var integer
     * @ORM\Column(name="numero_parcelas", type="integer", nullable=false)
     */
    private $numeroParcelas;

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

    /**
     * Set dataContratoFinal
     *
     * @param \DateTime $dataContratoFinal
     * @return Contratos
     */
    public function setDataContratoFinal($dataContratoFinal)
    {
        $this->dataContratoFinal = $dataContratoFinal;

        return $this;
    }

    /**
     * Get dataContratoFinal
     *
     * @return \DateTime 
     */
    public function getDataContratoFinal()
    {
        return $this->dataContratoFinal;
    }

    /**
     * Set numeroParcelas
     *
     * @param integer $numeroParcelas
     * @return Contratos
     */
    public function setNumeroParcelas($numeroParcelas)
    {
        $this->numeroParcelas = $numeroParcelas;

        return $this;
    }

    /**
     * Get numeroParcelas
     *
     * @return integer 
     */
    public function getNumeroParcelas()
    {
        return $this->numeroParcelas;
    }

    /**
     * Set dataContratoInicial
     *
     * @param \DateTime $dataContratoInicial
     * @return Contratos
     */
    public function setDataContratoInicial($dataContratoInicial)
    {
        $this->dataContratoInicial = $dataContratoInicial;

        return $this;
    }

    /**
     * Get dataContratoInicial
     *
     * @return \DateTime 
     */
    public function getDataContratoInicial()
    {
        return $this->dataContratoInicial;
    }

    /**
     * Set financasCriada
     *
     * @param string $financasCriada
     * @return Contratos
     */
    public function setFinancasCriada($financasCriada)
    {
        $this->financasCriada = $financasCriada;

        return $this;
    }

    /**
     * Get financasCriada
     *
     * @return string 
     */
    public function getFinancasCriada()
    {
        return $this->financasCriada;
    }

    /**
     * Set finalizado
     *
     * @param string $finalizado
     * @return Contratos
     */
    public function setFinalizado($finalizada)
    {
        $this->finalizada = $finalizada;

        return $this;
    }

    /**
     * Get finalizado
     *
     * @return string 
     */
    public function getFinalizado()
    {
        return $this->finalizada;
    }
}
