<?php

namespace App\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class DirectionPostesController
 * @package App\CommonBundle\Controller
 * @Route("directionposte")
 */
class DirectionPostesController extends Controller
{
    /**
     * @Route("/",name="directions_postes")
     * @Template()
     */
    public function indexAction()
    {
        $directions=$this->get("directions.service")->getAll();
//        $postes=$this->get("postes.service")->getOrderedByDirection();
        return array("directions"=>$directions);
    }

}
