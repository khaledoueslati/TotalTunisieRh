<?php

namespace DataLayerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Exclude;

/**
 * T360Axes
 *
 * @ORM\Table(name="t360_axes", uniqueConstraints={@ORM\UniqueConstraint(name="id_axes_UNIQUE", columns={"id"})})
 * @ORM\Entity
 */
class T360Axes
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
     * @ORM\Column(name="libelle", type="string", length=45, nullable=true)
     */
    private $libelle;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="T360Evaluations", mappedBy="idAxe")
     * @Exclude
     */
    private $idEval;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idEval = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set libelle
     *
     * @param string $libelle
     * @return T360Axes
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
     * Add idEval
     *
     * @param \DataLayerBundle\Entity\T360Evaluations $idEval
     * @return T360Axes
     */
    public function addIdEval(\DataLayerBundle\Entity\T360Evaluations $idEval)
    {
        $this->idEval[] = $idEval;

        return $this;
    }

    /**
     * Remove idEval
     *
     * @param \DataLayerBundle\Entity\T360Evaluations $idEval
     */
    public function removeIdEval(\DataLayerBundle\Entity\T360Evaluations $idEval)
    {
        $this->idEval->removeElement($idEval);
    }

    /**
     * Get idEval
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdEval()
    {
        return $this->idEval;
    }
}
