<?php

namespace DataLayerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Postes
 *
 * @ORM\Table(name="postes")
 * @ORM\Entity
 */
class Postes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPoste;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=45, nullable=true)
     */
    private $libelle;

    /**
     * @var integer
     *
     * @ORM\Column(name="niveau", type="integer", nullable=false)
     */
    private $niveau;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Directions", mappedBy="idPoste")
     */
    private $idDirection;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idDirection = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getIdPoste()
    {
        return $this->idDirection;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Postes
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set niveau
     *
     * @param integer $niveau
     * @return Postes
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return integer 
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Add idDirection
     *
     * @param \DataLayerBundle\Entity\Directions $idDirection
     * @return Postes
     */
    public function addIdDirection(\DataLayerBundle\Entity\Directions $idDirection)
    {
        $this->idDirection[] = $idDirection;

        return $this;
    }

    /**
     * Remove idDirection
     *
     * @param \DataLayerBundle\Entity\Directions $idDirection
     */
    public function removeIdDirection(\DataLayerBundle\Entity\Directions $idDirection)
    {
        $this->idDirection->removeElement($idDirection);
    }

    /**
     * Get idDirection
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdDirection()
    {
        return $this->idDirection;
    }

    public function __toString(){
        return $this->libelle;
    }
}
