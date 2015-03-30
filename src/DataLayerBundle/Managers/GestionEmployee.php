<?php
namespace DataLayerBundle\Managers;

use Doctrine\ORM\EntityManager;
use \Symfony\Component\Config\Definition\Exception\Exception;

class GestionEmployee
{

    private $EntityManager;
    private $rep = "DataLayerBundle:Employees";

    public function __construct(EntityManager $em)
    {
        $this->EntityManager = $em;
    }

    public function getAll()
    {
        return $this->EntityManager->getRepository($this->rep)->findAll();
    }

    public function authenticate($id, $password)
    {
        return $this->EntityManager->getRepository($this->rep);
    }

    public function getById($id)
    {
        //return $this->EntityManager->getRepository("DataLayerBundle:DirectionsPostes")->find($id);
        return $this->EntityManager->getRepository($this->rep)->find($id);
    }

    public function Create($entity)
    {
        try {
            $this->EntityManager->persist($entity);
            $this->EntityManager->flush();
        } catch (Exception $ex) {

        }


    }

    public function Delete($entity)
    {
        try {
            $this->EntityManager->remove($entity);
            $this->EntityManager->flush();
        } catch (Exception $ex) {
            return null;
        }
    }

    public function getNumberPersonToEvaluate($idEval)
    {

        $repository = $this->EntityManager->getRepository("DataLayerBundle:T360Evaluations");
        $eval = $repository->find($idEval);
        $person = $eval->getCinEvalue();
        $cin_person = $person->getCin();
        $id_direction = $person->getPoste()->getDirection()->getIdDirection();
        $niveauPoste = $person->getPoste()->getPoste()->getNiveau();
        $Superieur = $person->getSupHierarchique();
        $cin_sup = $Superieur->getCin();

        if (!$Superieur) {
            //le cas du DG return toute les personne ayant comme superieur hierarchique $cin +1 (auto eval)
            return count($this->EntityManager->getRepository($this->rep)->findBy(array("supHierarchique" => $person))) + 1;

        } else if ($niveauPoste == 1) {
            //le cas d'un directeur de departement

            $query = $this->EntityManager->createQuery("select emploee
                                                  from DataLayerBundle:Employees employee
                                                  WHERE (employee.supHierarchique=$cin_person) OR (employee.cin=$cin_sup) OR
                                                        (employee.supHierarchique=$cin_sup)
                                                        ");
            return count($query->getResult());

        } else {
            // le cas general
            $cinSup = $Superieur->getCin();
            $query = $this->EntityManager->createQuery("select employee
                                                  from DataLayerBundle:Employees employee,DataLayerBundle:DirectionsPostes dp,DataLayerBundle:Postes poste
                                                  WHERE (employee.poste=dp.idDirectionPostes AND
                                                        dp.Direction=$id_direction AND
                                                        dp.Poste=poste.idPoste AND
                                                        poste.niveau=$niveauPoste)  OR
                                                        (employee.cin=$cin_person) OR
                                                        (employee.cin=$cin_sup) OR
                                                        (employee.supHierarchique=$cin_person)");
            return count($query->getResult());
        }
    }

}