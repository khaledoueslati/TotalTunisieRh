<?php

namespace DataLayerBundle\Controller;

use DataLayerBundle\Entity\T360Evaluations;
use DataLayerBundle\Entity\T360Questions;
use DataLayerBundle\Entity\T360Reponses;
use Proxies\__CG__\DataLayerBundle\Entity\Employees;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Intl\Data\Util\ArrayAccessibleResourceBundle;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

    /**
     * @Route("/test")
     * @Template()
     */
    public function indexAction()
    {

        //$person=$this->get("t360evaluation.service")->getEvalToDiplay($cin);
       // if($type=="service"){
            //appel du Web Service
            //$serializer = $this->container->get('jms_serializer');
            //$test=Array("name"=>$type,"lastname"=>$cin);
            //$JsonPerson = $serializer->serialize($test, 'json');

            $serializer = $this->container->get('jms_serializer');
            //$evaluations_array=$this->get("t360evaluation.service")->getEvalToDiplay($cin);
            // if(sizeof($evaluations_array)!=0)
            //$JsonPerson = $serializer->serialize($evaluations_array, 'json');
            $reponse=new T360Reponses();
        $employee=new Employees();$employee->setNom("khaled");
        $eval=new T360Evaluations();$eval->setDateDebut("55555");
        $question=new T360Questions();$question->setEnonce("test");
            $reponse->setIdEmployee($employee);$reponse->setIdEval($eval);$reponse->setIdQuestion($question);$reponse->setValeur(22);

            $response =new Response($serializer->serialize($reponse,'json'));
            $response->headers->set('Content-Type', 'application/json');
            return $response;


    }
}
