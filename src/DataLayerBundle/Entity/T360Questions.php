<?php

namespace DataLayerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * T360Questions
 *
 * @ORM\Table(name="t360_questions", indexes={@ORM\Index(name="axe_idx", columns={"id_axe"})})
 * @ORM\Entity
 */
class T360Questions
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_questions", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idQuestions;

    /**
     * @var string
     *
     * @ORM\Column(name="enonce", type="string", length=45, nullable=false)
     */
    private $enonce;

    /**
     * @var \T360Axes
     *
     * @ORM\ManyToOne(targetEntity="T360Axes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_axe", referencedColumnName="id_axes")
     * })
     */
    private $idAxe;



    /**
     * Get idQuestions
     *
     * @return integer 
     */
    public function getIdQuestions()
    {
        return $this->idQuestions;
    }

    /**
     * Set enonce
     *
     * @param string $enonce
     * @return T360Questions
     */
    public function setEnonce($enonce)
    {
        $this->enonce = $enonce;

        return $this;
    }

    /**
     * Get enonce
     *
     * @return string 
     */
    public function getEnonce()
    {
        return $this->enonce;
    }

    /**
     * Set idAxe
     *
     * @param \DataLayerBundle\Entity\T360Axes $idAxe
     * @return T360Questions
     */
    public function setIdAxe(\DataLayerBundle\Entity\T360Axes $idAxe = null)
    {
        $this->idAxe = $idAxe;

        return $this;
    }

    /**
     * Get idAxe
     *
     * @return \DataLayerBundle\Entity\T360Axes 
     */
    public function getIdAxe()
    {
        return $this->idAxe;
    }
}
