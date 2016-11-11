<?php

namespace MRS\SgeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Logradouro
 *
 * @ORM\Table(name="logradouro", indexes={@ORM\Index(name="fk_logradouro_pais_idx", columns={"pais_id"})})
 * @ORM\Entity
 */
class Logradouro
{
    /**
     * @var string
     *
     * @ORM\Column(name="cep", type="string", length=10, nullable=true)
     */
    private $cep;

    /**
     * @var string
     *
     * @ORM\Column(name="logradouro", type="text", length=65535, nullable=true)
     */
    private $logradouro;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \MRS\SgeBundle\Entity\Pais
     *
     * @ORM\ManyToOne(targetEntity="MRS\SgeBundle\Entity\Pais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pais_id", referencedColumnName="id")
     * })
     */
    private $pais;



    /**
     * Set cep
     *
     * @param string $cep
     * @return Logradouro
     */
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * Get cep
     *
     * @return string 
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Set logradouro
     *
     * @param string $logradouro
     * @return Logradouro
     */
    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;

        return $this;
    }

    /**
     * Get logradouro
     *
     * @return string 
     */
    public function getLogradouro()
    {
        return $this->logradouro;
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
     * Set pais
     *
     * @param \MRS\SgeBundle\Entity\Pais $pais
     * @return Logradouro
     */
    public function setPais(\MRS\SgeBundle\Entity\Pais $pais = null)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return \MRS\SgeBundle\Entity\Pais 
     */
    public function getPais()
    {
        return $this->pais;
    }
}
