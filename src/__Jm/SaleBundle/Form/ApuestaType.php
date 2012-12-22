<?php

namespace Jm\SaleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ApuestaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('resultado')
            ->add('partido','entity',array('class' => 'JmSaleBundle:Partido','property' => 'titulo'))
            ->add('user','entity',array('class' => 'JmSaleBundle:User','property' => 'username'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jm\SaleBundle\Entity\Apuesta'
        ));
    }

    public function getName()
    {
        return 'jm_salebundle_apuestatype';
    }
}
