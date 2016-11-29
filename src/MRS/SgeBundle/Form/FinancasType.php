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

class FinancasType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('valorTotalPago',MoneyType::class,array('label'=>'Valor Total Pago',
                                           'attr'=>array('class'=>'input-sm'),
                                           'currency' => 'BRL', 'scale' => 2))
            ->add('dataVencimento',DateType::class,array('label'=>'Data de Vencimento',
                                           'attr'=>array('class'=>'input-sm'),
                                           'widget'=>'single_text'))
            ->add('dataPagamento',null,array('label'=>'Data de Pagamento',
                                           'attr'=>array('class'=>'input-sm'),
                                           'widget'=>'single_text'))
            ->add('status',ChoiceType::class,array('label'=>'Status',
                    'choices'=>array('0'=>'Pago','1'=>'Pendente')))
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
}
