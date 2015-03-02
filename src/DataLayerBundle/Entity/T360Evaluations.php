<?php

namespace DataLayerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * T360Evaluations
 *
 * @ORM\Table(name="t360_evaluations", indexes={@ORM\Index(name="evaluee_idx", columns={"cin_evalue"})})
 * @ORM\Entity
 */
class T360Evaluations
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
     * @ORM\Column(name="date_debut", type="string", length=45, nullable=false)
     */
    private $dateDebut;

    /**
     * @var string
     *
     * @ORM\Column(name="date_fin", type="string", length=45, nullable=true)
     */
    private $dateFin;

    /**
     * @var \Employees
     *
     * @ORM\ManyToOne(targetEntity="Employees")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cin_evalue", referencedColumnName="cin")
     * })
     */
    private $cinEvalue;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="T360Axes", inversedBy="idEval")
     * @ORM\JoinTable(name="t360_eval_axes",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_eval", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_axe", referencedColumnName="id")
     *   }
     * )
     */
    private $idAxe;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idAxe = new \Doctrine\Common\Collections\ArrayCollection();
    }


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
     * Set dateDebut
     *
     * @param string $dateDebut
     * @return T360Evaluations
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return string 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param string $dateFin
     * @return T360Evaluations
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return string 
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set cinEvalue
     *
     * @param \DataLayerBundle\Entity\Employees $cinEvalue
     * @return T360Evaluations
     */
    public function setCinEvalue(\DataLayerBundle\Entity\Employees $cinEvalue = null)
    {
        $this->cinEvalue = $cinEvalue;

        return $this;
    }

    /**
     * Get cinEvalue
     *
     * @return \DataLayerBundle\Entity\Employees 
     */
    public function getCinEvalue()
    {
        return $this->cinEvalue;
    }

    /**
     * Add idAxe
     *
     * @param \DataLayerBundle\Entity\T360Axes $idAxe
     * @return T360Evaluations
     */
    public function addIdAxe(\DataLayerBundle\Entity\T360Axes $idAxe)
    {
        $this->idAxe[] = $idAxe;

        return $this;
    }

    /**
     * Remove idAxe
     *
     * @param \DataLayerBundle\Entity\T360Axes $idAxe
     */
    public function removeIdAxe(\DataLayerBundle\Entity\T360Axes $idAxe)
    {
        $this->idAxe->removeElement($idAxe);
    }

    /**
     * Get idAxe
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdAxe()
    {
        return $this->idAxe;
    }
}
