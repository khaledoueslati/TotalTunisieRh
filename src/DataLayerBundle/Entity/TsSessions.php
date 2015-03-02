<?php

namespace DataLayerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TsSessions
 *
 * @ORM\Table(name="ts_sessions")
 * @ORM\Entity
 */
class TsSessions
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Annee", type="date", nullable=true)
     */
    private $annee;

    /**
     * @var string
     *
     * @ORM\Column(name="Details_Supp", type="string", length=100, nullable=true)
     */
    private $detailsSupp;

    /**
     * @var integer
     *
     * @ORM\Column(name="Nombre_magique", type="integer", nullable=true)
     */
    private $nombreMagique;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set annee
     *
     * @param \DateTime $annee
     * @return TsSessions
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return \DateTime 
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set detailsSupp
     *
     * @param string $detailsSupp
     * @return TsSessions
     */
    public function setDetailsSupp($detailsSupp)
    {
        $this->detailsSupp = $detailsSupp;

        return $this;
    }

    /**
     * Get detailsSupp
     *
     * @return string 
     */
    public function getDetailsSupp()
    {
        return $this->detailsSupp;
    }

    /**
     * Set nombreMagique
     *
     * @param integer $nombreMagique
     * @return TsSessions
     */
    public function setNombreMagique($nombreMagique)
    {
        $this->nombreMagique = $nombreMagique;

        return $this;
    }

    /**
     * Get nombreMagique
     *
     * @return integer 
     */
    public function getNombreMagique()
    {
        return $this->nombreMagique;
    }
}
