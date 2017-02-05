<?php

namespace MRS\SgeBundle\Controller;

use MRS\SgeBundle\Entity\Pais;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use MRS\SgeBundle\Entity\Aluno;
use MRS\SgeBundle\Form\AlunoType;

/**
 * Aluno controller.
 *
 * @Route("/cadastro/aluno")
 */
class AlunoController extends Controller
{

    /**
     * Lists all Aluno entities.
     *
     * @Route("/todos", name="cadastro_aluno_all")
     * @Method("GET")
     */
    public function listarAlunosAction()
    {
        $em = $this->getDoctrine()->getManager();

        $alunos = $em->getRepository('MRSSgeBundle:Aluno')
            ->findAll();

        return $this->render('aluno/listaralunos.html.twig', array(
            'alunos' => $alunos,
        ));
    }

    /**
     * Lists all Aluno entities by Pai.
     *
     * @Route("/{pai}", name="cadastro_aluno_index")
     * @Method("GET")
     */
    public function indexAction(Pais $pai)
    {
        $em = $this->getDoctrine()->getManager();

        $alunos = $em->getRepository('MRSSgeBundle:Aluno')
            ->findBy(array('pais'=>$pai));

        return $this->render('aluno/index.html.twig', array(
            'alunos' => $alunos,
        ));
    }

    /**
     * Creates a new Aluno entity.
     *
     * @Route("/new/{pai}", name="cadastro_aluno_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Pais $pai, Request $request)
    {
        $aluno = new Aluno();
        $form = $this->createForm('MRS\SgeBundle\Form\AlunoType', $aluno);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $alunoForm = $request->request->get('aluno');

            //dump($aluno['turnoEscola']); exit();

            $em = $this->getDoctrine()->getManager();

            $turnoEscola = $em->getRepository('MRSSgeBundle:TurnoHasEscola')
                ->find($alunoForm['turnoEscola']);


            $aluno->setPais($pai)
                  ->setEscola($turnoEscola->getEscola())
                  ->setTurno($turnoEscola->getTurno());

            $em->persist($aluno);
            $em->flush();

            $this->addFlash('notice','Criado com sucesso!');

            return $this->redirectToRoute('cadastro_aluno_show', array('id' => $aluno->getId()));
        }

        return $this->render('aluno/new.html.twig', array(
            'aluno' => $aluno,
            'pai' => $pai,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Aluno entity.
     *
     * @Route("/{id}/show", name="cadastro_aluno_show")
     * @Method("GET")
     */
    public function showAction(Aluno $aluno)
    {
        $deleteForm = $this->createDeleteForm($aluno);

        return $this->render('aluno/show.html.twig', array(
            'aluno' => $aluno,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Aluno entity.
     *
     * @Route("/{id}/edit", name="cadastro_aluno_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Aluno $aluno)
    {
        $deleteForm = $this->createDeleteForm($aluno);

        $em = $this->getDoctrine()->getManager();

        $turnoEscola = $em->getRepository('MRSSgeBundle:TurnoHasEscola')
            ->findOneBy(array('escola' => $aluno->getEscola(),
                             'turno' => $aluno->getTurno()));

        $editForm = $this->createForm('MRS\SgeBundle\Form\AlunoType', $aluno);

        $editForm->get('turnoEscola')->setData($turnoEscola);

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $alunoForm = $request->request->get('aluno');


            $turnoEscola = $em->getRepository('MRSSgeBundle:TurnoHasEscola')
                ->find($alunoForm['turnoEscola']);

            $aluno->setEscola($turnoEscola->getEscola())
                  ->setTurno($turnoEscola->getTurno());

            $em->persist($aluno);
            $em->flush();

            $this->addFlash('notice','Alterado com sucesso!');

            return $this->redirectToRoute('cadastro_aluno_show', array('id' => $aluno->getId()));
        }

        return $this->render('aluno/edit.html.twig', array(
            'aluno' => $aluno,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Aluno entity.
     *
     * @Route("/{id}", name="cadastro_aluno_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Aluno $aluno)
    {
        $form = $this->createDeleteForm($aluno);
        $form->handleRequest($request);

        $paiId = $aluno->getPais()->getId();

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($aluno);
            $em->flush();
        }

        return $this->redirectToRoute('cadastro_pais_show',array('id' => $paiId));
    }

    /**
     * Creates a form to delete a Aluno entity.
     *
     * @param Aluno $aluno The Aluno entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Aluno $aluno)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cadastro_aluno_delete', array('id' => $aluno->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
