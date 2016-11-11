<?php

namespace MRS\SgeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Frequencia
 *
 * @ORM\Table(name="frequencia", indexes={@ORM\Index(name="fre_codigo_jus_codigo_idx", columns={"justificativa_id"}), @ORM\Index(name="esc_codigo_on_esc_codigo_idx", columns={"escola_id"}), @ORM\Index(name="alu_codigo_on_alu_codigo_idx", columns={"aluno_id"})})
 * @ORM\Entity
 */
class Frequencia
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dia_semana", type="date", nullable=false)
     */
    private $diaSemana;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="date", nullable=false)
     */
    private $data;

    /**
     * @var string
     *
     * @ORM\Column(name="presenca_falta", type="string", length=1, nullable=false)
     */
    private $presencaFalta;

    /**
     * @var string
     *
     * @ORM\Column(name="levar", type="string", length=1, nullable=false)
     */
    private $levar;

    /**
     * @var string
     *
     * @ORM\Column(name="entregar", type="string", length=1, nullable=false)
     */
    private $entregar;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \MRS\SgeBundle\Entity\Justificativa
     *
     * @ORM\ManyToOne(targetEntity="MRS\SgeBundle\Entity\Justificativa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="justificativa_id", referencedColumnName="id")
     * })
     */
    private $justificativa;

    /**
     * @var \MRS\SgeBundle\Entity\Escola
     *
     * @ORM\ManyToOne(targetEntity="MRS\SgeBundle\Entity\Escola")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="escola_id", referencedColumnName="id")
     * })
     */
    private $escola;

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
     * Set diaSemana
     *
     * @param \DateTime $diaSemana
     * @return Frequencia
     */
    public function setDiaSemana($diaSemana)
    {
        $this->diaSemana = $diaSemana;

        return $this;
    }

    /**
     * Get diaSemana
     *
     * @return \DateTime 
     */
    public function getDiaSemana()
    {
        return $this->diaSemana;
    }

    /**
     * Set data
     *
     * @param \DateTime $data
     * @return Frequencia
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime 
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set presencaFalta
     *
     * @param string $presencaFalta
     * @return Frequencia
     */
    public function setPresencaFalta($presencaFalta)
    {
        $this->presencaFalta = $presencaFalta;

        return $this;
    }

    /**
     * Get presencaFalta
     *
     * @return string 
     */
    public function getPresencaFalta()
    {
        return $this->presencaFalta;
    }

    /**
     * Set levar
     *
     * @param string $levar
     * @return Frequencia
     */
    public function setLevar($levar)
    {
        $this->levar = $levar;

        return $this;
    }

    /**
     * Get levar
     *
     * @return string 
     */
    public function getLevar()
    {
        return $this->levar;
    }

    /**
     * Set entregar
     *
     * @param string $entregar
     * @return Frequencia
     */
    public function setEntregar($entregar)
    {
        $this->entregar = $entregar;

        return $this;
    }

    /**
     * Get entregar
     *
     * @return string 
     */
    public function getEntregar()
    {
        return $this->entregar;
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
     * Set justificativa
     *
     * @param \MRS\SgeBundle\Entity\Justificativa $justificativa
     * @return Frequencia
     */
    public function setJustificativa(\MRS\SgeBundle\Entity\Justificativa $justificativa = null)
    {
        $this->justificativa = $justificativa;

        return $this;
    }

    /**
     * Get justificativa
     *
     * @return \MRS\SgeBundle\Entity\Justificativa 
     */
    public function getJustificativa()
    {
        return $this->justificativa;
    }

    /**
     * Set escola
     *
     * @param \MRS\SgeBundle\Entity\Escola $escola
     * @return Frequencia
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

    /**
     * Set aluno
     *
     * @param \MRS\SgeBundle\Entity\Aluno $aluno
     * @return Frequencia
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
