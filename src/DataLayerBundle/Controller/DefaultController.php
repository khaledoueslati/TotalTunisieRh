<?php

namespace DataLayerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{

    /**
     * @Route("/test/{type}/{cin}")
     * @Template()
     */
    public function indexAction($type,$cin)
    {

        $person=$this->get("t360evaluation.service")->getEvalToDiplay($cin);
        if($type=="service"){
            //appel du Web Service
            $serializer = $this->container->get('jms_serializer');
            $JsonPerson = $serializer->serialize($person, 'json');

            $response =new Response($JsonPerson);
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
        else{
            // appel du Web Controlleur
            return array('name' => $person);
        }

    }
}
