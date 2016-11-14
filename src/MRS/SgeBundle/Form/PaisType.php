<?php

namespace MRS\SgeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaisType extends AbstractType
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
            ->add('telefone1',null,array('label'=>'telefone1',
                'attr'=>array('class'=>'input-sm')))
            ->add('telefone2',null,array('label'=>'telefone2',
                'attr'=>array('class'=>'input-sm')))
            ->add('rg',null,array('label'=>'rg',
                'attr'=>array('class'=>'input-sm')))
            ->add('cpf',null,array('label'=>'cpf',
                'attr'=>array('class'=>'input-sm')))
            ->add('status',ChoiceType::class,array('label'=>'status',
                'attr'=>array('class'=>'input-sm'),
                'choices' => array('1'=>'Ativo',
                    '0'=>'Inativo')))
        ;
    }



    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MRS\SgeBundle\Entity\Pais'
        ));
    }
}
