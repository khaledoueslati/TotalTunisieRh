<?php

namespace App\T360Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class T360GrilleController
 * @Route("/t360grille")
 */
class T360GrilleController extends Controller
{
    /**
     * @Route("/eval/{idEval}/{resp}",name="get_grille_by_eval")
     * @Template()
     */
    public function getGrilleAction($idEval,$resp)
    {
        if($resp==0)
        {

            $evaluation=$this->get("t360evaluation.service")->getById($idEval);
            $questions=array();
            $countQuestions=0;
            foreach ($evaluation->getIdAxe() as $idAxe){
                $temp= $this->get("t360question.service")->getByAxe($idAxe);
                $countQuestions+=count($temp);
                array_push($questions,$temp);
            }
            return array("evaluation"=>$evaluation,"axes"=>$evaluation->getIdAxe(),"questions"=>$questions ,"questionCount"=>$countQuestions);
        }elseif ($resp==1)
        {

            $evaluation=$this->get("t360evaluation.service")->getById($idEval);
            $oldResponses=$this->get("t360reponse.service")->getReponseByEvalByCin($idEval,$this->get("security.context")->getToken()->getUser()->getCin());
            $questions=array();
            $countQuestions=0;
            foreach ($evaluation->getIdAxe() as $idAxe){
                $temp= $this->get("t360question.service")->getByAxe($idAxe);
                $countQuestions+=count($temp);
                array_push($questions,$temp);
            }
            return array("evaluation"=>$evaluation,"axes"=>$evaluation->getIdAxe(),"questions"=>$questions ,"questionCount"=>$countQuestions,'oldReponses'=>$oldResponses);
        }
    }

}
