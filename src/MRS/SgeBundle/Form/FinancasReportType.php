<?php

namespace MRS\SgeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;

class FinancasReportType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dataInicial',DateType::class,array('label'=>'Data de Vencimento Inicial',
                'attr'=>array('class'=>'input-sm'),
                'mapped'=>false,
                'widget'=>'single_text'))
            ->add('dataFinal',DateType::class,array('label'=>'Data de Vencimento Final',
                'attr'=>array('class'=>'input-sm'),
                'mapped'=>false,
                'widget'=>'single_text'))
            ->add('status',ChoiceType::class,array('label'=>'Status',
                'choices'=>array('%'=>'Todos','0'=>'Pago','1'=>'Pendente'),
                'attr'=>array('class'=>'input-sm')))
        ;
    }



    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MRS\SgeBundle\Entity\Financas'
        ));
    }

    public function getBlockPrefix()
    {
        return 'financa_report';
    }
}
