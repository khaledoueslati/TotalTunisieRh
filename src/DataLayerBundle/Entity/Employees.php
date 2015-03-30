<?php

namespace DataLayerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DataLayerBundle\Entity\Postes;
use DataLayerBundle\Entity\Directions;
use DataLayerBundle\Entity\DirectionsPostes;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * Employees
 *
 * @ORM\Table(name="employees", indexes={@ORM\Index(name="sup_hierarchique_idx", columns={"sup_hierarchique"}), @ORM\Index(name="role_grh_idx", columns={"role"}), @ORM\Index(name="poste_employees_idx", columns={"poste"})})
 * @ORM\Entity
 */
class Employees implements UserInterface
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
     *   @ORM\JoinColumn(name="poste", referencedColumnName="id")
     * })
     */
    private $poste;

    /**
     * @var \Roles
     *
     * @ORM\ManyToOne(targetEntity="Roles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role", referencedColumnName="id")
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
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=45, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="identite_smartphone", type="string", length=45, nullable=false)
     */
    private $identiteSmartphone;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=45, nullable=false)
     */
    private $username;




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

    /**
     * Get identitesmartphone
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set username
     *
     * @param string $password
     * @return Employees
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getIdentiteSmartPhone()
    {
        return $this->identiteSmartphone;
    }

    /**
     * Set username
     *
     * @param string $identiteSmartphone
     * @return Employees
     */
    public function setIdentiteSmartPhone($identiteSmartphone)
    {
        $this->identiteSmartphone = $identiteSmartphone;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->username;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Employees
     */
    public function setUserName($username)
    {
        $this->username = $username;

        return $this;
    }


    public function getSalt()
    {

    }


    public function eraseCredentials()
    {
    }


    public function getRoles()
    {
        return array($this->role->getLibelle());
    }

    public function __toString(){
        return $this->poste->getDirection()->getLibelle()." ".$this->poste->getPoste()->getLibelle()." ".$this->prenom." ".$this->nom;
    }
}
