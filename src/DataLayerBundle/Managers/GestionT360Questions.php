<?php
/**
 * Created by PhpStorm.
 * User: Khaled
 * Date: 23/02/2015
 * Time: 17:10
 */

use Doctrine\ORM\EntityManager;
use \Symfony\Component\Config\Definition\Exception\Exception;

class GestionT360Questions {

    private $EntityManager;
    private $rep="DataLayerBundle:T360Questions";

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


} 