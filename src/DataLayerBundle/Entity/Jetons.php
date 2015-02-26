<?php

namespace DataLayerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jetons
 *
 * @ORM\Table(name="jetons", indexes={@ORM\Index(name="fk_TS_Jetons_TS_Sessions_idx", columns={"TS_Sessions_idTS_Session"})})
 * @ORM\Entity
 */
class Jetons
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idTS_Jeton", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtsJeton;

    /**
     * @var string
     *
     * @ORM\Column(name="TS_Jeton", type="string", length=45, nullable=true)
     */
    private $tsJeton;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Valide", type="boolean", nullable=true)
     */
    private $valide = '0';

    /**
     * @var \SessionsRh
     *
     * @ORM\ManyToOne(targetEntity="SessionsRh")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="TS_Sessions_idTS_Session", referencedColumnName="idTS_Session")
     * })
     */
    private $tsSessionstsSession;



    /**
     * Get idtsJeton
     *
     * @return integer 
     */
    public function getIdtsJeton()
    {
        return $this->idtsJeton;
    }

    /**
     * Set tsJeton
     *
     * @param string $tsJeton
     * @return Jetons
     */
    public function setTsJeton($tsJeton)
    {
        $this->tsJeton = $tsJeton;

        return $this;
    }

    /**
     * Get tsJeton
     *
     * @return string 
     */
    public function getTsJeton()
    {
        return $this->tsJeton;
    }

    /**
     * Set valide
     *
     * @param boolean $valide
     * @return Jetons
     */
    public function setValide($valide)
    {
        $this->valide = $valide;

        return $this;
    }

    /**
     * Get valide
     *
     * @return boolean 
     */
    public function getValide()
    {
        return $this->valide;
    }

    /**
     * Set tsSessionstsSession
     *
     * @param \DataLayerBundle\Entity\SessionsRh $tsSessionstsSession
     * @return Jetons
     */
    public function setTsSessionstsSession(\DataLayerBundle\Entity\SessionsRh $tsSessionstsSession = null)
    {
        $this->tsSessionstsSession = $tsSessionstsSession;

        return $this;
    }

    /**
     * Get tsSessionstsSession
     *
     * @return \DataLayerBundle\Entity\SessionsRh 
     */
    public function getTsSessionstsSession()
    {
        return $this->tsSessionstsSession;
    }
}
