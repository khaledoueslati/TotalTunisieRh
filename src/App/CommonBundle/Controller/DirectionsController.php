<?php

namespace App\CommonBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DataLayerBundle\Entity\Directions;
use DataLayerBundle\Form\DirectionsType;

/**
 * Directions controller.
 *
 * @Route("/directions")
 */
class DirectionsController extends Controller
{

    /**
     * Lists all Directions entities.
     *
     * @Route("/", name="directions")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DataLayerBundle:Directions')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Directions entity.
     *
     * @Route("/", name="directions_create")
     * @Method("POST")
     * @Template("DataLayerBundle:Directions:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Directions();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('directions_postes'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Directions entity.
     *
     * @param Directions $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Directions $entity)
    {
        $form = $this->createForm(new DirectionsType(), $entity, array(
            'action' => $this->generateUrl('directions_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Directions entity.
     *
     * @Route("/new", name="directions_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Directions();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Directions entity.
     *
     * @Route("/{id}", name="directions_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataLayerBundle:Directions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Directions entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Directions entity.
     *
     * @Route("/{id}/edit", name="directions_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataLayerBundle:Directions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Directions entity.');
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
     * Creates a form to edit a Directions entity.
     *
     * @param Directions $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Directions $entity)
    {
        $form = $this->createForm(new DirectionsType(), $entity, array(
            'action' => $this->generateUrl('directions_update', array('id' => $entity->getIdDirection())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Directions entity.
     *
     * @Route("/{id}", name="directions_update")
     * @Method("PUT")
     * @Template("DataLayerBundle:Directions:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataLayerBundle:Directions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Directions entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('directions_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Directions entity.
     *
     * @Route("/delete/{id}", name="directions_delete")
     *
     */
    public function deleteAction( $id)
    {

            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DataLayerBundle:Directions')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Directions entity.');
            }

            $em->remove($entity);
            $em->flush();


        return $this->redirect($this->generateUrl('directions_postes'));
    }

    /**
     * Creates a form to delete a Directions entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('directions_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
            ;
    }
}
