<?php

namespace DataLayerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TsChoix
 *
 * @ORM\Table(name="ts_choix", indexes={@ORM\Index(name="fk_Choix_Questions1_idx", columns={"Questions_idQuestion"})})
 * @ORM\Entity
 */
class TsChoix
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idChoix", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idchoix;

    /**
     * @var string
     *
     * @ORM\Column(name="Libelle", type="string", length=45, nullable=true)
     */
    private $libelle;

    /**
     * @var \TsQuestions
     *
     * @ORM\ManyToOne(targetEntity="TsQuestions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Questions_idQuestion", referencedColumnName="idQuestion")
     * })
     */
    private $questionsquestion;



    /**
     * Get idchoix
     *
     * @return integer 
     */
    public function getIdchoix()
    {
        return $this->idchoix;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return TsChoix
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
     * Set questionsquestion
     *
     * @param \DataLayerBundle\Entity\TsQuestions $questionsquestion
     * @return TsChoix
     */
    public function setQuestionsquestion(\DataLayerBundle\Entity\TsQuestions $questionsquestion = null)
    {
        $this->questionsquestion = $questionsquestion;

        return $this;
    }

    /**
     * Get questionsquestion
     *
     * @return \DataLayerBundle\Entity\TsQuestions 
     */
    public function getQuestionsquestion()
    {
        return $this->questionsquestion;
    }
}
