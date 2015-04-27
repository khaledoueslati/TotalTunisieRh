<?php

namespace App\CommonBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DataLayerBundle\Entity\Employees;
use DataLayerBundle\Form\EmployeesType;

/**
 * Employees controller.
 *
 * @Route("/employees")
 */
class EmployeesController extends Controller
{

    /**
     * Lists all Employees entities.
     *
     * @Route("/", name="employees")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DataLayerBundle:Employees')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Employees entity.
     *
     * @Route("/", name="employees_create")
     * @Method("POST")
     * @Template("DataLayerBundle:Employees:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Employees();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('employees_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Employees entity.
     *
     * @param Employees $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Employees $entity)
    {
        $form = $this->createForm(new EmployeesType(), $entity, array(
            'action' => $this->generateUrl('employees_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Employees entity.
     *
     * @Route("/new", name="employees_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Employees();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Employees entity.
     *
     * @Route("/{id}", name="employees_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataLayerBundle:Employees')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Employees entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Employees entity.
     *
     * @Route("/{id}/edit", name="employees_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataLayerBundle:Employees')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Employees entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
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
        $form = $this->createForm(new EmployeesType(), $entity, array(
            'action' => $this->generateUrl('employees_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Employees entity.
     *
     * @Route("/{id}", name="employees_update")
     * @Method("PUT")
     * @Template("DataLayerBundle:Employees:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataLayerBundle:Employees')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Employees entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('employees_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Employees entity.
     *
     * @Route("/{id}", name="employees_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DataLayerBundle:Employees')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Employees entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('employees'));
    }

    /**
     * Creates a form to delete a Employees entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('employees_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
            ;
    }
}
