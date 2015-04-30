<?php

namespace DataLayerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmployeesGestionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cin','integer',array("disabled"=>true))
            ->add('nom','text',array("disabled"=>true))
            ->add('prenom','text',array("disabled"=>true))
            ->add('email')
//            ->add('dateEmbauche','date', array(
//                'years' => range(date('Y') - 50, date('Y') + 2) ))
//            ->add('sexe', 'choice', array(
//                'choices'   => array('male' => 'Masculin', 'female' => 'Féminin'),
//                'required'  => false,
//            ))
            ->add('username')
            ->add('password','password')
//            ->add('poste', new DirectionsPostesType())
//
//            ->add('role')
//            ->add('supHierarchique')
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
