<?php

namespace DataLayerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DataLayerBundle\Entity\DirectionsPostes;
use DataLayerBundle\Form\DirectionsPostesType;

/**
 * DirectionsPostes controller.
 *
 * @Route("/directionspostes")
 */
class DirectionsPostesController extends Controller
{

    /**
     * Lists all DirectionsPostes entities.
     *
     * @Route("/", name="directionspostes")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DataLayerBundle:DirectionsPostes')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new DirectionsPostes entity.
     *
     * @Route("/", name="directionspostes_create")
     * @Method("POST")
     * @Template("DataLayerBundle:DirectionsPostes:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new DirectionsPostes();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('directionspostes_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a DirectionsPostes entity.
     *
     * @param DirectionsPostes $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(DirectionsPostes $entity)
    {
        $form = $this->createForm(new DirectionsPostesType(), $entity, array(
            'action' => $this->generateUrl('directionspostes_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new DirectionsPostes entity.
     *
     * @Route("/new", name="directionspostes_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new DirectionsPostes();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a DirectionsPostes entity.
     *
     * @Route("/{id}", name="directionspostes_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataLayerBundle:DirectionsPostes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DirectionsPostes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing DirectionsPostes entity.
     *
     * @Route("/{id}/edit", name="directionspostes_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataLayerBundle:DirectionsPostes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DirectionsPostes entity.');
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
    * Creates a form to edit a DirectionsPostes entity.
    *
    * @param DirectionsPostes $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(DirectionsPostes $entity)
    {
        $form = $this->createForm(new DirectionsPostesType(), $entity, array(
            'action' => $this->generateUrl('directionspostes_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing DirectionsPostes entity.
     *
     * @Route("/{id}", name="directionspostes_update")
     * @Method("PUT")
     * @Template("DataLayerBundle:DirectionsPostes:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataLayerBundle:DirectionsPostes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DirectionsPostes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('directionspostes_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a DirectionsPostes entity.
     *
     * @Route("/{id}", name="directionspostes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DataLayerBundle:DirectionsPostes')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find DirectionsPostes entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('directionspostes'));
    }

    /**
     * Creates a form to delete a DirectionsPostes entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('directionspostes_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
