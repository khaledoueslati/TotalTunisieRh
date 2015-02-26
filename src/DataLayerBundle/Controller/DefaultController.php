<?php

namespace DataLayerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{

    /**
     * @Route("/test/{cin}")
     * @Template()
     */
    public function indexAction($cin)
    {
        $person=$this->get("t360evaluation.service")->getByEmployee($cin);
        $res=$this->get("jms_serializer")->serialize($person, "json");
        return array('name' => $res);
    }
}
