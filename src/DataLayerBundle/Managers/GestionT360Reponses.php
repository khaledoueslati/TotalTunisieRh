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

    public function getReponsesByEvaluation($idEval)
    {
        $query = $this->EntityManager->createQuery("select IDENTITY (reponse.idQuestion) as idQuestion, question.enonce ,avg(reponse.valeur ) as average
                                                    from DataLayerBundle:T360Reponses reponse,DataLayerBundle:T360Questions question
                                                    WHERE  reponse.idEval=$idEval And reponse.idQuestion=question.id
                                                    GROUP By reponse.idQuestion");

        return $query->getResult();
    }

    public function getSuperieurResponsesByEvaluation($idEval)
    {
        $query = $this->EntityManager->createQuery("select IDENTITY (reponse.idQuestion) as idQuestion, question.enonce ,avg(reponse.valeur ) as average
                                                    from DataLayerBundle:T360Reponses reponse,DataLayerBundle:T360Questions question, DataLayerBundle:T360Evaluations evaluation,DataLayerBundle:Employees employee
                                                    WHERE  reponse.idEval=$idEval  And
                                                            reponse.idQuestion=question.id and
                                                            reponse.idEval=evaluation.idEvaluation AND
                                                            evaluation.cinEvalue=employee.cin AND
                                                            employee.supHierarchique=reponse.idEmployee
                                                    GROUP By reponse.idQuestion");

        return $query->getResult();
    }

    public function getSubordoneeResponsesByEvaluation($idEval){
        $query = $this->EntityManager->createQuery("select IDENTITY (reponse.idQuestion) as idQuestion, question.enonce ,avg(reponse.valeur ) as average
                                                    from DataLayerBundle:T360Reponses reponse,DataLayerBundle:T360Questions question, DataLayerBundle:T360Evaluations evaluation,DataLayerBundle:Employees employee,DataLayerBundle:Employees employeeSub
                                                    WHERE  reponse.idEval=$idEval  And
                                                            reponse.idQuestion=question.id and
                                                            reponse.idEval=evaluation.idEvaluation AND
                                                            evaluation.cinEvalue=employee.cin AND
                                                            reponse.idEmployee=employeeSub.cin AND
                                                            employeeSub.supHierarchique=employee.cin
                                                    GROUP By reponse.idQuestion");

        return $query->getResult();
    }

    public function getColleguesResponsesByEvaluation($idEval){
        //a remplir plus tard car manque de donnée dans la base
    }

    public function getAutoResponsesByEvaluation($idEval){
        $query = $this->EntityManager->createQuery("select IDENTITY (reponse.idQuestion) as idQuestion, question.enonce ,avg(reponse.valeur ) as average
                                                    from DataLayerBundle:T360Reponses reponse,DataLayerBundle:T360Questions question, DataLayerBundle:T360Evaluations evaluation,DataLayerBundle:Employees employee
                                                    WHERE  reponse.idEval=$idEval  And
                                                            reponse.idQuestion=question.id and
                                                            reponse.idEval=evaluation.idEvaluation AND
                                                            evaluation.cinEvalue=employee.cin AND
                                                            employee.cin=reponse.idEmployee
                                                    GROUP By reponse.idQuestion");

        return $query->getResult();
    }
    public function ajoutReponse($reponse){
        $this->EntityManager->persist($reponse);
    }


} 