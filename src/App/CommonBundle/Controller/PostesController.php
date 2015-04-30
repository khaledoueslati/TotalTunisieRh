<?php

namespace App\CommonBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DataLayerBundle\Entity\Postes;
use DataLayerBundle\Form\PostesType;

/**
 * Postes controller.
 *
 * @Route("/postes")
 */
class PostesController extends Controller
{

    /**
     * Lists all Postes entities.
     *
     * @Route("/", name="postes")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DataLayerBundle:Postes')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Lists all Postes entities.
     *
     * @Route("/pardirection", name="postes_by_direction")
     * @Method("GET")
     * @Template()
     */
    public function indexByDirectionAction()
    {
        $postes=$this->get("postes.service")->getOrderedByDirection();
        $postesOrdered=array();
        $oldDirection="";
        $temp=array();
        foreach($postes as $poste)
        {
            if($oldDirection!=$poste["direction_libelle"])
            {
                $oldDirection=$poste["direction_libelle"];
                if(count($temp)==0){
                    $temp["direction"]=$poste["direction_libelle"];
                    $temp["postes"]=array();
                    array_push($temp["postes"],$poste);
                }else{
                    array_push($postesOrdered,$temp);
                    $temp=array();
                    $temp["direction"]=$poste["direction_libelle"];
                    $temp["postes"]=array();
                    array_push($temp["postes"],$poste);
                }

            }else{
                array_push($temp["postes"],$poste);
            }

        }
        array_push($postesOrdered,$temp);
        return array('entites'=>$postesOrdered);
    }
    /**
     * Creates a new Postes entity.
     *
     * @Route("/", name="postes_create")
     * @Method("POST")
     * @Template("DataLayerBundle:Postes:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Postes();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('postes_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Postes entity.
     *
     * @param Postes $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Postes $entity)
    {
        $form = $this->createForm(new PostesType(), $entity, array(
            'action' => $this->generateUrl('postes_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Postes entity.
     *
     * @Route("/new", name="postes_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Postes();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Postes entity.
     *
     * @Route("/{id}", name="postes_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataLayerBundle:Postes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Postes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Postes entity.
     *
     * @Route("/{id}/edit", name="postes_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataLayerBundle:Postes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Postes entity.');
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
     * Creates a form to edit a Postes entity.
     *
     * @param Postes $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Postes $entity)
    {
        $form = $this->createForm(new PostesType(), $entity, array(
            'action' => $this->generateUrl('postes_update', array('id' => $entity->getIdPoste())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Postes entity.
     *
     * @Route("/{id}", name="postes_update")
     * @Method("PUT")
     * @Template("DataLayerBundle:Postes:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataLayerBundle:Postes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Postes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('postes_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Postes entity.
     *
     * @Route("/delete/{id}", name="postes_delete")
     *
     */
    public function deleteAction($id)
    {

            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DataLayerBundle:Postes')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Postes entity.');
            }

            $em->remove($entity);
            $em->flush();

        return $this->redirect($this->generateUrl('directions_postes'));
    }

    /**
     * Creates a form to delete a Postes entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('postes_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
            ;
    }
}
