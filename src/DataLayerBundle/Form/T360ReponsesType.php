<?php

namespace DataLayerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class T360ReponsesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('valeur')
            ->add('idEmployee')
            ->add('idEval')
            ->add('idQuestion')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DataLayerBundle\Entity\T360Reponses'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'datalayerbundle_t360reponses';
    }
}
