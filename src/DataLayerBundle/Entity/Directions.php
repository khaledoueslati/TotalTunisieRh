<?php

namespace DataLayerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Directions
 *
 * @ORM\Table(name="directions")
 * @ORM\Entity
 */
class Directions
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_direction", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDirection;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=45, nullable=false)
     */
    private $libelle;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Postes", inversedBy="idDirection")
     * @ORM\JoinTable(name="directions_postes",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_direction", referencedColumnName="id_direction")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_poste", referencedColumnName="id_poste")
     *   }
     * )
     */
    private $idPoste;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idPoste = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get idDirection
     *
     * @return integer 
     */
    public function getIdDirection()
    {
        return $this->idDirection;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Directions
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
     * Add idPoste
     *
     * @param \DataLayerBundle\Entity\Postes $idPoste
     * @return Directions
     */
    public function addIdPoste(\DataLayerBundle\Entity\Postes $idPoste)
    {
        $this->idPoste[] = $idPoste;

        return $this;
    }

    /**
     * Remove idPoste
     *
     * @param \DataLayerBundle\Entity\Postes $idPoste
     */
    public function removeIdPoste(\DataLayerBundle\Entity\Postes $idPoste)
    {
        $this->idPoste->removeElement($idPoste);
    }

    /**
     * Get idPoste
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdPoste()
    {
        return $this->idPoste;
    }
}
