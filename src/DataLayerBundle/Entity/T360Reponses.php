<?php

namespace DataLayerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * T360Reponses
 *
 * @ORM\Table(name="t360_reponses", indexes={@ORM\Index(name="id_employee", columns={"id_employee"}), @ORM\Index(name="id_eval", columns={"id_eval"}), @ORM\Index(name="id_question", columns={"id_question"})})
 * @ORM\Entity
 */
class T360Reponses
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
     * @var integer
     *
     * @ORM\Column(name="valeur", type="integer", nullable=false)
     */
    private $valeur;

    /**
     * @var \Employees
     *
     * @ORM\ManyToOne(targetEntity="Employees")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_employee", referencedColumnName="cin")
     * })
     */
    private $idEmployee;

    /**
     * @var \T360Evaluations
     *
     * @ORM\ManyToOne(targetEntity="T360Evaluations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_eval", referencedColumnName="id")
     * })
     */
    private $idEval;

    /**
     * @var \T360Questions
     *
     * @ORM\ManyToOne(targetEntity="T360Questions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_question", referencedColumnName="id")
     * })
     */
    private $idQuestion;



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
     * Set idEmployee
     *
     * @param \DataLayerBundle\Entity\Employees $idEmployee
     * @return T360Reponses
     */
    public function setIdEmployee(\DataLayerBundle\Entity\Employees $idEmployee = null)
    {
        $this->idEmployee = $idEmployee;

        return $this;
    }

    /**
     * Get idEmployee
     *
     * @return \DataLayerBundle\Entity\Employees 
     */
    public function getIdEmployee()
    {
        return $this->idEmployee;
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
