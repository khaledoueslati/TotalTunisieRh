<?php

namespace DataLayerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DataLayerBundle\Entity\T360Questions;
use DataLayerBundle\Form\T360QuestionsType;
use Symfony\Component\HttpFoundation\Response;

/**
 * T360Questions controller.
 *
 * @Route("/t360questions")
 */
class T360QuestionsController extends Controller
{

    /**
     * Lists all T360Questions entities.
     *
     * @Route("/", name="t360questions")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DataLayerBundle:T360Questions')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new T360Questions entity.
     *
     * @Route("/", name="t360questions_create")
     * @Method("POST")
     * @Template("DataLayerBundle:T360Questions:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new T360Questions();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('t360questions_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a T360Questions entity.
     *
     * @param T360Questions $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(T360Questions $entity)
    {
        $form = $this->createForm(new T360QuestionsType(), $entity, array(
            'action' => $this->generateUrl('t360questions_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new T360Questions entity.
     *
     * @Route("/new", name="t360questions_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new T360Questions();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a T360Questions entity.
     *
     * @Route("/{id}", name="t360questions_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataLayerBundle:T360Questions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find T360Questions entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing T360Questions entity.
     *
     * @Route("/{id}/edit", name="t360questions_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataLayerBundle:T360Questions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find T360Questions entity.');
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
    * Creates a form to edit a T360Questions entity.
    *
    * @param T360Questions $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(T360Questions $entity)
    {
        $form = $this->createForm(new T360QuestionsType(), $entity, array(
            'action' => $this->generateUrl('t360questions_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing T360Questions entity.
     *
     * @Route("/{id}", name="t360questions_update")
     * @Method("PUT")
     * @Template("DataLayerBundle:T360Questions:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataLayerBundle:T360Questions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find T360Questions entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('t360questions_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a T360Questions entity.
     *
     * @Route("/{id}", name="t360questions_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DataLayerBundle:T360Questions')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find T360Questions entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('t360questions'));
    }

    /**
     * Creates a form to delete a T360Questions entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('t360questions_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    /**
     * @Route("/questionsbyaxe/{idAxe}")
     */
    public function showByAxeAction($idAxe)
    {
        $serializer = $this->container->get('jms_serializer');
        $questions_array=$this->get("t360question.service")->getByAxe($idAxe);
        // if(sizeof($evaluations_array)!=0)
        $JsonQuestions = $serializer->serialize($questions_array, 'json');
        //$evaluations_array[0]->getId();
        $response =new Response($JsonQuestions);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/service/allquestions")
     */
    public function getAllQuestionsAction()
    {
        $serializer = $this->container->get('jms_serializer');
        $questions_array=$this->get("t360question.service")->getAll();
        // if(sizeof($evaluations_array)!=0)
        $JsonQuestions = $serializer->serialize($questions_array, 'json');
        //$evaluations_array[0]->getId();
        $response =new Response($JsonQuestions);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
