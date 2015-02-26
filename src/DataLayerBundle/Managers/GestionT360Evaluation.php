<?php
namespace DataLayerBundle\Managers;

use Doctrine\ORM\EntityManager;
use \Symfony\Component\Config\Definition\Exception\Exception;
class GestionT360Evaluation {


    private $EntityManager;
    private $rep="DataLayerBundle:T360Evaluations";

    public function __construct(EntityManager $em)
    {
        $this->EntityManager = $em;
    }

    public function getAll()
    {
       return $this->EntityManager->getRepository($this->rep)->findAll();
    }

    public function getById($id)
    {
       return $this->EntityManager->getRepository($this->rep)->find($id);
    }

    public function getByDateDebut($date_debut){
        return $this->EntityManager->getRepository($this->rep)->findBy(array("dateDebut"=>$date_debut));
    }

    public function getByDateFin($date_fin){
        return $this->EntityManager->getRepository($this->rep)->findBy(array("dateFin"=>$date_fin));
    }
    public function getByEmployee($cin){
       // $person=$this->EntityManager->getRepository("DataLayerBundle:Employees")->find($cin);
       return $this->EntityManager->getRepository($this->rep)->findBy(array("cinEvalue"=>$cin));
    }

    public function getEvalToDiplay($cin)
    {

    }
} 