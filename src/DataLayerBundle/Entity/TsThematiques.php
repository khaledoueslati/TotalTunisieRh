<?php

namespace DataLayerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TsThematiques
 *
 * @ORM\Table(name="ts_thematiques")
 * @ORM\Entity
 */
class TsThematiques
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idThematique", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idthematique;

    /**
     * @var string
     *
     * @ORM\Column(name="Libelle", type="string", length=30, nullable=true)
     */
    private $libelle;



    /**
     * Get idthematique
     *
     * @return integer 
     */
    public function getIdthematique()
    {
        return $this->idthematique;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return TsThematiques
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
}
