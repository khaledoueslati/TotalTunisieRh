<?php


namespace DataLayerBundle\Managers;


use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityManager;
use \Symfony\Component\Config\Definition\Exception\Exception;
class GestionT360Reponses {

    private $EntityManager;
    private $rep="DataLayerBundle:T360Reponses";

    public function __construct(EntityManager $em)
    {
        $this->EntityManager = $em;
    }

    public function getByEvaluee($cin){

    }

    public function getByEvaluation($idEval){
        return $this->EntityManager->getRepository($this->rep)->findBy(array("idEval"=>$idEval));
    }

    public function ajoutReponse($reponse){
        $this->EntityManager->persist($reponse);
    }


} 