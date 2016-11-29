<?php

namespace MRS\SgeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InformacaoComplementarType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('professor',null,array('label'=>'Professor',
                                           'attr'=>array('class'=>'input-sm')))
            ->add('problemasSaude',null,array('label'=>'Problema de Saúde',
                                           'attr'=>array('class'=>'input-sm')))
            ->add('observacao',null,array('label'=>'Observação',
                                           'attr'=>array('class'=>'input-sm')))
        ;
    }
    
    
                                                          
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MRS\SgeBundle\Entity\InformacaoComplementar'
        ));
    }
}
