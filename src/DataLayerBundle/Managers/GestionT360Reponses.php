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

    public function getDirectionsResults()
    {
        $query=$this->EntityManager->createQuery("Select direction.idDirection as idDirection,direction.libelle as directionLibelle, question.enonce as questionEnonce, AVG (reponse.valeur) as moyenne
                                                    from DataLayerBundle:T360Questions question , DataLayerBundle:T360Reponses reponse ,DataLayerBundle:Directions direction , DataLayerBundle:DirectionsPostes dp , DataLayerBundle:Employees employee , DataLayerBundle:T360Evaluations eval
                                                    WHERE reponse.idEval=eval.idEvaluation AND
                                                          eval.cinEvalue=employee.cin AND
                                                          dp.idDirectionPostes=employee.poste AND
                                                          direction.idDirection=dp.Direction AND
                                                          reponse.idQuestion=question.id
                                                          GROUP BY direction.idDirection , reponse.idQuestion");

        return $query->getResult();
    }

    public function getDirectionsResultsById($idDirection)
    {
        $query=$this->EntityManager->createQuery("Select direction.idDirection as idDirection,direction.libelle as directionLibelle, question.enonce as questionEnonce, AVG (reponse.valeur) as moyenne, axe.libelle as axeLibelle
                                                    from DataLayerBundle:T360Questions question , DataLayerBundle:T360Reponses reponse ,DataLayerBundle:Directions direction , DataLayerBundle:DirectionsPostes dp , DataLayerBundle:Employees employee , DataLayerBundle:T360Evaluations eval,DataLayerBundle:T360Axes axe
                                                    WHERE reponse.idEval=eval.idEvaluation AND
                                                          eval.cinEvalue=employee.cin AND
                                                          dp.idDirectionPostes=employee.poste AND
                                                          direction.idDirection=dp.Direction AND
                                                          reponse.idQuestion=question.id AND
                                                          direction.idDirection=$idDirection AND
                                                          axe.id=question.idAxe
                                                          GROUP BY axe.libelle,reponse.idQuestion");

        return $query->getResult();
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

    public function getReponsesNumberByEval($idEval)
    {

        $query = $this->EntityManager->createQuery("select count(reponse.id) as reponsesPerAxe
                                                  from DataLayerBundle:T360Reponses reponse, DataLayerBundle:T360Questions question
                                                  WHERE  reponse.idEval=$idEval and question.id = reponse.idQuestion
                                                  GROUP BY reponse.idEmployee
                                                  ");
        return count($query->getResult());
    }


} 