<?php

namespace MRS\SgeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Financas
 *
 * @ORM\Table(name="financas_parcelamento", indexes={@ORM\Index(name="fk_financas", columns={"financas_id"})})
 * @ORM\Entity
 */
class FinancasParcelamento
{
    /**
     * @var string
     *
     * @ORM\Column(name="valor_parcial", type="decimal", precision=10, scale=2, nullable=true)
     * @Assert\NotBlank(message="Valor Parcial é Obrigatório")
     */
    private $valorParcial;


    /**
     * @var string
     *
     * @ORM\Column(name="data_pagamento", type="date", nullable=true)
     * @Assert\NotBlank(message="Data de Pagamento é Obrigatório")
     */
    private $dataPagamento;


    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \MRS\SgeBundle\Entity\Financas
     *
     * @ORM\ManyToOne(targetEntity="MRS\SgeBundle\Entity\Financas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="financas_id", referencedColumnName="id")
     * })
     */
    private $financas;


    public function __construct()
    {
        $this->dataPagamento = new \DateTime('now');
    }

    /**
     * Set valorParcial
     *
     * @param string $valorParcial
     * @return FinancasParcelamento
     */
    public function setValorParcial($valorParcial)
    {
        $this->valorParcial = $valorParcial;

        return $this;
    }

    /**
     * Get valorParcial
     *
     * @return string 
     */
    public function getValorParcial()
    {
        return $this->valorParcial;
    }

    /**
     * Set dataPagamento
     *
     * @param \DateTime $dataPagamento
     * @return FinancasParcelamento
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set financas
     *
     * @param \MRS\SgeBundle\Entity\Financas $financas
     * @return FinancasParcelamento
     */
    public function setFinancas(\MRS\SgeBundle\Entity\Financas $financas = null)
    {
        $this->financas = $financas;

        return $this;
    }

    /**
     * Get financas
     *
     * @return \MRS\SgeBundle\Entity\Financas 
     */
    public function getFinancas()
    {
        return $this->financas;
    }
}
