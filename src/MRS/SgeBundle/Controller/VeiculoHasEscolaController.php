<?php

namespace MRS\SgeBundle\Controller;

use Doctrine\ORM\EntityRepository;
use MRS\SgeBundle\Entity\Escola;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use MRS\SgeBundle\Entity\VeiculoHasEscola;
use MRS\SgeBundle\Form\VeiculoHasEscolaType;

/**
 * VeiculoHasEscola controller.
 *
 * @Route("/cadastro/veiculohasescola")
 */
class VeiculoHasEscolaController extends Controller
{
    /**
     * Lists all VeiculoHasEscola entities.
     *
     * @Route("/{escola}", name="cadastro_veiculohasescola_index")
     * @Method("GET")
     */
    public function indexAction(Escola $escola)
    {
        $em = $this->getDoctrine()->getManager();

        $veiculoHasEscolas = $em->getRepository('MRSSgeBundle:VeiculoHasEscola')
            ->findBy(array('escola' => $escola));

        return $this->render('veiculohasescola/index.html.twig', array(
            'veiculoHasEscolas' => $veiculoHasEscolas,
            'escola' => $escola
        ));
    }

    /**
     * Creates a new VeiculoHasEscola entity.
     *
     * @Route("/new/{escola}", name="cadastro_veiculohasescola_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Escola $escola, Request $request)
    {
        $veiculoHasEscola = new VeiculoHasEscola();
        $veiculoHasEscola->setEscola($escola);
        $form = $this->createForm('MRS\SgeBundle\Form\VeiculoHasEscolaType', $veiculoHasEscola);

        $veiculoHasEscolaExist = $this->getDoctrine()
            ->getRepository('MRSSgeBundle:VeiculoHasEscola')
            ->findBy(array('escola' => $escola));

        $ids = '';
        foreach($veiculoHasEscolaExist as $linha){
            $ids[] = $linha->getVeiculo()->getId();
        }


        $form->add('veiculo',EntityType::class,array('label'=>'veiculo',
                        'attr'=>array('class'=>'input-sm'),
                    'class' => 'MRS\SgeBundle\Entity\Veiculo',
                    'query_builder' => function(EntityRepository $er)use($ids){
                        return $er->createQueryBuilder('v')
                            ->where('v.id NOT IN (:ids)')
                            ->orderBy('v.titulo','ASC')
                            ->setParameter('ids',$ids);
                    }));

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($veiculoHasEscola);
            $em->flush();

            $this->addFlash('notice','Criado com sucesso!');

            return $this->redirectToRoute('cadastro_escola_show', array('id' => $veiculoHasEscola->getEscola()->getId()));
        }

        return $this->render('veiculohasescola/new.html.twig', array(
            'veiculoHasEscola' => $veiculoHasEscola,
            'escola' => $escola,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a VeiculoHasEscola entity.
     *
     * @Route("/{id}", name="cadastro_veiculohasescola_show")
     * @Method("GET")
     */
    public function showAction(VeiculoHasEscola $veiculoHasEscola)
    {
        $deleteForm = $this->createDeleteForm($veiculoHasEscola);

        return $this->render('veiculohasescola/show.html.twig', array(
            'veiculoHasEscola' => $veiculoHasEscola,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing VeiculoHasEscola entity.
     *
     * @Route("/{id}/edit", name="cadastro_veiculohasescola_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, VeiculoHasEscola $veiculoHasEscola)
    {
        $deleteForm = $this->createDeleteForm($veiculoHasEscola);
        $editForm = $this->createForm('MRS\SgeBundle\Form\VeiculoHasEscolaType', $veiculoHasEscola);

        $escolaId = $veiculoHasEscola->getEscola()->getId();

        $id = $veiculoHasEscola->getVeiculo()->getId();

        $veiculoHasEscolaExist = $this->getDoctrine()
            ->getRepository('MRSSgeBundle:VeiculoHasEscola')
            ->findBy(array('escola' => $veiculoHasEscola->getEscola()));

        $ids = '';

        foreach($veiculoHasEscolaExist as $linha){
            $ids[] = $linha->getVeiculo()->getId();
        }


        $editForm->add('veiculo',EntityType::class,array('label'=>'veiculo',
            'attr'=>array('class'=>'input-sm'),
            'class' => 'MRS\SgeBundle\Entity\Veiculo',
            'query_builder' => function(EntityRepository $er)use($ids, $id){
                return $er->createQueryBuilder('v')
                    ->where('v.id = :id OR v.id NOT IN (:ids)')
                    ->orderBy('v.titulo','ASC')
                    ->setParameter('ids',$ids)
                    ->setParameter('id',$id);

            }));

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($veiculoHasEscola);
            $em->flush();

            $this->addFlash('notice','Alterado com sucesso!');

            return $this->redirectToRoute('cadastro_escola_show', array('id' => $escolaId));
        }

        return $this->render('veiculohasescola/edit.html.twig', array(
            'veiculoHasEscola' => $veiculoHasEscola,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a VeiculoHasEscola entity.
     *
     * @Route("/{id}", name="cadastro_veiculohasescola_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, VeiculoHasEscola $veiculoHasEscola)
    {
        $escolaId = $veiculoHasEscola->getEscola()->getId();

        $form = $this->createDeleteForm($veiculoHasEscola);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($veiculoHasEscola);
            $em->flush();
        }

        return $this->redirectToRoute('cadastro_escola_show',array('id' => $escolaId));
    }

    /**
     * Creates a form to delete a VeiculoHasEscola entity.
     *
     * @param VeiculoHasEscola $veiculoHasEscola The VeiculoHasEscola entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(VeiculoHasEscola $veiculoHasEscola)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cadastro_veiculohasescola_delete', array('id' => $veiculoHasEscola->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
