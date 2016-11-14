<?php

namespace MRS\SgeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Veiculo
 *
 * @ORM\Table(name="veiculo")
 * @ORM\Entity
 */
class Veiculo
{
    /**
     * @var string
     *
     * @ORM\Column(name="placa", type="string", length=7, nullable=false)
     * @Assert\NotBlank(message="O Campo Placa é obrigatório")
     */
    private $placa;

    /**
     * @var string
     *
     * @ORM\Column(name="modelo", type="string", length=50, nullable=false)
     */
    private $modelo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ano_fabricacao", type="date", nullable=false)
     */
    private $anoFabricacao;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=50, nullable=false)
     */
    private $titulo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set placa
     *
     * @param string $placa
     * @return Veiculo
     */
    public function setPlaca($placa)
    {
        $this->placa = $placa;

        return $this;
    }

    /**
     * Get placa
     *
     * @return string 
     */
    public function getPlaca()
    {
        return $this->placa;
    }

    /**
     * Set modelo
     *
     * @param string $modelo
     * @return Veiculo
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * Get modelo
     *
     * @return string 
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set anoFabricacao
     *
     * @param \DateTime $anoFabricacao
     * @return Veiculo
     */
    public function setAnoFabricacao($anoFabricacao)
    {
        $this->anoFabricacao = $anoFabricacao;

        return $this;
    }

    /**
     * Get anoFabricacao
     *
     * @return \DateTime 
     */
    public function getAnoFabricacao()
    {
        return $this->anoFabricacao;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Veiculo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
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

    public function __toString()
    {
      return $this->getModelo();
    }

}
