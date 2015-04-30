<?php

namespace App\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DataLayerBundle\Form\EmployeesGestionType;
use DataLayerBundle\Entity\Employees;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller
{
    /**
     * @Route("/registerbegin", name="register_begin")
     * @Template()
     */
    public function registerBeginAction()
    {
        return array();
    }

    /**
     * @Route("/register", name="register")
     * @Template()
     */
    public function registerAction()
    {
        return array();
    }

    /**
     * Displays a form to edit an existing Employees entity.
     *
     * @Route("/register/employee/{id}", name="employees_register")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataLayerBundle:Employees')->find($id);

        if (!$entity) {
            return  $this->render("AppCommonBundle:Default:Error.html.twig", array(
                "message"=>"0"
            ));
        }
        if($entity->getUserName()!=null ){
            return  $this->render("AppCommonBundle:Default:Error.html.twig", array(
                "message"=>"1"
            ));
        }

        $editForm = $this->createEditForm($entity);


        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),

        );
    }

    /**
     * Creates a form to edit a Employees entity.
     *
     * @param Employees $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Employees $entity)
    {
        $form = $this->createForm(new EmployeesGestionType(), $entity, array(
            'action' => $this->generateUrl('employees_update_register', array('id' => $entity->getCin())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Employees entity.
     *
     * @Route("/register/{id}", name="employees_update_register")
     * @Method("PUT")
     * @Template("AppCommonBundle:Default:existError.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataLayerBundle:Employees')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Employees entity.');
        }


        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            $em->flush();

            return $this->redirect($this->generateUrl('login'));
        }

        return array(
            'message' => "3",

        );
    }


}
