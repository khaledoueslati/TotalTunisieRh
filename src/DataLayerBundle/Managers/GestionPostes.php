<?php
namespace DataLayerBundle\Managers;

use Doctrine\ORM\EntityManager;
use \Symfony\Component\Config\Definition\Exception\Exception;

class GestionPostes
{

    private $EntityManager;
    private $rep = "DataLayerBundle:Postes";

    public function __construct(EntityManager $em)
    {
        $this->EntityManager = $em;
    }

    public function getAll()
    {
        return $this->EntityManager->getRepository($this->rep)->findAll();
    }

    public function getOrderedByDirection()
    {
        $query = $this->EntityManager->createQuery("SELECT poste.idPoste as id_poste , poste.libelle as poste_libelle, poste.niveau as poste_niveau , direction.libelle as direction_libelle  FROM DataLayerBundle:Postes poste , DataLayerBundle:DirectionsPostes dp , DataLayerBundle:Directions direction
                                                    WHERE  dp.Poste=poste.idPoste AND dp.Direction=direction.idDirection
                                                    ORDER BY direction.idDirection");

        return $query->getResult();
    }

}