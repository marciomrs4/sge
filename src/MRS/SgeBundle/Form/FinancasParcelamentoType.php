<?php

namespace MRS\SgeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FinancasParcelamentoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('valorParcial',MoneyType::class,array('label'=>'Valor Parcial',
                                           'attr'=>array('class'=>'input-sm'),
                'currency'=>'BRL', 'scale'=>2))
            ->add('dataPagamento',DateType::class,array('label'=>'Data do Pagamento',
                                           'attr'=>array('class'=>'input-sm'),
                'widget'=>'single_text'))
        ;
    }
    
    
                                                          
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MRS\SgeBundle\Entity\FinancasParcelamento'
        ));
    }
}
