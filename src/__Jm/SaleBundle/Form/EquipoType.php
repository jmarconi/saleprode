<?php

namespace Jm\SaleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EquipoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('nombre_corto')    
            ->add('iniciales')    
            ->add('file', 'file', array('label' => 'logo equipo'));
            
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jm\SaleBundle\Entity\Equipo'
        ));
    }

    public function getName()
    {
        return 'jm_salebundle_equipotype';
    }
}
