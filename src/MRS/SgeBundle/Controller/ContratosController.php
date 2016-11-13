<?php

namespace MRS\SgeBundle\Controller;

use MRS\SgeBundle\Entity\Aluno;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use MRS\SgeBundle\Entity\Contratos;
use MRS\SgeBundle\Form\ContratosType;

/**
 * Contratos controller.
 *
 * @Route("/cadastro/contratos")
 */
class ContratosController extends Controller
{
    /**
     * Lists all Contratos entities.
     *
     * @Route("/", name="cadastro_contratos_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $contratos = $em->getRepository('MRSSgeBundle:Contratos')->findAll();

        return $this->render('contratos/index.html.twig', array(
            'contratos' => $contratos,
        ));
    }

    /**
     * Creates a new Contratos entity.
     *
     * @Route("/new/{aluno}", name="cadastro_contratos_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Aluno $aluno, Request $request)
    {
        $contratoExistente = $this->getDoctrine()
            ->getRepository('MRSSgeBundle:Contratos')
            ->findOneBy(array('aluno' => $aluno));

        if($contratoExistente){
            return $this->redirectToRoute('cadastro_contratos_show', array('id' => $contratoExistente->getId()));
        }

        $contrato = new Contratos();
        $form = $this->createForm('MRS\SgeBundle\Form\ContratosType', $contrato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $contrato->setAluno($aluno);
            $em->persist($contrato);
            $em->flush();

            $this->addFlash('notice','Criado com sucesso!');

            return $this->redirectToRoute('cadastro_contratos_show', array('id' => $contrato->getId()));
        }

        return $this->render('contratos/new.html.twig', array(
            'contrato' => $contrato,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Contratos entity.
     *
     * @Route("/{id}", name="cadastro_contratos_show")
     * @Method("GET")
     */
    public function showAction(Contratos $contrato)
    {
        $deleteForm = $this->createDeleteForm($contrato);

        return $this->render('contratos/show.html.twig', array(
            'contrato' => $contrato,
        ));
    }

    /**
     * Displays a form to edit an existing Contratos entity.
     *
     * @Route("/{id}/edit", name="cadastro_contratos_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Contratos $contrato)
    {
        $deleteForm = $this->createDeleteForm($contrato);
        $editForm = $this->createForm('MRS\SgeBundle\Form\ContratosType', $contrato);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contrato);
            $em->flush();

            $this->addFlash('notice','Alterado com sucesso!');

            return $this->redirectToRoute('cadastro_contratos_show', array('id' => $contrato->getId()));
        }

        return $this->render('contratos/edit.html.twig', array(
            'contrato' => $contrato,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Contratos entity.
     *
     * @Route("/{id}", name="cadastro_contratos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Contratos $contrato)
    {
        $form = $this->createDeleteForm($contrato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($contrato);
            $em->flush();
        }

        return $this->redirectToRoute('cadastro_contratos_index');
    }

    /**
     * Creates a form to delete a Contratos entity.
     *
     * @param Contratos $contrato The Contratos entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Contratos $contrato)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cadastro_contratos_delete', array('id' => $contrato->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
