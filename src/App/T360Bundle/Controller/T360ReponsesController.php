<?php

namespace App\T360Bundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DataLayerBundle\Entity\T360Reponses;
use DataLayerBundle\Form\T360ReponsesType;
use Symfony\Component\HttpFoundation\Response;

/**
 * T360Reponses controller.
 *
 * @Route("/t360reponses")
 */
class T360ReponsesController extends Controller
{

    /**
     * Lists all T360Reponses entities.
     *
     * @Route("/", name="t360reponses")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DataLayerBundle:T360Reponses')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new T360Reponses entity.
     *
     * @Route("/", name="t360reponses_create")
     * @Method("POST")
     * @Template("AppT360Bundle:T360Reponses:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new T360Reponses();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('t360reponses_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a T360Reponses entity.
     *
     * @param T360Reponses $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(T360Reponses $entity)
    {
        $form = $this->createForm(new T360ReponsesType(), $entity, array(
            'action' => $this->generateUrl('t360reponses_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new T360Reponses entity.
     *
     * @Route("/new", name="t360reponses_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new T360Reponses();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a T360Reponses entity.
     *
     * @Route("/{id}", name="t360reponses_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataLayerBundle:T360Reponses')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find T360Reponses entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing T360Reponses entity.
     *
     * @Route("/{id}/edit", name="t360reponses_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataLayerBundle:T360Reponses')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find T360Reponses entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a form to edit a T360Reponses entity.
     *
     * @param T360Reponses $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(T360Reponses $entity)
    {
        $form = $this->createForm(new T360ReponsesType(), $entity, array(
            'action' => $this->generateUrl('t360reponses_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing T360Reponses entity.
     *
     * @Route("/{id}", name="t360reponses_update")
     * @Method("PUT")
     * @Template("AppT360Bundle:T360Reponses:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataLayerBundle:T360Reponses')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find T360Reponses entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('t360reponses_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a T360Reponses entity.
     *
     * @Route("/{id}", name="t360reponses_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DataLayerBundle:T360Reponses')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find T360Reponses entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('t360reponses'));
    }

    /**
     * Creates a form to delete a T360Reponses entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('t360reponses_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }


    /**
     * @Route("/eval/{idEval}", name="get_reponses_by_eval")
     *
     */
    public function getResponsesByEvalAction($idEval)
    {

        $serializer = $this->container->get('jms_serializer');

        $reponsegenerale = $this->container->get('t360reponse.service')->getReponsesByEvaluation($idEval);

        $reponseSup = $this->container->get('t360reponse.service')->getSuperieurResponsesByEvaluation($idEval);
        $reponseSubordonne = $this->container->get('t360reponse.service')->getSubordoneeResponsesByEvaluation($idEval);
        $reponseAuto = $this->container->get('t360reponse.service')->getAutoResponsesByEvaluation($idEval);
        //Collegue not implemented ... waiting for further data.
        //$reponseCollegue=$this->container->get('t360reponse.service')->getCollegueResponsesByEvaluation($idEval);

        $reponse = array("reponseGenerale" => $reponsegenerale, "reponseSubordonne" => $reponseSubordonne, "reponseSup" => $reponseSup, "reponseAuto" => $reponseAuto);

        for ($i = 0; $i < count($reponsegenerale); $i++) {
            try {
                $reponsegenerale[$i]["reponseSubordonne"] = $reponseSubordonne[$i]['average'];
            } catch (\Exception $ex) {
            }
            try {
                $reponsegenerale[$i]["reponseSup"] = $reponseSup[$i]['average'];
            } catch (\Exception $ex) {
            }
            try {
                $reponsegenerale[$i]["reponseAuto"] = $reponseAuto[$i]['average'];
            } catch (\Exception $ex) {
            }

        }

        $response = new Response($serializer->serialize($reponsegenerale, 'json'));
        //$response=new Response($serializer->serialize($reponse,'json'),200,array('Content-Type'=>'application/json'));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/results/{idEval}", name="get_results")
     * @Template()
     */
    public function showResultsAction($idEval)
    {

        $serializer = $this->container->get('jms_serializer');

        $reponsegenerale = $this->container->get('t360reponse.service')->getReponsesByEvaluation($idEval);

        $reponseSup = $this->container->get('t360reponse.service')->getSuperieurResponsesByEvaluation($idEval);
        $reponseSubordonne = $this->container->get('t360reponse.service')->getSubordoneeResponsesByEvaluation($idEval);
        $reponseAuto = $this->container->get('t360reponse.service')->getAutoResponsesByEvaluation($idEval);

        $reponseCollegue=$this->container->get('t360reponse.service')->getColleguesResponsesByEvaluation($idEval);

        $reponse = array("reponseGenerale" => $reponsegenerale, "reponseSubordonne" => $reponseSubordonne, "reponseSup" => $reponseSup, "reponseAuto" => $reponseAuto);
//            echo $reponsegenerale[0]['average'];
        for ($i = 0; $i < count($reponsegenerale); $i++) {
            if (array_key_exists ( $i , $reponseSubordonne )){
                $reponsegenerale[$i]["reponseSubordonne"] = $reponseSubordonne[$i]['average'];
            }

            if(array_key_exists ( $i , $reponseSup )){
                $reponsegenerale[$i]["reponseSup"] = $reponseSup[$i]['average'];
            }

            if(array_key_exists ( $i , $reponseAuto )){
                $reponsegenerale[$i]["reponseAuto"] = $reponseAuto[$i]['average'];
            }
            if(array_key_exists ( $i , $reponseCollegue )){
                $reponsegenerale[$i]["reponseCollegue"] = $reponseCollegue[$i]['average'];
            }
        }

        $responseGeneraleJson = $serializer->serialize($reponsegenerale, 'json');


        $ReponsesNumber = $this->container->get('t360reponse.service')->getReponsesNumberByEval($idEval);
        $all = $this->container->get('employee.service')->getNumberPersonToEvaluate($idEval);
        return array("idEval" => $idEval, "nombreDeReponse" => $ReponsesNumber, "allPersonToEvaluate" => $all,"reponseGenerale"=>$responseGeneraleJson);
    }


    /**
     * @Route("/directions/service/results", name="get_directions_results_service")
     *
     */
    public function getDirectionsResultAction()
    {
        $serializer = $this->container->get('jms_serializer');
        $reponsegenerale = $this->container->get('t360reponse.service')->getDirectionsResults();
        $response = new Response($serializer->serialize($reponsegenerale, 'json'));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/postes/service/results", name="get_postes_results_service")
     *
     */
    public function getPostesResultAction()
    {
        $serializer = $this->container->get('jms_serializer');
        $reponsegenerale = $this->container->get('t360reponse.service')->getPostesResults();
        $response = new Response($serializer->serialize($reponsegenerale, 'json'));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/directions/service/results/{id}", name="get_directions_results_service_by_id")
     *
     */
    public function getDirectionsResultByIdAction($id)
    {
        $serializer = $this->container->get('jms_serializer');
        $reponsegenerale = $this->container->get('t360reponse.service')->getDirectionsResultsById($id);
        $response = new Response($serializer->serialize($reponsegenerale, 'json'));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/postes/service/results/{id}", name="get_postes_results_service_by_id")
     *
     */
    public function getPostesResultByIdAction($id)
    {
        $serializer = $this->container->get('jms_serializer');
        $reponsegenerale = $this->container->get('t360reponse.service')->getPostesResultsById($id);
        $response = new Response($serializer->serialize($reponsegenerale, 'json'));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/directions/service/ecart/{id}", name="ecart_directions")
     */
    public function getEcartByDirection($id){
        $reponsegenerale = $this->container->get('t360reponse.service')->getReponsesByDirection_Generale($id);
        $reponseAuto = $this->container->get('t360reponse.service')->getAutoResponsesByDirection_Auto($id);
        $red=0;
        $yello=0;
        $green=0;

        for ($i = 0; $i < count($reponsegenerale); $i++) {
            if (array_key_exists ( $i , $reponseAuto )){
               if($reponsegenerale[$i]['cin']==$reponseAuto[$i]['cin']) {
                   $ecart= $reponsegenerale[$i]['average']-$reponseAuto[$i]['average'];
                   if((-0.6<=$ecart & $ecart<=0) || (0<=$ecart & $ecart<=1.8)){
                      $green=$green+1;
                   }else if(($ecart< -0.6 & $ecart >=-2.2)|| ($ecart>1.8 & $ecart <=3.2 )){
                       $yello=$yello+1;
                   }else{
                       $red=$red+1;
                   }
               }

            }
        }

        $responseArray=array("yello"=>($yello/$i)*100,"red"=>($red/$i)*100,"green"=>($green/$i)*100 );
         $serializer = $this->container->get('jms_serializer');
        $response = new Response($serializer->serialize($responseArray, 'json'));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/postes/service/ecart/{id}", name="ecart_postes")
     */
    public function getEcartByPostes($id){
        $reponsegenerale = $this->container->get('t360reponse.service')->getReponsesByPostes_Generale($id);
        $reponseAuto = $this->container->get('t360reponse.service')->getAutoResponsesByPoste_Auto($id);
        $red=0;
        $yello=0;
        $green=0;

        for ($i = 0; $i < count($reponsegenerale); $i++) {
            if (array_key_exists ( $i , $reponseAuto )){
                if($reponsegenerale[$i]['cin']==$reponseAuto[$i]['cin']) {
                    $ecart= $reponsegenerale[$i]['average']-$reponseAuto[$i]['average'];
                    if((-0.6<=$ecart & $ecart<=0) || (0<=$ecart & $ecart<=1.8)){
                        $green=$green+1;
                    }else if(($ecart< -0.6 & $ecart >=-2.2)|| ($ecart>1.8 & $ecart <=3.2 )){
                        $yello=$yello+1;
                    }else{
                        $red=$red+1;
                    }
                }

            }
        }

        $responseArray=array("yello"=>($yello/$i)*100,"red"=>($red/$i)*100,"green"=>($green/$i)*100 );
        $serializer = $this->container->get('jms_serializer');
        $response = new Response($serializer->serialize($responseArray, 'json'));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/directions/results", name="get_directions_results")
     * @Template()
     */
    public function showDirectionsResultAction()
    {
        $directions = $this->get('directions.service')->getAll();
        return array("directions" => $directions);
    }

    /**
     * @Route("/postes/results", name="get_postes_results")
     * @Template()
     */
    public function showPostesResultAction()
    {
        $postes = $this->get('postes.service')->getAll();
        return array("postes" => $postes);
    }
    /**
     * @Route("/historique/results/service/{cin}", name="get_historique_results_service")
     *
     */
    public function getHistoriqueAction($cin)
    {
        $serializer = $this->container->get('jms_serializer');
        $reponses = $this->get("t360reponse.service")->getAvgHistoriqueReponseByEmployee($cin);
        // if(sizeof($evaluations_array)!=0)
        $JsonResult = $serializer->serialize($reponses, 'json');
        //$evaluations_array[0]->getId();
        $response = new Response($JsonResult);
//        $response
//        return array("JsonResult"=>$response);
        return $response;
    }

    /**
     * @Route("/historique/results/{cin}", name="get_historique_results")
     * @Template()
     */
    public function showHistoriqueAction($cin)
    {
        $serializer = $this->container->get('jms_serializer');
        $reponses = $this->get("t360reponse.service")->getAvgHistoriqueReponseByEmployee($cin);
        // if(sizeof($evaluations_array)!=0)
        $JsonResult = $serializer->serialize($reponses, 'json');
        //$evaluations_array[0]->getId();
        $response = new Response($JsonResult);
//        $response
        return array("JsonResult" => utf8_encode($response->getContent()));
//        return array("cin"=>$cin);
//        return $response;
    }

    /**
     * @Route("/historique/employees", name="get_emplyees_for_historique")
     * @Template()
     */
    public function showEmployeeAction()
    {
        $employees = $this->get('employee.service')->getAll();
        return array("entities" => $employees);
    }

    /**
     * @Route("/reponse/{idEval}/{cinEvaluateur}")
     *
     */
    public function getEmployeeReponseByEvalAction($idEval, $cinEvaluateur)
    {

        $serializer = $this->container->get('jms_serializer');
        $reponses = $this->get("t360reponse.service")->getReponseByEvalByCin($idEval, $cinEvaluateur);

        // if(sizeof($evaluations_array)!=0)
        $JsonResult = $serializer->serialize($reponses, 'json');
        //echo $JsonResult ;
        $response = new Response($JsonResult);
        return $response;

    }

    /**
     *
     * @Route("/reponse/save", name="save_reponse")
     * @Method("POST")
     */

    public function saveResponseAction(Request $request)
    {

        $serializer = $this->container->get('jms_serializer');
        $jsonResults = $request->getContent();
//        $jsonResults = '[{"valeur":"2","id_eval":"3","id_question":"15","id_employee":"25363636"}]';
        $reponsesArray = $serializer->deserialize($jsonResults, 'Doctrine\Common\Collections\ArrayCollection', 'json');
        $this->get("t360reponse.service")->saveReponses($reponsesArray);


        return new Response(1);

    }
}
