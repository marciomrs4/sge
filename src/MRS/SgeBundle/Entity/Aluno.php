<?php

namespace MRS\SgeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Aluno
 *
 * @ORM\Table(name="aluno", indexes={@ORM\Index(name="esc_codigo_alu_codigo_idx", columns={"escola_id"}), @ORM\Index(name="tur_codigo_alu_codigo_idx", columns={"turno_id"}), @ORM\Index(name="fk_aluno_pais1_idx", columns={"pais_id"})})
 * @ORM\Entity
 */
class Aluno
{
    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="O campo nome é obrigatório")
     */
    private $nome;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_nascimento", type="date", nullable=true)
     */
    private $dataNascimento;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_mensalidade", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $valorMensalidade;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vencimento", type="date", nullable=false)
     */
    private $vencimento;

    /**
     * @var string
     *
     * @ORM\Column(name="serie", type="string", length=50, nullable=true)
     */
    private $serie;

    /**
     * @var string
     *
     * @ORM\Column(name="sala", type="string", length=50, nullable=true)
     */
    private $sala;

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
     * @var \MRS\SgeBundle\Entity\Turno
     *
     * @ORM\ManyToOne(targetEntity="MRS\SgeBundle\Entity\Turno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="turno_id", referencedColumnName="id")
     * })
     * @Assert\NotBlank(message="O Turno é obrigatório")
     */
    private $turno;

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
     * @var \MRS\SgeBundle\Entity\Escola
     *
     * @ORM\ManyToOne(targetEntity="MRS\SgeBundle\Entity\Escola")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="escola_id", referencedColumnName="id")
     * })
     * @Assert\NotBlank(message="A Escola é obrigatória")
     */
    private $escola;



    /**
     * Set nome
     *
     * @param string $nome
     * @return Aluno
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
     * Set dataNascimento
     *
     * @param \DateTime $dataNascimento
     * @return Aluno
     */
    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }

    /**
     * Get dataNascimento
     *
     * @return \DateTime 
     */
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    /**
     * Set valorMensalidade
     *
     * @param string $valorMensalidade
     * @return Aluno
     */
    public function setValorMensalidade($valorMensalidade)
    {
        $this->valorMensalidade = $valorMensalidade;

        return $this;
    }

    /**
     * Get valorMensalidade
     *
     * @return string 
     */
    public function getValorMensalidade()
    {
        return $this->valorMensalidade;
    }

    /**
     * Set vencimento
     *
     * @param \DateTime $vencimento
     * @return Aluno
     */
    public function setVencimento($vencimento)
    {
        $this->vencimento = $vencimento;

        return $this;
    }

    /**
     * Get vencimento
     *
     * @return \DateTime 
     */
    public function getVencimento()
    {
        return $this->vencimento;
    }

    /**
     * Set serie
     *
     * @param string $serie
     * @return Aluno
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * Get serie
     *
     * @return string 
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set sala
     *
     * @param string $sala
     * @return Aluno
     */
    public function setSala($sala)
    {
        $this->sala = $sala;

        return $this;
    }

    /**
     * Get sala
     *
     * @return string 
     */
    public function getSala()
    {
        return $this->sala;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Aluno
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
     * Set turno
     *
     * @param \MRS\SgeBundle\Entity\Turno $turno
     * @return Aluno
     */
    public function setTurno(\MRS\SgeBundle\Entity\Turno $turno = null)
    {
        $this->turno = $turno;

        return $this;
    }

    /**
     * Get turno
     *
     * @return \MRS\SgeBundle\Entity\Turno 
     */
    public function getTurno()
    {
        return $this->turno;
    }

    /**
     * Set pais
     *
     * @param \MRS\SgeBundle\Entity\Pais $pais
     * @return Aluno
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

    /**
     * Set escola
     *
     * @param \MRS\SgeBundle\Entity\Escola $escola
     * @return Aluno
     */
    public function setEscola(\MRS\SgeBundle\Entity\Escola $escola = null)
    {
        $this->escola = $escola;

        return $this;
    }

    /**
     * Get escola
     *
     * @return \MRS\SgeBundle\Entity\Escola 
     */
    public function getEscola()
    {
        return $this->escola;
    }
}
