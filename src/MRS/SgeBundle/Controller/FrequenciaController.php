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
 * @Route("/registro/frequencia")
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
        $em = $this->getDoctrine()->getManager();

        if(!$turno){

            $turnoEncontrado = $em->getRepository('MRSSgeBundle:Turno')
                ->finOneByFirstResult();

            return $this->redirectToRoute('cadastro_frequencia_index', array(
                'turno' => $turnoEncontrado->getId()
            ));

        }else {

            $em = $this->getDoctrine()->getManager();

            $alunos = $em->getRepository('MRSSgeBundle:Aluno')
                ->findBy(array('turno'=>$turno));

            $frequenciaQuantidade = $em->getRepository('MRSSgeBundle:Frequencia')
                ->countFrequenciaBy($turno, date('Y-m-d'));

            $turnos = $em->getRepository('MRSSgeBundle:Turno')
                ->findAll();

            return $this->render('frequencia/index.html.twig', array(
                'turnos' => $turnos,
                'turnoAtual' => $turno,
                'alunos' => $alunos,
                'frequenciaQuantidade' => $frequenciaQuantidade
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
     * @Route("/validate/levar/{aluno}",name="cadastro_frequencia_validate_levar")
     * @Method("GET")
     */
    public function validateLevarAction(Aluno $aluno)
    {
        $date = new \DateTime('now');

        $frequencia = $this->getDoctrine()->getRepository('MRSSgeBundle:Frequencia')
            ->findOneBy(array('aluno'=>$aluno,'diaSemana' => $date, 'levar' => '1'));

        return $this->render('frequencia/validatelevar.html.twig',array(
            'frequencia' => $frequencia
        ));

    }

    /**
     * @Route("/validate/entregar/{aluno}",name="cadastro_frequencia_validate_entregar")
     * @Method("GET")
     */
    public function validateEntregarAction(Aluno $aluno)
    {
        $date = new \DateTime('now');

        $frequencia = $this->getDoctrine()->getRepository('MRSSgeBundle:Frequencia')
            ->findOneBy(array('aluno'=>$aluno,'diaSemana' => $date, 'entregar' => '1'));

        return $this->render('frequencia/validatelevar.html.twig',array(
            'frequencia' => $frequencia
        ));

    }

    /**
     * Creates a new Frequencia entity.
     *
     * @Route("/new/{aluno}/entregar", name="cadastro_frequencia_entregar")
     * @Method({"GET", "POST"})
     */
    public function entregarAction(Aluno $aluno, Request $request)
    {

        $date = new \DateTime('now');
        $em = $this->getDoctrine()->getManager();

        $frequencia = $em->getRepository('MRSSgeBundle:Frequencia')
            ->findOneBy(array('aluno' => $aluno, 'diaSemana' => $date));

        if(!$frequencia){

            $frequencium = new Frequencia();

            $frequencium->setAluno($aluno)
                ->setEscola($aluno->getEscola())
                ->setTurno($aluno->getTurno())
                ->setData($date)
                ->setDiaSemana($date)
                ->setEntregar('1')
                ->setPresencaFalta('1');


            $em->persist($frequencium);
            $em->flush();

            return $this->redirectToRoute('cadastro_frequencia_index',array('turno' => $aluno->getTurno()->getId()));
        }else {

            if($frequencia->getEntregar()) {

                $frequencia->setEntregar(null);
                $em->persist($frequencia);
                $em->flush();

            }else{

                $frequencia->setEntregar('1');
                $em->persist($frequencia);
                $em->flush();

            }

            return $this->redirectToRoute('cadastro_frequencia_index', array('turno' => $aluno->getTurno()->getId()));
        }



    }

    /**
     * Creates a new Frequencia entity.
     *
     * @Route("/new/{aluno}/levar", name="cadastro_frequencia_levar")
     * @Method({"GET", "POST"})
     */
    public function levarAction(Aluno $aluno, Request $request)
    {

        $date = new \DateTime('now');
        $em = $this->getDoctrine()->getManager();


        $frequencia = $em->getRepository('MRSSgeBundle:Frequencia')
            ->findOneBy(array('aluno' => $aluno, 'diaSemana' => $date));

        if(!$frequencia) {

            $frequencium = new Frequencia();

            $frequencium->setAluno($aluno)
                ->setEscola($aluno->getEscola())
                ->setTurno($aluno->getTurno())
                ->setData($date)
                ->setDiaSemana($date)
                ->setLevar('1')
                ->setPresencaFalta('1');

            $em->persist($frequencium);
            $em->flush();

            return $this->redirectToRoute('cadastro_frequencia_index', array('turno' => $aluno->getTurno()->getId()));
        }else{

            if($frequencia->getLevar()){

                $frequencia->setLevar(null);
                $em->persist($frequencia);
                $em->flush();

            }else{

                $frequencia->setLevar('1');
                $em->persist($frequencia);
                $em->flush();
            }


            return $this->redirectToRoute('cadastro_frequencia_index', array('turno' => $aluno->getTurno()->getId()));

        }
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
