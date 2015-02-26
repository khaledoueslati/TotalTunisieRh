<?php

namespace DataLayerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comptes
 *
 * @ORM\Table(name="comptes")
 * @ORM\Entity
 */
class Comptes
{
    /**
     * @var string
     *
     * @ORM\Column(name="mdp", type="string", length=20, nullable=false)
     */
    private $mdp;

    /**
     * @var string
     *
     * @ORM\Column(name="identite_smartphone", type="string", length=60, nullable=false)
     */
    private $identiteSmartphone;

    /**
     * @var \Employees
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Employees")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cin", referencedColumnName="cin")
     * })
     */
    private $cin;



    /**
     * Set mdp
     *
     * @param string $mdp
     * @return Comptes
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Get mdp
     *
     * @return string 
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Set identiteSmartphone
     *
     * @param string $identiteSmartphone
     * @return Comptes
     */
    public function setIdentiteSmartphone($identiteSmartphone)
    {
        $this->identiteSmartphone = $identiteSmartphone;

        return $this;
    }

    /**
     * Get identiteSmartphone
     *
     * @return string 
     */
    public function getIdentiteSmartphone()
    {
        return $this->identiteSmartphone;
    }

    /**
     * Set cin
     *
     * @param \DataLayerBundle\Entity\Employees $cin
     * @return Comptes
     */
    public function setCin(\DataLayerBundle\Entity\Employees $cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return \DataLayerBundle\Entity\Employees 
     */
    public function getCin()
    {
        return $this->cin;
    }
}
