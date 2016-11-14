<?php

namespace MRS\SgeBundle\Controller;

use Doctrine\ORM\EntityRepository;
use MRS\SgeBundle\Entity\Escola;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use MRS\SgeBundle\Entity\TurnoHasEscola;
use MRS\SgeBundle\Form\TurnoHasEscolaType;

/**
 * TurnoHasEscola controller.
 *
 * @Route("/cadastro/turnohasescola")
 */
class TurnoHasEscolaController extends Controller
{
    /**
     * Lists all TurnoHasEscola entities.
     *
     * @Route("/{escola}", name="cadastro_turnohasescola_index")
     * @Method("GET")
     */
    public function indexAction(Escola $escola)
    {
        $em = $this->getDoctrine()->getManager();

        $turnoHasEscolas = $em->getRepository('MRSSgeBundle:TurnoHasEscola')
            ->findBy(array('escola' => $escola));

        return $this->render('turnohasescola/index.html.twig', array(
            'turnoHasEscolas' => $turnoHasEscolas,
            'escola' => $escola
        ));
    }

    /**
     * Creates a new TurnoHasEscola entity.
     *
     * @Route("/new/{escola}", name="cadastro_turnohasescola_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Escola $escola, Request $request)
    {
        $turnoHasEscola = new TurnoHasEscola();
        $form = $this->createForm('MRS\SgeBundle\Form\TurnoHasEscolaType', $turnoHasEscola);


        $turnoHasEscolaExist = $this->getDoctrine()
            ->getRepository('MRSSgeBundle:TurnoHasEscola')
            ->findBy(array('escola' => $escola));

        $ids = '';
        foreach($turnoHasEscolaExist as $linha){
            $ids[] = $linha->getTurno()->getId();
        }

        $form->add('turno',EntityType::class,array('label'=>'Turno',
            'attr' => array('class'=>'input-sm'),
            'class'=>'MRS\SgeBundle\Entity\Turno',
            'query_builder' => function(EntityRepository $er) use ($ids){
                return $er->createQueryBuilder('t')
                    ->where('t.id NOT IN (:ids)')
                    ->setParameter('ids',$ids);
            }));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $turnoHasEscola->setEscola($escola);
            $em->persist($turnoHasEscola);
            $em->flush();

            $this->addFlash('notice','Criado com sucesso!');

            return $this->redirectToRoute('cadastro_escola_show', array('id' => $escola->getId()));
        }

        return $this->render('turnohasescola/new.html.twig', array(
            'turnoHasEscola' => $turnoHasEscola,
            'escola' => $escola,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TurnoHasEscola entity.
     *
     * @Route("/{id}", name="cadastro_turnohasescola_show")
     * @Method("GET")
     */
    public function showAction(TurnoHasEscola $turnoHasEscola)
    {
        $deleteForm = $this->createDeleteForm($turnoHasEscola);

        return $this->render('turnohasescola/show.html.twig', array(
            'turnoHasEscola' => $turnoHasEscola,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TurnoHasEscola entity.
     *
     * @Route("/{id}/edit", name="cadastro_turnohasescola_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TurnoHasEscola $turnoHasEscola)
    {
        $deleteForm = $this->createDeleteForm($turnoHasEscola);
        $editForm = $this->createForm('MRS\SgeBundle\Form\TurnoHasEscolaType', $turnoHasEscola);

        $escolaId = $turnoHasEscola->getEscola()->getId();

        $id = $turnoHasEscola->getTurno()->getId();

        $turnoHasEscolaExist = $this->getDoctrine()
            ->getRepository('MRSSgeBundle:TurnoHasEscola')
            ->findBy(array('escola' => $turnoHasEscola->getEscola()));

        $ids = '';
        foreach($turnoHasEscolaExist as $linha){
            $ids[] = $linha->getTurno()->getId();
        }

        $editForm->add('turno',EntityType::class,array('label'=>'Turno',
            'attr' => array('class'=>'input-sm'),
            'class'=>'MRS\SgeBundle\Entity\Turno',
            'query_builder' => function(EntityRepository $er) use ($ids,$id){
                return $er->createQueryBuilder('t')
                    ->where('t.id NOT IN (:ids) OR t.id = :id')
                    ->setParameter('ids',$ids)
                    ->setParameter('id',$id);
            }));

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($turnoHasEscola);
            $em->flush();

            $this->addFlash('notice','Alterado com sucesso!');

            return $this->redirectToRoute('cadastro_escola_show', array('id' => $escolaId));
        }

        return $this->render('turnohasescola/edit.html.twig', array(
            'turnoHasEscola' => $turnoHasEscola,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TurnoHasEscola entity.
     *
     * @Route("/{id}", name="cadastro_turnohasescola_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TurnoHasEscola $turnoHasEscola)
    {
        $escolaId = $turnoHasEscola->getEscola()->getId();

        $form = $this->createDeleteForm($turnoHasEscola);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($turnoHasEscola);
            $em->flush();
        }

        return $this->redirectToRoute('cadastro_escola_show',array('id'=>$escolaId));
    }

    /**
     * Creates a form to delete a TurnoHasEscola entity.
     *
     * @param TurnoHasEscola $turnoHasEscola The TurnoHasEscola entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TurnoHasEscola $turnoHasEscola)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cadastro_turnohasescola_delete', array('id' => $turnoHasEscola->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
