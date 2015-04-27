<?php

namespace App\T360Bundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use DataLayerBundle\Entity\T360Evaluations;
use DataLayerBundle\Form\T360EvaluationsType;
use Symfony\Component\Validator\Constraints\Date;

/**
 * T360Evaluations controller.
 *
 * @Route("/t360evaluations")
 *
 */
class T360EvaluationsController extends Controller
{

    /**
     * Lists all T360Evaluations entities.
     *
     * @Route("/", name="t360evaluations")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        if($this->get('security.context')->isGranted('ROLE_ADMIN')){
           // $entities = $em->getRepository('DataLayerBundle:T360Evaluations')->findAll();
            $entities=$this->get("t360evaluation.service")->getAll();

            return array(
                'entities' => $entities,

            );
        }
        else{
            $entities=$this->get("t360evaluation.service")->getEvalToDiplayForNonAdmin($user->getCin());

            $responsesCount=array();
            foreach($entities as $entity)
            {
                array_push($responsesCount, count($this->get("t360reponse.service")->getReponseByEvalByCin($entity->getIdEvaluation(),$user->getCin())));
            }
            return array(
                'entities' => $entities,
                'countResponses'=> $responsesCount,

            );
        }


    }

    /**
     * Lists all T360Evaluations entities.
     *
     * @Route("/remplir", name="t360evaluations_for_admin")
     * @Method("GET")
     * @Template()
     */
    public function indexForAdminAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();

            $entities=$this->get("t360evaluation.service")->getEvalToDiplayForNonAdmin($user->getCin());
            $responsesCount=array();
            foreach($entities as $entity)
            {
                array_push($responsesCount, count($this->get("t360reponse.service")->getReponseByEvalByCin($entity->getIdEvaluation(),$user->getCin())));
            }
            return array(
                'entities' => $entities,
                'countResponses'=> $responsesCount,
            );



    }



    /**
     * Creates a new T360Evaluations entity.
     *
     * @Route("/", name="t360evaluations_create")
     * @Method("POST")
     * @Template("AppT360Bundle:T360Evaluations:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new T360Evaluations();
//        $entity->setDateDebut(date('y-m-d'));

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('t360evaluations'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a T360Evaluations entity.
     *
     * @param T360Evaluations $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(T360Evaluations $entity)
    {
        $form = $this->createForm(new T360EvaluationsType(), $entity, array(
            'action' => $this->generateUrl('t360evaluations_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new T360Evaluations entity.
     *
     * @Route("/new", name="t360evaluations_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new T360Evaluations();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a T360Evaluations entity.
     *
     * @Route("/{id}", name="t360evaluations_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataLayerBundle:T360Evaluations')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find T360Evaluations entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing T360Evaluations entity.
     *
     * @Route("/{id}/edit", name="t360evaluations_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataLayerBundle:T360Evaluations')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find T360Evaluations entity.');
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
     * Creates a form to edit a T360Evaluations entity.
     *
     * @param T360Evaluations $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(T360Evaluations $entity)
    {
        $form = $this->createForm(new T360EvaluationsType(), $entity, array(
            'action' => $this->generateUrl('t360evaluations_update', array('id' => $entity->getIdEvaluation())),
            'method' => 'PUT',
        ));


//        $form = $this->createFormBuilder($entity)
//            ->add('idEvaluation','integer',array('read_only' =>'true'))
//            ->add('dateDebut', 'text',array('read_only' =>'true'))
//            ->add("dateFin",'text')
//            ->add("cinEvalue",'DataLayerBundle\Entity\Employees')
//            ->add('idAxes','choice')
//            ->setMethod('PUT')
//            ->setAction($this->generateUrl('t360axes_update', array('id' => $entity->getIdEvaluation())))
//            ->getForm();
//
//        $form->add('submit', 'submit', array('label' => 'Update'));
        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing T360Evaluations entity.
     *
     * @Route("/{id}", name="t360evaluations_update")
     * @Method("PUT")
     * @Template("AppT360Bundle:T360Evaluations:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataLayerBundle:T360Evaluations')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find T360Evaluations entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('t360evaluations'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a T360Evaluations entity.
     *
     * @Route("/{id}", name="t360evaluations_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DataLayerBundle:T360Evaluations')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find T360Evaluations entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('t360evaluations'));
    }

    /**
     * Creates a form to delete a T360Evaluations entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('t360evaluations_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
            ;
    }

    /**
     * @Route("/evaltodisplay/{cin}")
     */

    public function EvaluationToDisplayAction($cin)
    {
        $serializer = $this->container->get('jms_serializer');
        $evaluations_array=$this->get("t360evaluation.service")->getEvalToDiplay($cin);
        // if(sizeof($evaluations_array)!=0)
        $JsonPerson = $serializer->serialize($evaluations_array, 'json');
        //$evaluations_array[0]->getId();
        $response =new Response($JsonPerson);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
