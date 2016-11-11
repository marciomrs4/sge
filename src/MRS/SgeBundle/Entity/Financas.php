<?php

namespace MRS\SgeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Financas
 *
 * @ORM\Table(name="financas", indexes={@ORM\Index(name="alu_codigo_on_alu_codigo_idx", columns={"aluno_id"})})
 * @ORM\Entity
 */
class Financas
{
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
     * @ORM\Column(name="pagamento", type="string", length=1, nullable=false)
     */
    private $pagamento;

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
     * Set valorMensalidade
     *
     * @param string $valorMensalidade
     * @return Financas
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
     * @return Financas
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
     * Set pagamento
     *
     * @param string $pagamento
     * @return Financas
     */
    public function setPagamento($pagamento)
    {
        $this->pagamento = $pagamento;

        return $this;
    }

    /**
     * Get pagamento
     *
     * @return string 
     */
    public function getPagamento()
    {
        return $this->pagamento;
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
}
