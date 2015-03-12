<?php


namespace DataLayerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="directions_postes")
 * @ORM\Entity
 */
class DirectionsPostes {
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDirectionPostes;
    /**
     * @var \Directions
     * @ORM\ManyToOne(targetEntity="Directions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_direction", referencedColumnName="id")
     * })
     */
    private $Direction;
    /**
     * @var \Postes
     * @ORM\ManyToOne(targetEntity="Postes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_poste", referencedColumnName="id")
     * })
     */
    private $Poste;

    /**
     * @return \Directions
     */
    public function getDirection()
    {
        return $this->Direction;
    }

    /**
     * @param \Directions $Direction
     */
    public function setDirection($Direction)
    {
        $this->Direction = $Direction;
    }

    /**
     * @return \Postes
     */
    public function getPoste()
    {
        return $this->Poste;
    }

    /**
     * @param \Postes $Poste
     */
    public function setPoste($Poste)
    {
        $this->Poste = $Poste;
    }

    /**
     * @return int
     */
    public function getIdDirectionPostes()
    {
        return $this->idDirectionPostes;
    }

    /**
     * @param int $idDirectionPostes
     */
    public function setId($idDirectionPostes)
    {
        $this->id = $idDirectionPostes;
    }

    public function __toString(){
        return (string)$this->Direction->getLibelle();
    }
} 