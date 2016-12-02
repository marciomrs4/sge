<?php

namespace MRS\SgeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FrequenciaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('diaSemana',null,array('label'=>'diaSemana',
                                           'attr'=>array('class'=>'input-sm')))
            ->add('data',null,array('label'=>'data',
                                           'attr'=>array('class'=>'input-sm')))
            ->add('presencaFalta',null,array('label'=>'presencaFalta',
                                           'attr'=>array('class'=>'input-sm')))
            ->add('levar',null,array('label'=>'levar',
                                           'attr'=>array('class'=>'input-sm')))
            ->add('entregar',null,array('label'=>'entregar',
                                           'attr'=>array('class'=>'input-sm')))
            ->add('justificativa',null,array('label'=>'justificativa',
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
            'data_class' => 'MRS\SgeBundle\Entity\Frequencia'
        ));
    }
}
