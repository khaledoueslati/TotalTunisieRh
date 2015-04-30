<?php
namespace DataLayerBundle\Managers;

use Doctrine\ORM\EntityManager;
use \Symfony\Component\Config\Definition\Exception\Exception;

class GestionDirectionsPostes
{

    private $EntityManager;
    private $rep = "DataLayerBundle:DirectionsPostes";

    public function __construct(EntityManager $em)
    {
        $this->EntityManager = $em;
    }

    public function getAll()
    {
        return $this->EntityManager->getRepository($this->rep)->findAll();
    }

    public function getByPosteDirection($idPoste,$idDirection){
//        return $this->EntityManager->getRepository($this->rep)->find(array("Direction"=>$idDirection,"Poste"=>$idPoste));
        $query = $this->EntityManager->createQuery("Select dp from DataLayerBundle:DirectionsPostes dp WHERE  dp.Direction=$idDirection AND dp.Poste=$idPoste");

        return $query->getResult();

    }

}