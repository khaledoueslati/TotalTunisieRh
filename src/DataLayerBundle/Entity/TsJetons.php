<?php

namespace DataLayerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TsJetons
 *
 * @ORM\Table(name="ts_jetons", indexes={@ORM\Index(name="fk_TS_Jetons_TS_Sessions_idx", columns={"TS_Sessions_idTS_Session"})})
 * @ORM\Entity
 */
class TsJetons
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
     * @var \TsSessions
     *
     * @ORM\ManyToOne(targetEntity="TsSessions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="TS_Sessions_idTS_Session", referencedColumnName="id")
     * })
     */
    private $tsSessionstsSession;



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
     * Set tsJeton
     *
     * @param string $tsJeton
     * @return TsJetons
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
     * @return TsJetons
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
     * @param \DataLayerBundle\Entity\TsSessions $tsSessionstsSession
     * @return TsJetons
     */
    public function setTsSessionstsSession(\DataLayerBundle\Entity\TsSessions $tsSessionstsSession = null)
    {
        $this->tsSessionstsSession = $tsSessionstsSession;

        return $this;
    }

    /**
     * Get tsSessionstsSession
     *
     * @return \DataLayerBundle\Entity\TsSessions 
     */
    public function getTsSessionstsSession()
    {
        return $this->tsSessionstsSession;
    }
}
