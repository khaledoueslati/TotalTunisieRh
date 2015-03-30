<?php

namespace App\T360Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{idEval}")
     * @Template()
     */
    public function indexAction($idEval)
    {
        $reponsegenerale=$this->container->get('t360reponse.service')->getReponsesNumberByEval($idEval);
        $all=$this->container->get('employee.service')->getNumberPersonToEvaluate($idEval);
//        $totalreponse=0;
//        foreach ($reponsegenerale as $value){
//            $totalreponse+=$value->reponsesPerAxe;
//        }

        return array('repondu' => $reponsegenerale,'all'=>$all);
    }
}
