<?php

namespace MRS\SgeBundle\Controller;

use MRS\SgeBundle\Entity\Pais;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use MRS\SgeBundle\Entity\Logradouro;
use MRS\SgeBundle\Form\LogradouroType;

/**
 * Logradouro controller.
 *
 * @Route("/cadastro/logradouro")
 */
class LogradouroController extends Controller
{
    /**
     * Lists all Logradouro entities.
     *
     * @Route("/", name="cadastro_logradouro_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $logradouros = $em->getRepository('MRSSgeBundle:Logradouro')->findAll();

        return $this->render('logradouro/index.html.twig', array(
            'logradouros' => $logradouros,
        ));
    }

    /**
     * Creates a new Logradouro entity.
     *
     * @Route("/new/{pai}", name="cadastro_logradouro_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Pais $pai, Request $request)
    {
        $logradouroExiste = $this->getDoctrine()
            ->getRepository('MRSSgeBundle:Logradouro')
            ->findOneBy(array('pais' => $pai));

        if($logradouroExiste){
            return $this->redirectToRoute('cadastro_logradouro_show', array('id' => $logradouroExiste->getId()));
        }

        $logradouro = new Logradouro();
        $form = $this->createForm('MRS\SgeBundle\Form\LogradouroType', $logradouro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $logradouro->setPais($pai);
            $em->persist($logradouro);
            $em->flush();

            $this->addFlash('notice','Criado com sucesso!');

            return $this->redirectToRoute('cadastro_pais_show', array('id' => $pai->getId()));
        }

        return $this->render('logradouro/new.html.twig', array(
            'logradouro' => $logradouro,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Logradouro entity.
     *
     * @Route("/{id}", name="cadastro_logradouro_show")
     * @Method("GET")
     */
    public function showAction(Logradouro $logradouro)
    {
        $deleteForm = $this->createDeleteForm($logradouro);

        return $this->render('logradouro/show.html.twig', array(
            'logradouro' => $logradouro,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Logradouro entity.
     *
     * @Route("/{id}/edit", name="cadastro_logradouro_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Logradouro $logradouro)
    {
        $deleteForm = $this->createDeleteForm($logradouro);
        $editForm = $this->createForm('MRS\SgeBundle\Form\LogradouroType', $logradouro);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($logradouro);
            $em->flush();

            $this->addFlash('notice','Alterado com sucesso!');

            return $this->redirectToRoute('cadastro_logradouro_show', array('id' => $logradouro->getId()));
        }

        return $this->render('logradouro/edit.html.twig', array(
            'logradouro' => $logradouro,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Logradouro entity.
     *
     * @Route("/{id}", name="cadastro_logradouro_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Logradouro $logradouro)
    {
        $form = $this->createDeleteForm($logradouro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($logradouro);
            $em->flush();
        }

        return $this->redirectToRoute('cadastro_logradouro_index');
    }

    /**
     * Creates a form to delete a Logradouro entity.
     *
     * @param Logradouro $logradouro The Logradouro entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Logradouro $logradouro)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cadastro_logradouro_delete', array('id' => $logradouro->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
