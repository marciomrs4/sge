<?php

namespace MRS\SgeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contratos
 *
 * @ORM\Table(name="contratos", indexes={@ORM\Index(name="contrato_id_aluno_id_idx", columns={"aluno_id"})})
 * @ORM\Entity
 */
class Contratos
{
    /**
     * @var string
     *
     * @ORM\Column(name="termo_compromisso", type="text", length=65535, nullable=false)
     */
    private $termoCompromisso;

    /**
     * @var string
     *
     * @ORM\Column(name="financas_criada", type="text", length=1, nullable=false)
     */
    private $financasCriada;

    /**
     * @var string
     *
     * @ORM\Column(name="finalizado", type="text", length=1, nullable=false)
     */
    private $finalizado;

    /**
     * @var \DateTime
     * @ORM\Column(name="data_contrato_inicial", type="date", nullable=false)
     */
    private $dataContratoInicial;

    /**
     * @var \DateTime
     * @ORM\Column(name="data_contrato_final", type="date", nullable=false)
     */
    private $dataContratoFinal;

    /**
     * @var integer
     * @ORM\Column(name="numero_parcelas", type="integer", nullable=false)
     */
    private $numeroParcelas;

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


    public function __construct()
    {
        $this->termoCompromisso =
            '1 - No início do ano letivo deverá ser pago fevereiro e a matrícula;
2-	O vencimento das mensalidades será todo dia ___ de cada mês. Após esta data terá multa de ___ %;
3-	As parcelas serão corrigidas toda vez que houver aumento do combustível, ou do Transporte coletivo e dissídio;
4-	Havendo excursões e passeios, o aluno não será transportado pelo transporte escolar;
5-	Não nos responsabilizamos pela criança que entra e for dispensado fora do horário.
6-	O aluno(a) deverá estar pronto na porta de sua residência para que não haja atraso no horário estabelecido pela escola.
7-	Qualquer aviso importante deverá ser dado com antecedência, por telefone ou pessoalmente.
8-	Os pais ou responsável deverão indicar o local e a pessoa a quem o aluno poderá ser entregue na ausência dos mesmos. Em hipótese alguma o aluno será entregue a terceiros sem comunicação direta dos pais.
9-	É reservado ao motorista alterar o horário de pegar e entregar a criança de acordo com o itinerário e trânsito.
10-	Em período semestral o veículo deverá se apresentar ao CIRETRAN e o INMETRO, para as devidas vistorias obrigatórias, serão dois dias no ano, e nestes dias o transporte não será feito, porém avisaremos com quinze dias de antecedência.
';

        $this->dataContratoInicial = new \DateTime('now');

        $date = new \DateTime('now');
        $this->dataContratoFinal = $date->modify('+12 month');

        $this->numeroParcelas = 12;
    }


    /**
     * Set termoCompromisso
     *
     * @param string $termoCompromisso
     * @return Contratos
     */
    public function setTermoCompromisso($termoCompromisso)
    {
        $this->termoCompromisso = $termoCompromisso;

        return $this;
    }

    /**
     * Get termoCompromisso
     *
     * @return string
     */
    public function getTermoCompromisso()
    {
        return $this->termoCompromisso;
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
     * @return Contratos
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

    /**
     * Set dataContratoFinal
     *
     * @param \DateTime $dataContratoFinal
     * @return Contratos
     */
    public function setDataContratoFinal($dataContratoFinal)
    {
        $this->dataContratoFinal = $dataContratoFinal;

        return $this;
    }

    /**
     * Get dataContratoFinal
     *
     * @return \DateTime
     */
    public function getDataContratoFinal()
    {
        return $this->dataContratoFinal;
    }

    /**
     * Set numeroParcelas
     *
     * @param integer $numeroParcelas
     * @return Contratos
     */
    public function setNumeroParcelas($numeroParcelas)
    {
        $this->numeroParcelas = $numeroParcelas;

        return $this;
    }

    /**
     * Get numeroParcelas
     *
     * @return integer
     */
    public function getNumeroParcelas()
    {
        return $this->numeroParcelas;
    }

    /**
     * Set dataContratoInicial
     *
     * @param \DateTime $dataContratoInicial
     * @return Contratos
     */
    public function setDataContratoInicial($dataContratoInicial)
    {
        $this->dataContratoInicial = $dataContratoInicial;

        return $this;
    }

    /**
     * Get dataContratoInicial
     *
     * @return \DateTime
     */
    public function getDataContratoInicial()
    {
        return $this->dataContratoInicial;
    }

    /**
     * Set financasCriada
     *
     * @param string $financasCriada
     * @return Contratos
     */
    public function setFinancasCriada($financasCriada)
    {
        $this->financasCriada = $financasCriada;

        return $this;
    }

    /**
     * Get financasCriada
     *
     * @return string
     */
    public function getFinancasCriada()
    {
        return $this->financasCriada;
    }

    /**
     * Set finalizado
     *
     * @param string $finalizado
     * @return Contratos
     */
    public function setFinalizado($finalizado)
    {
        $this->finalizado = $finalizado;

        return $this;
    }

    /**
     * Get finalizado
     *
     * @return string
     */
    public function getFinalizado()
    {
        return $this->finalizado;
    }
}
