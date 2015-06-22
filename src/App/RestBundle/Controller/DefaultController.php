<?php

namespace App\RestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 * @Route("/service")
 */
class DefaultController extends Controller
{
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
     * @Route("/allquestions")
     */
    public function getAllQuestionsAction()
    {
        $serializer = $this->container->get('jms_serializer');
        $questions_array = $this->get("t360question.service")->getAll();
        // if(sizeof($evaluations_array)!=0)
        $JsonQuestions = $serializer->serialize($questions_array, 'json');
        //$evaluations_array[0]->getId();
        $response = new Response($JsonQuestions);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     *
     * @Route("/reponse/save_from_mobile")
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




    /**
     *
     * @Route("/user/find/{cin}")
     * @Method("GET")
     * @Template()
     */
    public function findUserAction($cin)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('DataLayerBundle:Employees')->find($cin);
        $res=$this->get("jms_serializer")->serialize(array($entity), "json");
        $response =new Response($res);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    /**
     *
     * @Route("/user/add")
     * @Method("POST")
     */
    public function addUserAction()
    {
        $request = Request::createFromGlobals();
        $request->getPathInfo();
        $em = $this->getDoctrine()->getManager();
        $dat=$request->getContent();
        $response = new Response();
        $data = json_decode($dat, true);
        $username=$data['username'];
        $pass=$data['password'];
        $cin=$data['cin'];
        $user = $em->getRepository('DataLayerBundle\Entity\Employees')->find($cin);
        $user->setUserName($username);
        $user->setPassword($pass);
        $em->flush();
        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'text/html');
        return($response);
    }
    /**
     *
     * @Route("/user/login/{cin}/{password}", name="userlogin")
     * @Method("GET")
     */
    public function loginAction($cin,$password)
    {
        $request = Request::createFromGlobals();
        $request->getPathInfo();
        $em = $this->getDoctrine()->getManager();
        $dat=$request->getContent();
        $response = new Response();
        $user = $em->getRepository('DataLayerBundle\Entity\Employees')->find($cin);
        if($user->getCin()==$cin && $user->getPassword()==sha1($password))
        {
            echo '[{"allowed":"ok"}]';
        }
        else { echo '[{"allowed":"no"}]';}
        return($response);
    }
}
