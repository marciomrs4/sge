<?php

namespace MRS\SgeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use MRS\SgeBundle\Entity\Veiculo;
use MRS\SgeBundle\Form\VeiculoType;

/**
 * Veiculo controller.
 *
 * @Route("/cadastro/veiculo")
 */
class VeiculoController extends Controller
{
    /**
     * Lists all Veiculo entities.
     *
     * @Route("/", name="cadastro_veiculo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $veiculos = $em->getRepository('MRSSgeBundle:Veiculo')->findAll();

        return $this->render('veiculo/index.html.twig', array(
            'veiculos' => $veiculos,
        ));
    }

    /**
     * Creates a new Veiculo entity.
     *
     * @Route("/new", name="cadastro_veiculo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $veiculo = new Veiculo();
        $form = $this->createForm('MRS\SgeBundle\Form\VeiculoType', $veiculo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($veiculo);
            $em->flush();

            $this->addFlash('notice','Criado com sucesso!');

            return $this->redirectToRoute('cadastro_veiculo_show', array('id' => $veiculo->getId()));
        }

        return $this->render('veiculo/new.html.twig', array(
            'veiculo' => $veiculo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Veiculo entity.
     *
     * @Route("/{id}", name="cadastro_veiculo_show")
     * @Method("GET")
     */
    public function showAction(Veiculo $veiculo)
    {
        $deleteForm = $this->createDeleteForm($veiculo);

        return $this->render('veiculo/show.html.twig', array(
            'veiculo' => $veiculo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Veiculo entity.
     *
     * @Route("/{id}/edit", name="cadastro_veiculo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Veiculo $veiculo)
    {
        $deleteForm = $this->createDeleteForm($veiculo);
        $editForm = $this->createForm('MRS\SgeBundle\Form\VeiculoType', $veiculo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($veiculo);
            $em->flush();

            $this->addFlash('notice','Alterado com sucesso!');

            return $this->redirectToRoute('cadastro_veiculo_show', array('id' => $veiculo->getId()));
        }

        return $this->render('veiculo/edit.html.twig', array(
            'veiculo' => $veiculo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Veiculo entity.
     *
     * @Route("/{id}", name="cadastro_veiculo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Veiculo $veiculo)
    {
        $form = $this->createDeleteForm($veiculo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($veiculo);
            $em->flush();
        }

        return $this->redirectToRoute('cadastro_veiculo_index');
    }

    /**
     * Creates a form to delete a Veiculo entity.
     *
     * @param Veiculo $veiculo The Veiculo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Veiculo $veiculo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cadastro_veiculo_delete', array('id' => $veiculo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
