<?php

namespace DataLayerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Employees
 *
 * @ORM\Table(name="employees", indexes={@ORM\Index(name="sup_hierarchique_idx", columns={"sup_hierarchique"}), @ORM\Index(name="role_grh_idx", columns={"role"}), @ORM\Index(name="poste_employees_idx", columns={"poste"})})
 * @ORM\Entity
 */
class Employees
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cin", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cin;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=45, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=45, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=45, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="date_embauche", type="string", length=45, nullable=true)
     */
    private $dateEmbauche;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=45, nullable=true)
     */
    private $sexe;

    /**
     * @var \DirectionsPostes
     *
     * @ORM\ManyToOne(targetEntity="DirectionsPostes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="poste", referencedColumnName="id_directions_postes")
     * })
     */
    private $poste;

    /**
     * @var \Roles
     *
     * @ORM\ManyToOne(targetEntity="Roles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role", referencedColumnName="id_roles")
     * })
     */
    private $role;

    /**
     * @var \Employees
     *
     * @ORM\ManyToOne(targetEntity="Employees")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sup_hierarchique", referencedColumnName="cin")
     * })
     */
    private $supHierarchique;



    /**
     * Get cin
     *
     * @return integer 
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Employees
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Employees
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Employees
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set dateEmbauche
     *
     * @param string $dateEmbauche
     * @return Employees
     */
    public function setDateEmbauche($dateEmbauche)
    {
        $this->dateEmbauche = $dateEmbauche;

        return $this;
    }

    /**
     * Get dateEmbauche
     *
     * @return string 
     */
    public function getDateEmbauche()
    {
        return $this->dateEmbauche;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     * @return Employees
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string 
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set poste
     *
     * @param \DataLayerBundle\Entity\DirectionsPostes $poste
     * @return Employees
     */
    public function setPoste(\DataLayerBundle\Entity\DirectionsPostes $poste = null)
    {
        $this->poste = $poste;

        return $this;
    }

    /**
     * Get poste
     *
     * @return \DataLayerBundle\Entity\DirectionsPostes 
     */
    public function getPoste()
    {
        return $this->poste;
    }

    /**
     * Set role
     *
     * @param \DataLayerBundle\Entity\Roles $role
     * @return Employees
     */
    public function setRole(\DataLayerBundle\Entity\Roles $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \DataLayerBundle\Entity\Roles 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set supHierarchique
     *
     * @param \DataLayerBundle\Entity\Employees $supHierarchique
     * @return Employees
     */
    public function setSupHierarchique(\DataLayerBundle\Entity\Employees $supHierarchique = null)
    {
        $this->supHierarchique = $supHierarchique;

        return $this;
    }

    /**
     * Get supHierarchique
     *
     * @return \DataLayerBundle\Entity\Employees 
     */
    public function getSupHierarchique()
    {
        return $this->supHierarchique;
    }

    public function __toString(){
        $var = $this->poste;
        return (string)$var;
    }
}
