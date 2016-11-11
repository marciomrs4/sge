<?php

namespace MRS\SgeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Pais
 *
 * @ORM\Table(name="pais")
 * @ORM\Entity
 */
class Pais
{
    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="O campo nome é Obrigatório")
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="telefone1", type="string", length=50, nullable=false)
     */
    private $telefone1;

    /**
     * @var string
     *
     * @ORM\Column(name="telefone2", type="string", length=50, nullable=true)
     */
    private $telefone2;

    /**
     * @var string
     *
     * @ORM\Column(name="rg", type="string", length=50, nullable=true)
     */
    private $rg;

    /**
     * @var string
     *
     * @ORM\Column(name="cpf", type="string", length=50, nullable=true)
     */
    private $cpf;

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
     * Set nome
     *
     * @param string $nome
     * @return Pais
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set telefone1
     *
     * @param string $telefone1
     * @return Pais
     */
    public function setTelefone1($telefone1)
    {
        $this->telefone1 = $telefone1;

        return $this;
    }

    /**
     * Get telefone1
     *
     * @return string 
     */
    public function getTelefone1()
    {
        return $this->telefone1;
    }

    /**
     * Set telefone2
     *
     * @param string $telefone2
     * @return Pais
     */
    public function setTelefone2($telefone2)
    {
        $this->telefone2 = $telefone2;

        return $this;
    }

    /**
     * Get telefone2
     *
     * @return string 
     */
    public function getTelefone2()
    {
        return $this->telefone2;
    }

    /**
     * Set rg
     *
     * @param string $rg
     * @return Pais
     */
    public function setRg($rg)
    {
        $this->rg = $rg;

        return $this;
    }

    /**
     * Get rg
     *
     * @return string 
     */
    public function getRg()
    {
        return $this->rg;
    }

    /**
     * Set cpf
     *
     * @param string $cpf
     * @return Pais
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;

        return $this;
    }

    /**
     * Get cpf
     *
     * @return string 
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Pais
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
}
