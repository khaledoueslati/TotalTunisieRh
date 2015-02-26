<?php

namespace DataLayerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TsReponses
 *
 * @ORM\Table(name="ts_reponses", indexes={@ORM\Index(name="fk_Reponses_Choix1_idx", columns={"Choix_idChoix"}), @ORM\Index(name="fk_Reponses_Questions1_idx", columns={"Questions_idQuestion"}), @ORM\Index(name="fk_TS_Reponses_TS_Jetons1_idx", columns={"TS_Jetons_idTS_Jeton"})})
 * @ORM\Entity
 */
class TsReponses
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idReponse", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreponse;

    /**
     * @var string
     *
     * @ORM\Column(name="Date", type="string", length=10, nullable=true)
     */
    private $date;

    /**
     * @var \TsChoix
     *
     * @ORM\ManyToOne(targetEntity="TsChoix")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Choix_idChoix", referencedColumnName="idChoix")
     * })
     */
    private $choixchoix;

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
     * @var \Jetons
     *
     * @ORM\ManyToOne(targetEntity="Jetons")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="TS_Jetons_idTS_Jeton", referencedColumnName="idTS_Jeton")
     * })
     */
    private $tsJetonstsJeton;



    /**
     * Get idreponse
     *
     * @return integer 
     */
    public function getIdreponse()
    {
        return $this->idreponse;
    }

    /**
     * Set date
     *
     * @param string $date
     * @return TsReponses
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set choixchoix
     *
     * @param \DataLayerBundle\Entity\TsChoix $choixchoix
     * @return TsReponses
     */
    public function setChoixchoix(\DataLayerBundle\Entity\TsChoix $choixchoix = null)
    {
        $this->choixchoix = $choixchoix;

        return $this;
    }

    /**
     * Get choixchoix
     *
     * @return \DataLayerBundle\Entity\TsChoix 
     */
    public function getChoixchoix()
    {
        return $this->choixchoix;
    }

    /**
     * Set questionsquestion
     *
     * @param \DataLayerBundle\Entity\TsQuestions $questionsquestion
     * @return TsReponses
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

    /**
     * Set tsJetonstsJeton
     *
     * @param \DataLayerBundle\Entity\Jetons $tsJetonstsJeton
     * @return TsReponses
     */
    public function setTsJetonstsJeton(\DataLayerBundle\Entity\Jetons $tsJetonstsJeton = null)
    {
        $this->tsJetonstsJeton = $tsJetonstsJeton;

        return $this;
    }

    /**
     * Get tsJetonstsJeton
     *
     * @return \DataLayerBundle\Entity\Jetons 
     */
    public function getTsJetonstsJeton()
    {
        return $this->tsJetonstsJeton;
    }
}
