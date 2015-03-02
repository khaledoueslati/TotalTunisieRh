<?php
namespace DataLayerBundle\Managers;

use Doctrine\ORM\EntityManager;
use \Symfony\Component\Config\Definition\Exception\Exception;

class GestionEmployee {

    private $EntityManager;
    private $rep="DataLayerBundle:Employees";

    public function __construct(EntityManager $em)
    {
        $this->EntityManager = $em;
    }

    public function getAll()
    {
        return $this->EntityManager->getRepository($this->rep)->findAll();
    }

    public function authenticate($id,$password){
        return $this->EntityManager->getRepository($this->rep);
    }

    public function getById($id)
    {
        //return $this->EntityManager->getRepository("DataLayerBundle:DirectionsPostes")->find($id);
        return $this->EntityManager->getRepository($this->rep)->find($id);
    }

    public function Create($entity)
    {
        try{
            $this->EntityManager->persist($entity);
            $this->EntityManager->flush();
        }catch (Exception $ex){

        }


    }



    public function Delete($entity)
    {
        try{
            $this->EntityManager->remove($entity);
            $this->EntityManager->flush();
        }catch (Exception $ex){
            return null;
        }
    }



} 