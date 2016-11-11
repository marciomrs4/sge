<?php

namespace MRS\SgeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EscolaType extends AbstractType
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
            ->add('endereco',null,array('label'=>'endereco',
                                           'attr'=>array('class'=>'input-sm')))
            ->add('telefone',null,array('label'=>'telefone',
                                           'attr'=>array('class'=>'input-sm')))
        ;
    }
    
    
                                                          
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MRS\SgeBundle\Entity\Escola'
        ));
    }
}
