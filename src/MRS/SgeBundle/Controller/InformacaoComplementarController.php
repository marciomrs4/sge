<?php

namespace MRS\SgeBundle\Controller;

use MRS\SgeBundle\Entity\Aluno;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use MRS\SgeBundle\Entity\InformacaoComplementar;
use MRS\SgeBundle\Form\InformacaoComplementarType;

/**
 * InformacaoComplementar controller.
 *
 * @Route("/cadastro/informacaocomplementar")
 */
class InformacaoComplementarController extends Controller
{
    /**
     * Lists all InformacaoComplementar entities.
     *
     * @Route("/", name="cadastro_informacaocomplementar_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $informacaoComplementars = $em->getRepository('MRSSgeBundle:InformacaoComplementar')->findAll();

        return $this->render('informacaocomplementar/index.html.twig', array(
            'informacaoComplementars' => $informacaoComplementars,
        ));
    }

    /**
     * Creates a new InformacaoComplementar entity.
     *
     * @Route("/new/{aluno}", name="cadastro_informacaocomplementar_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Aluno $aluno, Request $request)
    {
        $informacaoComplementar = new InformacaoComplementar();
        $form = $this->createForm('MRS\SgeBundle\Form\InformacaoComplementarType', $informacaoComplementar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $informacaoComplementar->setAluno($aluno);

            $em->persist($informacaoComplementar);
            $em->flush();

            $this->addFlash('notice','Criado com sucesso!');

            return $this->redirectToRoute('cadastro_aluno_show', array('id' => $informacaoComplementar->getAluno()->getId()));
        }

        return $this->render('informacaocomplementar/new.html.twig', array(
            'informacaoComplementar' => $informacaoComplementar,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a InformacaoComplementar entity.
     *
     * @Route("/{id}", name="cadastro_informacaocomplementar_show")
     * @Method("GET")
     */
    public function showAction(InformacaoComplementar $informacaoComplementar)
    {
        $deleteForm = $this->createDeleteForm($informacaoComplementar);

        return $this->render('informacaocomplementar/show.html.twig', array(
            'informacaoComplementar' => $informacaoComplementar,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing InformacaoComplementar entity.
     *
     * @Route("/{id}/edit", name="cadastro_informacaocomplementar_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, InformacaoComplementar $informacaoComplementar)
    {
        $deleteForm = $this->createDeleteForm($informacaoComplementar);
        $editForm = $this->createForm('MRS\SgeBundle\Form\InformacaoComplementarType', $informacaoComplementar);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($informacaoComplementar);
            $em->flush();

            $this->addFlash('notice','Alterado com sucesso!');

            return $this->redirectToRoute('cadastro_informacaocomplementar_show', array('id' => $informacaoComplementar->getId()));
        }

        return $this->render('informacaocomplementar/edit.html.twig', array(
            'informacaoComplementar' => $informacaoComplementar,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a InformacaoComplementar entity.
     *
     * @Route("/{id}", name="cadastro_informacaocomplementar_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, InformacaoComplementar $informacaoComplementar)
    {
        $form = $this->createDeleteForm($informacaoComplementar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($informacaoComplementar);
            $em->flush();
        }

        return $this->redirectToRoute('cadastro_informacaocomplementar_index');
    }

    /**
     * Creates a form to delete a InformacaoComplementar entity.
     *
     * @param InformacaoComplementar $informacaoComplementar The InformacaoComplementar entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InformacaoComplementar $informacaoComplementar)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cadastro_informacaocomplementar_delete', array('id' => $informacaoComplementar->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
