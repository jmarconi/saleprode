<?php

namespace Jm\SaleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FechaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('orden')
            ->add('torneo','entity',array('class' => 'JmSaleBundle:Torneo','property' => 'nombre'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jm\SaleBundle\Entity\Fecha'
        ));
    }

    public function getName()
    {
        return 'jm_salebundle_fechatype';
    }
}
