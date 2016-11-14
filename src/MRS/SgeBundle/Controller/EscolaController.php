<?php

namespace MRS\SgeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use MRS\SgeBundle\Entity\Escola;
use MRS\SgeBundle\Form\EscolaType;

/**
 * Escola controller.
 *
 * @Route("/cadastro/escola")
 */
class EscolaController extends Controller
{
    /**
     * Lists all Escola entities.
     *
     * @Route("/", name="cadastro_escola_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $escolas = $em->getRepository('MRSSgeBundle:Escola')->findAll();

        return $this->render('escola/index.html.twig', array(
            'escolas' => $escolas,
        ));
    }

    /**
     * Creates a new Escola entity.
     *
     * @Route("/new", name="cadastro_escola_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $escola = new Escola();
        $form = $this->createForm('MRS\SgeBundle\Form\EscolaType', $escola);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($escola);
            $em->flush();

            $this->addFlash('notice','Criado com sucesso!');

            return $this->redirectToRoute('cadastro_escola_show', array('id' => $escola->getId()));
        }

        return $this->render('escola/new.html.twig', array(
            'escola' => $escola,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Escola entity.
     *
     * @Route("/{id}", name="cadastro_escola_show")
     * @Method("GET")
     */
    public function showAction(Escola $escola)
    {
        return $this->render('escola/show.html.twig', array(
            'escola' => $escola,
        ));
    }

    /**
     * Displays a form to edit an existing Escola entity.
     *
     * @Route("/{id}/edit", name="cadastro_escola_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Escola $escola)
    {
        $deleteForm = $this->createDeleteForm($escola);
        $editForm = $this->createForm('MRS\SgeBundle\Form\EscolaType', $escola);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($escola);
            $em->flush();

            $this->addFlash('notice','Alterado com sucesso!');

            return $this->redirectToRoute('cadastro_escola_show', array('id' => $escola->getId()));
        }

        return $this->render('escola/edit.html.twig', array(
            'escola' => $escola,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Escola entity.
     *
     * @Route("/{id}", name="cadastro_escola_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Escola $escola)
    {
        $form = $this->createDeleteForm($escola);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($escola);
            $em->flush();
        }

        return $this->redirectToRoute('cadastro_escola_index');
    }

    /**
     * Creates a form to delete a Escola entity.
     *
     * @param Escola $escola The Escola entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Escola $escola)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cadastro_escola_delete', array('id' => $escola->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
