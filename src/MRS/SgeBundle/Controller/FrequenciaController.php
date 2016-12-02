<?php

namespace MRS\SgeBundle\Controller;

use MRS\SgeBundle\Entity\Aluno;
use MRS\SgeBundle\Entity\Turno;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use MRS\SgeBundle\Entity\Frequencia;
use MRS\SgeBundle\Form\FrequenciaType;

/**
 * Frequencia controller.
 *
 * @Route("/cadastro/frequencia")
 */
class FrequenciaController extends Controller
{
    /**
     * Lists all Frequencia entities.
     *
     * @Route("/{turno}", name="cadastro_frequencia_index")
     * @Method("GET")
     */
    public function indexAction(Turno $turno = null)
    {
        if(!$turno){

            return $this->redirectToRoute('cadastro_frequencia_index',array('turno' => 1));

        }else {

            $em = $this->getDoctrine()->getManager();

            $alunos = $em->getRepository('MRSSgeBundle:Frequencia')
                ->listFrequenciaByTurno($turno->getId());

            $turnos = $em->getRepository('MRSSgeBundle:Turno')
                ->findAll();

            return $this->render('frequencia/index.html.twig', array(
                'alunos' => $alunos,
                'turnos' => $turnos
            ));
        }
    }

    /**
     * Creates a new Frequencia entity.
     *
     * @Route("/new/{aluno}", name="cadastro_frequencia_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Aluno $aluno, Request $request)
    {
        $frequencium = new Frequencia();

        $date = new \DateTime('now');
        $frequencium->setAluno($aluno)
            ->setEscola($aluno->getEscola())
            ->setTurno($aluno->getTurno())
            ->setData($date)
            ->setDiaSemana($date)
            ->setLevar('1')
            ->setPresencaFalta('1');

            $em = $this->getDoctrine()->getManager();
            $em->persist($frequencium);
            $em->flush();

            return $this->redirectToRoute('cadastro_frequencia_index',array('turno' => $aluno->getTurno()->getId()));

    }

    /**
     * Finds and displays a Frequencia entity.
     *
     * @Route("/{id}", name="cadastro_frequencia_show")
     * @Method("GET")
     */
    public function showAction(Frequencia $frequencium)
    {
        $deleteForm = $this->createDeleteForm($frequencium);

        return $this->render('frequencia/show.html.twig', array(
            'frequencium' => $frequencium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Frequencia entity.
     *
     * @Route("/{id}/edit", name="cadastro_frequencia_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Frequencia $frequencium)
    {
        $deleteForm = $this->createDeleteForm($frequencium);
        $editForm = $this->createForm('MRS\SgeBundle\Form\FrequenciaType', $frequencium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($frequencium);
            $em->flush();

            $this->addFlash('notice','Alterado com sucesso!');

            return $this->redirectToRoute('cadastro_frequencia_show', array('id' => $frequencium->getId()));
        }

        return $this->render('frequencia/edit.html.twig', array(
            'frequencium' => $frequencium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Frequencia entity.
     *
     * @Route("/{id}", name="cadastro_frequencia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Frequencia $frequencium)
    {
        $form = $this->createDeleteForm($frequencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($frequencium);
            $em->flush();
        }

        return $this->redirectToRoute('cadastro_frequencia_index');
    }

    /**
     * Creates a form to delete a Frequencia entity.
     *
     * @param Frequencia $frequencium The Frequencia entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Frequencia $frequencium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cadastro_frequencia_delete', array('id' => $frequencium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
