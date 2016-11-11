<?php

namespace MRS\SgeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InformacaoComplementar
 *
 * @ORM\Table(name="informacao_complementar", indexes={@ORM\Index(name="fk_informacao_complementar_aluno1_idx", columns={"aluno_id"})})
 * @ORM\Entity
 */
class InformacaoComplementar
{
    /**
     * @var string
     *
     * @ORM\Column(name="professor", type="string", length=50, nullable=true)
     */
    private $professor;

    /**
     * @var string
     *
     * @ORM\Column(name="problemas_saude", type="string", length=255, nullable=true)
     */
    private $problemasSaude;

    /**
     * @var string
     *
     * @ORM\Column(name="observacao", type="text", length=65535, nullable=true)
     */
    private $observacao;

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
     * Set professor
     *
     * @param string $professor
     * @return InformacaoComplementar
     */
    public function setProfessor($professor)
    {
        $this->professor = $professor;

        return $this;
    }

    /**
     * Get professor
     *
     * @return string 
     */
    public function getProfessor()
    {
        return $this->professor;
    }

    /**
     * Set problemasSaude
     *
     * @param string $problemasSaude
     * @return InformacaoComplementar
     */
    public function setProblemasSaude($problemasSaude)
    {
        $this->problemasSaude = $problemasSaude;

        return $this;
    }

    /**
     * Get problemasSaude
     *
     * @return string 
     */
    public function getProblemasSaude()
    {
        return $this->problemasSaude;
    }

    /**
     * Set observacao
     *
     * @param string $observacao
     * @return InformacaoComplementar
     */
    public function setObservacao($observacao)
    {
        $this->observacao = $observacao;

        return $this;
    }

    /**
     * Get observacao
     *
     * @return string 
     */
    public function getObservacao()
    {
        return $this->observacao;
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
     * @return InformacaoComplementar
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
