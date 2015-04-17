<?php
namespace DataLayerBundle\Managers;

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

    public function deleteQuestion($id){

        $entity = $this->EntityManager->getRepository($this->rep)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find T360Questions entity.');
        }

        $this->EntityManager->remove($entity);
        $this->EntityManager->flush();
    }
    public function getByAxe($idAxe)
    {
        return $this->EntityManager->getRepository($this->rep)->findBy(array("idAxe"=>$idAxe));
    }

    public function getQuestionPerAxes(){
        $query = $this->EntityManager->createQuery("select axes.libelle , count(question.id) as QuestionCount from DataLayerBundle:T360Questions question , DataLayerBundle:T360Axes axes
                                                    where axes.id = question.idAxe
                                                    GROUP By question.idAxe");

        return $query->getResult();
    }

} 