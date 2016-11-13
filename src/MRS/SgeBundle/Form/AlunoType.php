<?php

namespace MRS\SgeBundle\Form;

use Symfony\Component\Form\AbstractType;
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
            ->add('nome',null,array('label'=>'nome',
                                           'attr'=>array('class'=>'input-sm')))
            ->add('dataNascimento',null,array('label'=>'dataNascimento',
                                           'attr'=>array('class'=>'input-sm')))
            ->add('valorMensalidade',null,array('label'=>'valorMensalidade',
                                           'attr'=>array('class'=>'input-sm')))
            ->add('vencimento',null,array('label'=>'vencimento',
                                           'attr'=>array('class'=>'input-sm')))
            ->add('serie',null,array('label'=>'serie',
                                           'attr'=>array('class'=>'input-sm')))
            ->add('sala',null,array('label'=>'sala',
                                           'attr'=>array('class'=>'input-sm')))
            ->add('status',null,array('label'=>'status',
                                           'attr'=>array('class'=>'input-sm')))
            ->add('turno',null,array('label'=>'turno',
                                           'attr'=>array('class'=>'input-sm')))
            ->add('escola',null,array('label'=>'escola',
                                           'attr'=>array('class'=>'input-sm')))
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
