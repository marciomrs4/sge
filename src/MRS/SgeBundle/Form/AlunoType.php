<?php

namespace MRS\SgeBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlunoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome',TextType::class,array('label'=>'Nome',
                'attr'=>array('class'=>'input-sm')))
            ->add('dataNascimento',DateType::class,array('label'=>'Data de Nascimento',
                'attr'=>array('class'=>'input-sm'),
                'widget' => 'single_text'))
            ->add('valorMensalidade',MoneyType::class,array('label'=>'Valor da Mensalidade',
                'attr'=>array('class'=>'input-sm'),
                'currency' => 'BRL', 'scale' => 2))
            ->add('vencimento',null,array('label'=>'Vencimento',
                'attr'=>array('class'=>'input-sm'),
                'widget' => 'single_text'))
            ->add('serie',null,array('label'=>'Série',
                'attr'=>array('class'=>'input-sm')))
            ->add('sala',null,array('label'=>'Sala',
                'attr'=>array('class'=>'input-sm')))
            ->add('status',ChoiceType::class,array('label'=>'Status',
                  'choices' => array('1'=>'Ativo',
                                   '0'=>'Inativo')))
            ->add('escola',null,array('label'=>'Escola',
                'attr'=>array('class'=>'input-sm')))
            ->add('turno',EntityType::class,array('label'=>'Turno',
                'attr'=>array('class'=>'input-sm'),
                'class' => 'MRS\SgeBundle\Entity\Turno',
//                'query_builder' => function(EntityRepository $er){
//                    return $er->createQueryBuilder('t')
//                        ->getEntityManager()
//                        ->getRepository('MRSSgeBundle:TurnoHasEscola')
//                        ->createQueryBuilder('turnoEscola')
//                        ->innerJoin('turnoEscola.turno','TE')
//
//                        ->where('turnoEscola.escola = :escola')
//                        ->setParameter('escola',1);
                ))
        ;
    }



    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MRS\SgeBundle\Entity\Aluno'
        ));
    }
}
