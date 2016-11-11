<?php

namespace MRS\SgeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VeiculoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('placa',null,array('label'=>'placa',
                                           'attr'=>array('class'=>'input-sm')))
            ->add('modelo',null,array('label'=>'modelo',
                                           'attr'=>array('class'=>'input-sm')))
            ->add('anoFabricacao',DateType::class,array('label'=>'anoFabricacao',
                                           'attr'=>array('class'=>'input-sm'),
                    'widget'=>'single_text'))
            ->add('titulo',null,array('label'=>'titulo',
                                           'attr'=>array('class'=>'input-sm')))
        ;
    }
    
    
                                                          
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MRS\SgeBundle\Entity\Veiculo'
        ));
    }
}
