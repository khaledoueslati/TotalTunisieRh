<?php

namespace DataLayerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmployeesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('dateEmbauche','date', array(
                'years' => range(date('Y') - 50, date('Y') + 2) ))
            ->add('sexe', 'choice', array(
                'choices'   => array('m' => 'Masculin', 'f' => 'Féminin'),
                'required'  => false,
            ))
            ->add('username')
            ->add('poste', new DirectionsPostesType())

            ->add('role')
            ->add('supHierarchique')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DataLayerBundle\Entity\Employees'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'datalayerbundle_employees';
    }
}
