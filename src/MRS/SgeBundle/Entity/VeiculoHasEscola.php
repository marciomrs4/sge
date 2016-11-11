<?php

namespace MRS\SgeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VeiculoHasEscola
 *
 * @ORM\Table(name="veiculo_has_escola", uniqueConstraints={@ORM\UniqueConstraint(name="unique_escola_veiculo", columns={"escola_id", "veiculo_id"})}, indexes={@ORM\Index(name="fk_veiculo_has_escola_escola1_idx", columns={"escola_id"}), @ORM\Index(name="fk_veiculo_has_escola_veiculo1_idx", columns={"veiculo_id"})})
 * @ORM\Entity
 */
class VeiculoHasEscola
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
     * @var \MRS\SgeBundle\Entity\Veiculo
     *
     * @ORM\ManyToOne(targetEntity="MRS\SgeBundle\Entity\Veiculo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="veiculo_id", referencedColumnName="id")
     * })
     */
    private $veiculo;

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
     * Set veiculo
     *
     * @param \MRS\SgeBundle\Entity\Veiculo $veiculo
     * @return VeiculoHasEscola
     */
    public function setVeiculo(\MRS\SgeBundle\Entity\Veiculo $veiculo = null)
    {
        $this->veiculo = $veiculo;

        return $this;
    }

    /**
     * Get veiculo
     *
     * @return \MRS\SgeBundle\Entity\Veiculo 
     */
    public function getVeiculo()
    {
        return $this->veiculo;
    }

    /**
     * Set escola
     *
     * @param \MRS\SgeBundle\Entity\Escola $escola
     * @return VeiculoHasEscola
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
