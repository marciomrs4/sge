<?php

namespace MRS\SgeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Financas
 *
 * @ORM\Table(name="financas", indexes={@ORM\Index(name="alu_codigo_on_alu_codigo_idx", columns={"aluno_id"})})
 * @ORM\Entity(repositoryClass="MRS\SgeBundle\Repository\FinancasRepository")
 */
class Financas
{
    /**
     * @var string
     *
     * @ORM\Column(name="valor_total_pago", type="decimal", precision=10, scale=2, nullable=true)
     * @Assert\NotBlank(message="Valor é obrigatório")
     */
    private $valorTotalPago;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_vencimento", type="date", nullable=false)
     */
    private $dataVencimento;

    /**
     * @var string
     *
     * @ORM\Column(name="data_pagamento", type="date", nullable=true)
     */
    private $dataPagamento;


    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=1, nullable=false)
     */
    private $status;

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
     * @var \MRS\SgeBundle\Entity\Contratos
     *
     * @ORM\ManyToOne(targetEntity="MRS\SgeBundle\Entity\Contratos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="contrato_id", referencedColumnName="id")
     * })
     */
    private $contrato;




    /**
     * Set valorTotalPago
     *
     * @param string $valorTotalPago
     * @return Financas
     */
    public function setValorTotalPago($valorTotalPago)
    {
        $this->valorTotalPago = $valorTotalPago;

        return $this;
    }

    /**
     * Get valorTotalPago
     *
     * @return string 
     */
    public function getValorTotalPago()
    {
        return $this->valorTotalPago;
    }

    /**
     * Set dataVencimento
     *
     * @param \DateTime $dataVencimento
     * @return Financas
     */
    public function setDataVencimento($dataVencimento)
    {
        $this->dataVencimento = $dataVencimento;

        return $this;
    }

    /**
     * Get dataVencimento
     *
     * @return \DateTime 
     */
    public function getDataVencimento()
    {
        return $this->dataVencimento;
    }

    /**
     * Set dataPagamento
     *
     * @param \DateTime $dataPagamento
     * @return Financas
     */
    public function setDataPagamento($dataPagamento)
    {
        $this->dataPagamento = $dataPagamento;

        return $this;
    }

    /**
     * Get dataPagamento
     *
     * @return \DateTime 
     */
    public function getDataPagamento()
    {
        return $this->dataPagamento;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Financas
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
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
     * @return Financas
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
     * Set contrato
     *
     * @param \MRS\SgeBundle\Entity\Contratos $contrato
     * @return Financas
     */
    public function setContrato(\MRS\SgeBundle\Entity\Contratos $contrato = null)
    {
        $this->contrato = $contrato;

        return $this;
    }

    /**
     * Get contrato
     *
     * @return \MRS\SgeBundle\Entity\Contratos 
     */
    public function getContrato()
    {
        return $this->contrato;
    }
}
