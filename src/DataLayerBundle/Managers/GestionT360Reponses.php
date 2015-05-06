<?php


namespace DataLayerBundle\Managers;


use DataLayerBundle\Entity\T360Reponses;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityManager;
use \Symfony\Component\Config\Definition\Exception\Exception;

class GestionT360Reponses
{

    private $EntityManager;
    private $rep = "DataLayerBundle:T360Reponses";

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

    public function getSubordoneeResponsesByEvaluation($idEval)
    {
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

    public function getColleguesResponsesByEvaluation($idEval)
    {
        $query = $this->EntityManager->createQuery("select IDENTITY (reponse.idQuestion) as idQuestion, question.enonce ,avg(reponse.valeur ) as average
                                                    from DataLayerBundle:T360Reponses reponse, DataLayerBundle:T360Questions question, DataLayerBundle:T360Evaluations evaluation,DataLayerBundle:Employees employee,DataLayerBundle:Employees employeeCollegue
                                                    WHERE   reponse.idEval=$idEval  And
                                                            reponse.idQuestion=question.id and
                                                            reponse.idEval=evaluation.idEvaluation AND
                                                            evaluation.cinEvalue=employee.cin AND
                                                            reponse.idEmployee=employeeCollegue.cin AND
                                                            employeeCollegue.supHierarchique=employee.supHierarchique
                                                    GROUP By reponse.idQuestion");

        return $query->getResult();
    }

    public function getDirectionsResults()
    {
        $query = $this->EntityManager->createQuery("Select direction.idDirection as idDirection,direction.libelle as directionLibelle, question.enonce as questionEnonce, AVG (reponse.valeur) as moyenne
                                                    from DataLayerBundle:T360Questions question , DataLayerBundle:T360Reponses reponse ,DataLayerBundle:Directions direction , DataLayerBundle:DirectionsPostes dp , DataLayerBundle:Employees employee , DataLayerBundle:T360Evaluations eval
                                                    WHERE reponse.idEval=eval.idEvaluation AND
                                                          eval.cinEvalue=employee.cin AND
                                                          dp.idDirectionPostes=employee.poste AND
                                                          direction.idDirection=dp.Direction AND
                                                          reponse.idQuestion=question.id
                                                          GROUP BY direction.idDirection , reponse.idQuestion");

        return $query->getResult();
    }

    public function getPostesResults()
    {
        $query = $this->EntityManager->createQuery("Select poste.idPoste as idPoste,poste.libelle as posteLibelle, question.enonce as questionEnonce, AVG (reponse.valeur) as moyenne
                                                    from DataLayerBundle:T360Questions question , DataLayerBundle:T360Reponses reponse ,DataLayerBundle:Postes poste , DataLayerBundle:DirectionsPostes dp , DataLayerBundle:Employees employee , DataLayerBundle:T360Evaluations eval
                                                    WHERE reponse.idEval=eval.idEvaluation AND
                                                          eval.cinEvalue=employee.cin AND
                                                          dp.idDirectionPostes=employee.poste AND
                                                          poste.idPoste=dp.Poste AND
                                                          reponse.idQuestion=question.id
                                                          GROUP BY poste.idPoste , reponse.idQuestion");

        return $query->getResult();
    }

    public function getDirectionsResultsById($idDirection)
    {
        $query = $this->EntityManager->createQuery("Select direction.idDirection as idDirection,direction.libelle as directionLibelle, question.enonce as questionEnonce, AVG (reponse.valeur) as moyenne, axe.libelle as axeLibelle
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

    public function getPostesResultsById($idPoste)
    {
        $query = $this->EntityManager->createQuery("Select poste.idPoste as idPoste,poste.libelle as posteLibelle, question.enonce as questionEnonce, AVG (reponse.valeur) as moyenne, axe.libelle as axeLibelle
                                                    from DataLayerBundle:T360Questions question , DataLayerBundle:T360Reponses reponse ,DataLayerBundle:Postes poste , DataLayerBundle:DirectionsPostes dp , DataLayerBundle:Employees employee , DataLayerBundle:T360Evaluations eval,DataLayerBundle:T360Axes axe
                                                    WHERE reponse.idEval=eval.idEvaluation AND
                                                          eval.cinEvalue=employee.cin AND
                                                          dp.idDirectionPostes=employee.poste AND
                                                          poste.idPoste=dp.Poste AND
                                                          reponse.idQuestion=question.id AND
                                                          poste.idPoste=$idPoste AND
                                                          axe.id=question.idAxe
                                                          GROUP BY axe.libelle,reponse.idQuestion");

        return $query->getResult();
    }

    public function getAutoResponsesByEvaluation($idEval)
    {
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

    public function ajoutReponse($reponse)
    {
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

    /*****************************Historique*******************************************************************/

    public function getAvgReponsesByEmployee($cin)
    {
        $query = $this->EntityManager->createQuery("select IDENTITY (reponse.idQuestion) as idQuestion, question.enonce ,avg(reponse.valeur ) as average,eval.dateDebut
                                                    from DataLayerBundle:T360Reponses reponse,DataLayerBundle:T360Questions question,DataLayerBundle:T360Evaluations eval
                                                    WHERE  reponse.idEval=eval.idEvaluation And reponse.idQuestion=question.id AND eval.cinEvalue=$cin
                                                    GROUP By eval.dateDebut,reponse.idQuestion");

        return $query->getResult();
    }

    public function getAvgSuperieurResponsesByEmployee($cin)
    {
        $query = $this->EntityManager->createQuery("select IDENTITY (reponse.idQuestion) as idQuestion, question.enonce ,avg(reponse.valeur ) as average ,evaluation.dateDebut
                                                    from DataLayerBundle:T360Reponses reponse,DataLayerBundle:T360Questions question, DataLayerBundle:T360Evaluations evaluation,DataLayerBundle:Employees employee
                                                    WHERE  reponse.idEval=evaluation.idEvaluation  And
                                                            reponse.idQuestion=question.id and
                                                            reponse.idEval=evaluation.idEvaluation AND
                                                            evaluation.cinEvalue=$cin AND
                                                            employee.cin=$cin AND
                                                            employee.supHierarchique=reponse.idEmployee
                                                    GROUP By evaluation.dateDebut,reponse.idQuestion");

        return $query->getResult();
    }

    public function getAvgSubordoneeResponsesByEmployee($cin)
    {
        $query = $this->EntityManager->createQuery("select IDENTITY (reponse.idQuestion) as idQuestion, question.enonce ,avg(reponse.valeur ) as average, evaluation.dateDebut
                                                    from DataLayerBundle:T360Reponses reponse,DataLayerBundle:T360Questions question, DataLayerBundle:T360Evaluations evaluation,DataLayerBundle:Employees employee,DataLayerBundle:Employees employeeSub
                                                    WHERE  reponse.idEval=evaluation.idEvaluation  And
                                                            reponse.idQuestion=question.id and
                                                            employee.cin=$cin And
                                                            evaluation.cinEvalue=employee.cin AND
                                                            reponse.idEmployee=employeeSub.cin AND
                                                            employeeSub.supHierarchique=employee.cin
                                                    GROUP By evaluation.dateDebut,reponse.idQuestion");

        return $query->getResult();
    }

    public function getAvgColleguesResponsesByEmployee($cin)
    {
        //a remplir plus tard car manque de donnée dans la base
    }

    public function getAvgHistoriqueReponseByEmployee($cin)
    {
        $query = $this->EntityManager->createQuery("select IDENTITY (reponse.idQuestion) as idQuestion, question.enonce ,avg(reponse.valeur ) as average, evaluation.dateDebut ,axe.libelle
                                                    from DataLayerBundle:T360Axes axe,DataLayerBundle:T360Reponses reponse,DataLayerBundle:T360Questions question, DataLayerBundle:T360Evaluations evaluation,DataLayerBundle:Employees employee,DataLayerBundle:Employees employeeSub
                                                    WHERE  reponse.idEval=evaluation.idEvaluation  And
                                                            reponse.idQuestion=question.id and
                                                            employee.cin=$cin And
                                                            evaluation.cinEvalue=employee.cin AND
                                                            question.idAxe=axe.id
                                                    GROUP By evaluation.dateDebut,reponse.idQuestion");

        return $query->getResult();
    }

    public function  getReponseByEvalByCin($idEval, $cinEvaluateur)
    {

        $query = $this->EntityManager->createQuery("select reponse.id , reponse.valeur , IDENTITY (reponse.idEmployee), IDENTITY (reponse.idEval), IDENTITY (reponse.idQuestion) from DataLayerBundle:T360Reponses reponse WHERE reponse.idEmployee=$cinEvaluateur AND reponse.idEval=$idEval");

        return $query->getResult();

    }
    /*****************************************---******************************************************/
    public function saveReponses($reponsesArray)
    {
        foreach ($reponsesArray as $reponse) {
            if (array_key_exists("id", $reponse)) {
                $tempReponse=$this->EntityManager->getRepository($this->rep)->find($reponse["id"]);
                $tempReponse->setValeur($reponse["valeur"]);
                $this->EntityManager->flush();
            } else {
                $entity=new T360Reponses();
                $entity->setIdEmployee($this->EntityManager->getReference("DataLayerBundle:Employees",$reponse["id_employee"]));
                $entity->setIdQuestion($this->EntityManager->getReference("DataLayerBundle:T360Questions",$reponse["id_question"]));
                $entity->setIdEval($this->EntityManager->getReference("DataLayerBundle:T360Evaluations",$reponse["id_eval"]));
                $entity->setValeur($reponse["valeur"]);
                $this->EntityManager->persist($entity);
                $this->EntityManager->flush();
            }
        }
    }

    public function getReponsesByDirection_Generale($idDirection)
    {
        $query = $this->EntityManager->createQuery("select  avg(reponse.valeur ) as average ,employee.cin
                                                    from DataLayerBundle:T360Reponses reponse,DataLayerBundle:Employees employee, DataLayerBundle:DirectionsPostes dp, DataLayerBundle:Directions dir , DataLayerBundle:T360Evaluations evaluation
                                                    WHERE reponse.idEval=evaluation.idEvaluation AND
                                                          evaluation.cinEvalue = employee.cin AND
                                                          employee.poste=dp.idDirectionPostes AND
                                                          dp.Direction=$idDirection

                                                    GROUP BY employee.cin
                                                     ORDER BY employee.cin
                                                    ");

        return $query->getResult();
    }

    public function getReponsesByPostes_Generale($idPoste)
    {
        $query = $this->EntityManager->createQuery("select  avg(reponse.valeur ) as average ,employee.cin
                                                    from DataLayerBundle:T360Reponses reponse,DataLayerBundle:Employees employee, DataLayerBundle:DirectionsPostes dp, DataLayerBundle:Postes poste , DataLayerBundle:T360Evaluations evaluation
                                                    WHERE reponse.idEval=evaluation.idEvaluation AND
                                                          evaluation.cinEvalue = employee.cin AND
                                                          employee.poste=dp.idDirectionPostes AND
                                                          dp.Poste=$idPoste

                                                    GROUP BY employee.cin
                                                     ORDER BY employee.cin
                                                    ");

        return $query->getResult();
    }

    public function getAutoResponsesByDirection_Auto($idDirection)
    {
        $query = $this->EntityManager->createQuery("select avg(reponse.valeur ) as average ,employee.cin
                                                    from DataLayerBundle:T360Reponses reponse,DataLayerBundle:Employees employee, DataLayerBundle:DirectionsPostes dp, DataLayerBundle:Directions dir , DataLayerBundle:T360Evaluations evaluation
                                                    WHERE reponse.idEval=evaluation.idEvaluation AND
                                                          evaluation.cinEvalue = employee.cin AND
                                                          employee.poste=dp.idDirectionPostes AND
                                                          dp.Direction=dir.idDirection AND
                                                          dir.idDirection=$idDirection AND
                                                          reponse.idEmployee=employee.cin

                                                    GROUP BY employee.cin
                                                     ORDER BY employee.cin
                                                    ");

        return $query->getResult();
    }
    public function getAutoResponsesByPoste_Auto($idPoste)
    {
        $query = $this->EntityManager->createQuery("select avg(reponse.valeur ) as average ,employee.cin
                                                    from DataLayerBundle:T360Reponses reponse,DataLayerBundle:Employees employee, DataLayerBundle:DirectionsPostes dp, DataLayerBundle:Postes poste , DataLayerBundle:T360Evaluations evaluation
                                                    WHERE reponse.idEval=evaluation.idEvaluation AND
                                                          evaluation.cinEvalue = employee.cin AND
                                                          employee.poste=dp.idDirectionPostes AND
                                                          dp.Poste=poste.idPoste AND
                                                          poste.idPoste=$idPoste AND
                                                          reponse.idEmployee=employee.cin

                                                    GROUP BY employee.cin
                                                     ORDER BY employee.cin
                                                    ");

        return $query->getResult();
    }
} 