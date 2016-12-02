<?php

namespace MRS\SgeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContratosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('termoCompromisso',TextareaType::class,array('label'=>'Termo de Compromisso',
                'attr'=>array('class'=>'input-sm','rows'=>'12'),
                ))
            ->add('dataContratoInicial',DateType::class,array('label'=>'Data Inicial do Contrato',
                'attr'=>array('class'=>'input-sm'),
                'widget'=>'single_text'))
            ->add('dataContratoFinal',DateType::class,array('label'=>'Data Final do Contrato',
                'attr'=>array('class'=>'input-sm'),
                'widget'=>'single_text'))
            ->add('numeroParcelas',IntegerType::class,array('label'=>'Número de Parcelas',
                'attr'=>array('class'=>'input-sm')))
        ;
    }



    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MRS\SgeBundle\Entity\Contratos'
        ));
    }
}
