<?php

namespace DataLayerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TsQuestions
 *
 * @ORM\Table(name="ts_questions", indexes={@ORM\Index(name="fk_Questions_Thematiques_idx", columns={"Thematiques_idThematique"})})
 * @ORM\Entity
 */
class TsQuestions
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
     * @ORM\Column(name="Enonce", type="string", length=100, nullable=true)
     */
    private $enonce;

    /**
     * @var \TsThematiques
     *
     * @ORM\ManyToOne(targetEntity="TsThematiques")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Thematiques_idThematique", referencedColumnName="id")
     * })
     */
    private $thematiquesthematique;



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
     * Set enonce
     *
     * @param string $enonce
     * @return TsQuestions
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
     * Set thematiquesthematique
     *
     * @param \DataLayerBundle\Entity\TsThematiques $thematiquesthematique
     * @return TsQuestions
     */
    public function setThematiquesthematique(\DataLayerBundle\Entity\TsThematiques $thematiquesthematique = null)
    {
        $this->thematiquesthematique = $thematiquesthematique;

        return $this;
    }

    /**
     * Get thematiquesthematique
     *
     * @return \DataLayerBundle\Entity\TsThematiques 
     */
    public function getThematiquesthematique()
    {
        return $this->thematiquesthematique;
    }
}
