<?php

namespace App\T360Bundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DataLayerBundle\Entity\T360Axes;
use DataLayerBundle\Form\T360AxesType;

/**
 * T360Axes controller.
 *
 * @Route("/t360axes")
 */
class T360AxesController extends Controller
{

    /**
     * Lists all T360Axes entities.
     *
     * @Route("/", name="t360axes")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DataLayerBundle:T360Axes')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new T360Axes entity.
     *
     * @Route("/", name="t360axes_create")
     * @Method("POST")
     * @Template("AppT360Bundle:T360Axes:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new T360Axes();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('t360axes_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a T360Axes entity.
     *
     * @param T360Axes $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(T360Axes $entity)
    {

        /*$form = $this->createForm(new T360AxesType(), $entity, array(
            'action' => $this->generateUrl('t360axes_create'),
            'method' => 'POST',
        ));*/


        $form = $this->createFormBuilder($entity)
            ->add('Libelle', 'text')
            ->setMethod('POST')
            ->setAction($this->generateUrl('t360axes_create'))
            ->getForm();
        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new T360Axes entity.
     *
     * @Route("/new", name="t360axes_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new T360Axes();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a T360Axes entity.
     *
     * @Route("/{id}", name="t360axes_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataLayerBundle:T360Axes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find T360Axes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing T360Axes entity.
     *
     * @Route("/{id}/edit", name="t360axes_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataLayerBundle:T360Axes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find T360Axes entity.');
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
     * Creates a form to edit a T360Axes entity.
     *
     * @param T360Axes $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(T360Axes $entity)
    {
       /* $form = $this->createForm(new T360AxesType(), $entity, array(
            'action' => $this->generateUrl('t360axes_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));*/


        $form = $this->createFormBuilder($entity)
            ->add('id','integer')
            ->add('Libelle', 'text')
            ->setMethod('PUT')
            ->setAction($this->generateUrl('t360axes_update', array('id' => $entity->getId())))
            ->getForm();

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing T360Axes entity.
     *
     * @Route("/{id}", name="t360axes_update")
     * @Method("PUT")
     * @Template("AppT360Bundle:T360Axes:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataLayerBundle:T360Axes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find T360Axes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('t360axes', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a T360Axes entity.
     *
     * @Route("/{id}", name="t360axes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DataLayerBundle:T360Axes')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find T360Axes entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('t360axes'));
    }

    /**
     * Creates a form to delete a T360Axes entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('t360axes_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete Axe','attr'=>array("class"=>"btn btn-warning pull-right")))
            ->getForm()
            ;
    }
}
