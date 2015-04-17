<?php
namespace DataLayerBundle\Managers;

use Doctrine\DBAL\Query\QueryBuilder;
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
        $repository=$this->EntityManager->getRepository("DataLayerBundle:Employees");
        $person=$repository->find($cin);
        $id_direction=$person->getPoste()->getDirection()->getIdDirection();
        $niveauPoste=$person->getPoste()->getPoste()->getNiveau();
        $Superieur=$person->getSupHierarchique();

        if(!$Superieur){
            //le cas du DG
            $query=$this->EntityManager->createQuery("select eval as evaluation , (select count(reponse.id) from DataLayerBundle:T360Reponses reponse WHERE reponse.idEmployee=$cin AND reponse.idEval=eval.idEvaluation )as rep
                                                  from DataLayerBundle:T360Evaluations eval,DataLayerBundle:Employees employee,DataLayerBundle:DirectionsPostes dp,DataLayerBundle:Postes poste
                                                  WHERE (eval.cinEvalue=$cin) OR
                                                        (eval.cinEvalue=employee.cin AND employee.supHierarchique=$cin)" );

        }else if($niveauPoste==1) {
            //le cas d'un directeur de departement
            $cinSup=$Superieur->getCin();
            $query=$this->EntityManager->createQuery("select eval as evaluation , (select count(reponse.id) from DataLayerBundle:T360Reponses reponse WHERE reponse.idEmployee=$cin AND reponse.idEval=eval.idEvaluation )as rep
                                                  from DataLayerBundle:T360Evaluations eval,DataLayerBundle:Employees employee,DataLayerBundle:DirectionsPostes dp,DataLayerBundle:Postes poste
                                                  WHERE (eval.cinEvalue=employee.cin AND employee.supHierarchique=$cinSup)  OR
                                                        (eval.cinEvalue=$cinSup) OR
                                                        (eval.cinEvalue=employee.cin AND employee.supHierarchique=$cin) OR
                                                        (eval.cinEvalue=$cin)

                                                        " );

        }else{
            // le cas general
            $cinSup=$Superieur->getCin();
            $query=$this->EntityManager->createQuery("select eval as evaluation , (select count(reponse.id) from DataLayerBundle:T360Reponses reponse WHERE reponse.idEmployee=$cin AND reponse.idEval=eval.idEvaluation )as rep
                                                  from DataLayerBundle:T360Evaluations eval,DataLayerBundle:Employees employee,DataLayerBundle:DirectionsPostes dp,DataLayerBundle:Postes poste
                                                  WHERE (employee.poste=dp.idDirectionPostes AND
                                                        dp.Direction=$id_direction AND
                                                        eval.cinEvalue=employee.cin AND
                                                        dp.Poste=poste.idPoste AND
                                                        poste.niveau=$niveauPoste)  OR
                                                        (eval.cinEvalue=$cinSup) OR
                                                        (eval.cinEvalue=employee.cin AND employee.supHierarchique=$cin)

                                                        " );

        }
        return $query->getResult();

    }

} 