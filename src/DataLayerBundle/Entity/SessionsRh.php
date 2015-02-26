<?php

namespace DataLayerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SessionsRh
 *
 * @ORM\Table(name="sessions_rh")
 * @ORM\Entity
 */
class SessionsRh
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idTS_Session", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtsSession;

    /**
     * @var string
     *
     * @ORM\Column(name="Annee", type="text", nullable=true)
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
     * @var string
     *
     * @ORM\Column(name="methode", type="string", length=4, nullable=false)
     */
    private $methode;



    /**
     * Get idtsSession
     *
     * @return integer 
     */
    public function getIdtsSession()
    {
        return $this->idtsSession;
    }

    /**
     * Set annee
     *
     * @param string $annee
     * @return SessionsRh
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return string 
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set detailsSupp
     *
     * @param string $detailsSupp
     * @return SessionsRh
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
     * @return SessionsRh
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

    /**
     * Set methode
     *
     * @param string $methode
     * @return SessionsRh
     */
    public function setMethode($methode)
    {
        $this->methode = $methode;

        return $this;
    }

    /**
     * Get methode
     *
     * @return string 
     */
    public function getMethode()
    {
        return $this->methode;
    }
}
