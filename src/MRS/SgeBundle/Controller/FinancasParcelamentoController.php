<?php

namespace MRS\SgeBundle\Controller;

use MRS\SgeBundle\Entity\Financas;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use MRS\SgeBundle\Entity\FinancasParcelamento;
use MRS\SgeBundle\Form\FinancasParcelamentoType;

/**
 * FinancasParcelamento controller.
 *
 * @Route("/cadastro/financasparcelamento")
 */
class FinancasParcelamentoController extends Controller
{
    /**
     * Lists all FinancasParcelamento entities.
     *
     * @Route("/{financa}", name="cadastro_financasparcelamento_index")
     * @Method("GET")
     */
    public function indexAction(Financas $financa)
    {
        $em = $this->getDoctrine()->getManager();

        $financasParcelamentos = $em->getRepository('MRSSgeBundle:FinancasParcelamento')
            ->findBy(array('financas' => $financa));

        return $this->render('financasparcelamento/index.html.twig', array(
            'financasParcelamentos' => $financasParcelamentos,
            'financa' => $financa
        ));
    }

    /**
     * Creates a new FinancasParcelamento entity.
     *
     * @Route("/new/{financa}", name="cadastro_financasparcelamento_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Financas $financa, Request $request)
    {
        $financasParcelamento = new FinancasParcelamento();

        $financasParcelamento->setFinancas($financa);

        $form = $this->createForm('MRS\SgeBundle\Form\FinancasParcelamentoType', $financasParcelamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $valorpago = $financa->getValorTotalPago();

            $valorparcial = $financasParcelamento->getValorParcial();

            $valorTotal = $valorpago+$valorparcial;

            $financa->setValorTotalPago($valorTotal);

            if($financa->getValorTotalPago() >= $financa->getAluno()->getValorMensalidade()){

                $financa->setDataPagamento($financasParcelamento->getDataPagamento())
                    ->setStatus('0');

            }

            $em->persist($financa);
            $em->persist($financasParcelamento);
            $em->flush();


            $this->addFlash('notice','Criado com sucesso!');

            return $this->redirectToRoute('cadastro_financas_show', array('id' => $financa->getId()));
        }

        return $this->render('financasparcelamento/new.html.twig', array(
            'financasParcelamento' => $financasParcelamento,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a FinancasParcelamento entity.
     *
     * @Route("/{id}/show", name="cadastro_financasparcelamento_show")
     * @Method("GET")
     */
    public function showAction(FinancasParcelamento $financasParcelamento)
    {
        $deleteForm = $this->createDeleteForm($financasParcelamento);

        return $this->render('financasparcelamento/show.html.twig', array(
            'financasParcelamento' => $financasParcelamento,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing FinancasParcelamento entity.
     *
     * @Route("/{id}/edit", name="cadastro_financasparcelamento_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, FinancasParcelamento $financasParcelamento)
    {

        $valorParcialAntigo = $financasParcelamento->getValorParcial();

        $deleteForm = $this->createDeleteForm($financasParcelamento);
        $editForm = $this->createForm('MRS\SgeBundle\Form\FinancasParcelamentoType', $financasParcelamento);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $financa = $financasParcelamento->getFinancas();

            $valorTotalpago = $financa->getValorTotalPago();

            $valorInformado = $financasParcelamento->getValorParcial();

            $valorRestante = ($valorTotalpago-$valorParcialAntigo)+$valorInformado;

            $financa->setValorTotalPago($valorRestante);

            if($financa->getValorTotalPago() >= $financa->getAluno()->getValorMensalidade()){

                $financa->setStatus('0')
                    ->setDataPagamento($financasParcelamento->getDataPagamento());

            }

            $em->persist($financa);
            $em->persist($financasParcelamento);
            $em->flush();


            $this->addFlash('notice','Alterado com sucesso!');

            return $this->redirectToRoute('cadastro_financas_show', array('id' => $financasParcelamento->getFinancas()->getId()));
        }

        return $this->render('financasparcelamento/edit.html.twig', array(
            'financasParcelamento' => $financasParcelamento,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a FinancasParcelamento entity.
     *
     * @Route("/{id}", name="cadastro_financasparcelamento_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, FinancasParcelamento $financasParcelamento)
    {
        $financa = $financasParcelamento->getFinancas();

        $form = $this->createDeleteForm($financasParcelamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $valorParcial = $financasParcelamento->getValorParcial();

            $valorTotalpago = $financa->getValorTotalPago();

            $valotAtual = $valorTotalpago - $valorParcial;

            $financa->setValorTotalPago($valotAtual);

            $em->persist($financa);
            $em->remove($financasParcelamento);
            $em->flush();
        }

        return $this->redirectToRoute('cadastro_financas_show',array('id'=>$financa->getId()));
    }

    /**
     * Creates a form to delete a FinancasParcelamento entity.
     *
     * @param FinancasParcelamento $financasParcelamento The FinancasParcelamento entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FinancasParcelamento $financasParcelamento)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cadastro_financasparcelamento_delete', array('id' => $financasParcelamento->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
