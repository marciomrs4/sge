<?php

namespace MRS\SgeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use MRS\SgeBundle\Entity\Turno;
use MRS\SgeBundle\Form\TurnoType;

/**
 * Turno controller.
 *
 * @Route("/cadastro/turno")
 */
class TurnoController extends Controller
{
    /**
     * Lists all Turno entities.
     *
     * @Route("/", name="cadastro_turno_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $turnos = $em->getRepository('MRSSgeBundle:Turno')->findAll();

        return $this->render('turno/index.html.twig', array(
            'turnos' => $turnos,
        ));
    }

    /**
     * Creates a new Turno entity.
     *
     * @Route("/new", name="cadastro_turno_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $turno = new Turno();
        $form = $this->createForm('MRS\SgeBundle\Form\TurnoType', $turno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($turno);
            $em->flush();

            $this->addFlash('notice','Criado com sucesso!');

            return $this->redirectToRoute('cadastro_turno_show', array('id' => $turno->getId()));
        }

        return $this->render('turno/new.html.twig', array(
            'turno' => $turno,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Turno entity.
     *
     * @Route("/{id}", name="cadastro_turno_show")
     * @Method("GET")
     */
    public function showAction(Turno $turno)
    {
        $deleteForm = $this->createDeleteForm($turno);

        return $this->render('turno/show.html.twig', array(
            'turno' => $turno,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Turno entity.
     *
     * @Route("/{id}/edit", name="cadastro_turno_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Turno $turno)
    {
        $deleteForm = $this->createDeleteForm($turno);
        $editForm = $this->createForm('MRS\SgeBundle\Form\TurnoType', $turno);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($turno);
            $em->flush();

            $this->addFlash('notice','Alterado com sucesso!');

            return $this->redirectToRoute('cadastro_turno_show', array('id' => $turno->getId()));
        }

        return $this->render('turno/edit.html.twig', array(
            'turno' => $turno,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Turno entity.
     *
     * @Route("/{id}", name="cadastro_turno_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Turno $turno)
    {
        $form = $this->createDeleteForm($turno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($turno);
            $em->flush();
        }

        return $this->redirectToRoute('cadastro_turno_index');
    }

    /**
     * Creates a form to delete a Turno entity.
     *
     * @param Turno $turno The Turno entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Turno $turno)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cadastro_turno_delete', array('id' => $turno->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
