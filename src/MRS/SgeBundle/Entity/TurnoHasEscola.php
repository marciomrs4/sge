<?php

namespace MRS\SgeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * TurnoHasEscola
 *
 * @ORM\Table(name="turno_has_escola", uniqueConstraints={@ORM\UniqueConstraint(name="unique_escola_turno", columns={"escola_id", "turno_id"})}, indexes={@ORM\Index(name="fk_turno_has_escola_escola1_idx", columns={"escola_id"}), @ORM\Index(name="fk_turno_has_escola_turno1_idx", columns={"turno_id"})})
 * @ORM\Entity
 */
class TurnoHasEscola
{
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
     * @Assert\NotBlank(message="Turno é obrigatório")
     */
    private $turno;

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
     * @return TurnoHasEscola
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
     * Set escola
     *
     * @param \MRS\SgeBundle\Entity\Escola $escola
     * @return TurnoHasEscola
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

    public function __toString()
    {
        return $this->getEscola()->getNome().' / '.$this->getTurno()->getDescricao();
    }
}
