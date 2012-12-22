<?php

namespace Jm\SaleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PartidoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('local','entity',array('class' => 'JmSaleBundle:Equipo','property' => 'nombre'))    
            ->add('visitante','entity',array('class' => 'JmSaleBundle:Equipo','property' => 'nombre'))    
            ->add('fecha','entity',array('class' => 'JmSaleBundle:Fecha','property' => 'orden'))      
            ->add('orden')
            ->add('estado')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jm\SaleBundle\Entity\Partido'
        ));
    }

    public function getName()
    {
        return 'jm_salebundle_partidotype';
    }
}
