<?php

namespace DataLayerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * T360Reponses
 *
 * @ORM\Table(name="t360_reponses", indexes={@ORM\Index(name="eval_reponse_idx", columns={"id_eval"}), @ORM\Index(name="question_reponse_idx", columns={"id_question"}), @ORM\Index(name="jetons_reponses_idx", columns={"id_jeton"})})
 * @ORM\Entity
 */
class T360Reponses
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_reponses", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReponses;

    /**
     * @var integer
     *
     * @ORM\Column(name="valeur", type="integer", nullable=false)
     */
    private $valeur;

    /**
     * @var \T360Evaluations
     *
     * @ORM\ManyToOne(targetEntity="T360Evaluations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_eval", referencedColumnName="id_evaluation")
     * })
     */
    private $idEval;

    /**
     * @var \Jetons
     *
     * @ORM\ManyToOne(targetEntity="Jetons")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_jeton", referencedColumnName="idTS_Jeton")
     * })
     */
    private $idJeton;

    /**
     * @var \T360Questions
     *
     * @ORM\ManyToOne(targetEntity="T360Questions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_question", referencedColumnName="id_questions")
     * })
     */
    private $idQuestion;



    /**
     * Get idReponses
     *
     * @return integer 
     */
    public function getIdReponses()
    {
        return $this->idReponses;
    }

    /**
     * Set valeur
     *
     * @param integer $valeur
     * @return T360Reponses
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * Get valeur
     *
     * @return integer 
     */
    public function getValeur()
    {
        return $this->valeur;
    }

    /**
     * Set idEval
     *
     * @param \DataLayerBundle\Entity\T360Evaluations $idEval
     * @return T360Reponses
     */
    public function setIdEval(\DataLayerBundle\Entity\T360Evaluations $idEval = null)
    {
        $this->idEval = $idEval;

        return $this;
    }

    /**
     * Get idEval
     *
     * @return \DataLayerBundle\Entity\T360Evaluations 
     */
    public function getIdEval()
    {
        return $this->idEval;
    }

    /**
     * Set idJeton
     *
     * @param \DataLayerBundle\Entity\Jetons $idJeton
     * @return T360Reponses
     */
    public function setIdJeton(\DataLayerBundle\Entity\Jetons $idJeton = null)
    {
        $this->idJeton = $idJeton;

        return $this;
    }

    /**
     * Get idJeton
     *
     * @return \DataLayerBundle\Entity\Jetons 
     */
    public function getIdJeton()
    {
        return $this->idJeton;
    }

    /**
     * Set idQuestion
     *
     * @param \DataLayerBundle\Entity\T360Questions $idQuestion
     * @return T360Reponses
     */
    public function setIdQuestion(\DataLayerBundle\Entity\T360Questions $idQuestion = null)
    {
        $this->idQuestion = $idQuestion;

        return $this;
    }

    /**
     * Get idQuestion
     *
     * @return \DataLayerBundle\Entity\T360Questions 
     */
    public function getIdQuestion()
    {
        return $this->idQuestion;
    }
}
