<?php

namespace MRS\SgeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LogradouroType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cep',null,array('label'=>'cep',
                                           'attr'=>array('class'=>'input-sm')))
            ->add('logradouro',null,array('label'=>'logradouro',
                                           'attr'=>array('class'=>'input-sm')))

        ;
    }
    
    
                                                          
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MRS\SgeBundle\Entity\Logradouro'
        ));
    }
}
