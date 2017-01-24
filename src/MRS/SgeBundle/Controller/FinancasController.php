<?php

namespace MRS\SgeBundle\Controller;

use MRS\SgeBundle\Entity\Aluno;
use MRS\SgeBundle\Entity\Contratos;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use MRS\SgeBundle\Entity\Financas;
use MRS\SgeBundle\Form\FinancasType;

/**
 * Financas controller.
 *
 * @Route("/cadastro/financas")
 */
class FinancasController extends Controller
{
    /**
     * Lists all Financas entities.
     *
     * @Route("/", name="cadastro_financas_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $financas = $em->getRepository('MRSSgeBundle:Financas')
            ->findAllFinancasPendentes();

        return $this->render('financas/index.html.twig', array(
            'financas' => $financas,
        ));
    }

    /**
     * Lists all Financas entities by filters.
     *
     * @Route("/report", name="cadastro_financas_report")
     * @Method("GET|POST")
     */
    public function reportAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $formReport = $this->createForm('MRS\SgeBundle\Form\FinancasReportType');

        $date = new \DateTime('now');

        $formReport->get('dataFinal')->setData($date);

        $date->modify('-1 month');
        $formReport->get('dataInicial')->setData($date);

        $data = $request->request->get('financa_report');

        if($request->isMethod('POST')){
            $formReport->handleRequest($request);
        }

        $financas = $em->getRepository('MRSSgeBundle:Financas')
            ->findAllFinancasFiltered($data);

        $recebido = $em->getRepository('MRSSgeBundle:Financas')
            ->recebidoNoPeriodo($data);

        $pendente = $em->getRepository('MRSSgeBundle:Financas')
            ->pendenteNoPeriodo($data);

        return $this->render('financas/report.html.twig', array(
            'financas' => $financas,
            'recebido' => $recebido,
            'pendente' => $pendente,
            'formReport' => $formReport->createView()
        ));
    }

    /**
     * Lists all Financas entities.
     *
     * @Route("/{financa}/pay", name="cadastro_financas_checkout_pay")
     * @Method("GET")
     */
    public function checkoutPayAction(Financas $financa)
    {
        $em = $this->getDoctrine()->getManager();

        $financa->setValorTotalPago($financa->getAluno()->getValorMensalidade())
            ->setDataPagamento(new \DateTime('now'))
        ->setStatus('0');

        $em->persist($financa);
        $em->flush();

        return $this->redirectToRoute('cadastro_financas_index');
    }




    /**
     * Creates a list Financas entity.
     *
     * @Route("/new/{contrato}/create", name="cadastro_financas_create_list")
     * @Method({"GET","POST"})
     */
    public function newListAction(Contratos $contrato, Request $request)
    {

        if($contrato->getFinancasCriada() == 1){

            $this->addFlash('notice',"Já existe Lista financeira criada para este contrato!");

            return $this->redirectToRoute('cadastro_contratos_show',array('id' => $contrato->getId()));
        }

        $aluno = $contrato->getAluno();

        if ($request->isMethod('POST')) {

            $parcelas = $contrato->getNumeroParcelas();

            $data = new \DateTime($contrato->getDataContratoInicial()->format('Y-m-d'));
            $em = $this->getDoctrine()->getManager();

            $data->modify('-1 month');

            for($x=1 ; $x <= $parcelas ; $x++) {

                $financa = new Financas();
                $financa->setAluno($aluno);
                $financa->setContrato($contrato);
                $financa->setDataVencimento($data->modify("+1 month"));
                $financa->setStatus('1');

                $contrato->setFinancasCriada('1');

                $em->persist($contrato);
                $em->persist($financa);
                $em->flush();
            }

            $this->addFlash('notice',"Lista financeira do Aluno {$aluno->getNome()} criada com sucesso!");

            return $this->redirectToRoute('cadastro_contratos_show', array('id' => $contrato->getId()));
        }

        return $this->redirectToRoute('cadastro_contratos_show',array('id' => $contrato->getId()));
    }

    /**
     * Creates a new Financas entity.
     *
     * @Route("/new/{aluno}", name="cadastro_financas_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Aluno $aluno, Request $request)
    {
        $financa = new Financas();
        $financa->setAluno($aluno);
        $financa->setValorTotalPago($aluno->getValorMensalidade());
        $financa->setDataPagamento(new \DateTime('now'));

        $form = $this->createForm('MRS\SgeBundle\Form\FinancasType', $financa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($financa);
            $em->flush();

            $this->addFlash('notice','Criado com sucesso!');

            return $this->redirectToRoute('cadastro_financas_show', array('id' => $financa->getId()));
        }

        return $this->render('financas/new.html.twig', array(
            'financa' => $financa,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Financas entity.
     *
     * @Route("/{id}", name="cadastro_financas_show")
     * @Method("GET")
     */
    public function showAction(Financas $financa)
    {
        $deleteForm = $this->createDeleteForm($financa);

        return $this->render('financas/show.html.twig', array(
            'financa' => $financa,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Financas entity.
     *
     * @Route("/{id}/edit", name="cadastro_financas_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Financas $financa)
    {
        $deleteForm = $this->createDeleteForm($financa);
        $editForm = $this->createForm('MRS\SgeBundle\Form\FinancasType', $financa);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($financa);
            $em->flush();

            $this->addFlash('notice','Alterado com sucesso!');

            return $this->redirectToRoute('cadastro_financas_show', array('id' => $financa->getId()));
        }

        return $this->render('financas/edit.html.twig', array(
            'financa' => $financa,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Financas entity.
     *
     * @Route("/{id}", name="cadastro_financas_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Financas $financa)
    {
        $form = $this->createDeleteForm($financa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($financa);
            $em->flush();
        }

        return $this->redirectToRoute('cadastro_financas_index');
    }

    /**
     * Creates a form to delete a Financas entity.
     *
     * @param Financas $financa The Financas entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Financas $financa)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cadastro_financas_delete', array('id' => $financa->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
