<?php

namespace Jm\SaleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jm\SaleBundle\Entity\User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Jm\SaleBundle\Entity\UserRepository")
 */
class User
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $token
     *
     * @ORM\Column(name="token", type="string", length=255)
     */
    private $token;
    
    /**
     * @var string $username
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;
    
    
     /**
     * @ORM\OneToMany(targetEntity="Apuesta", mappedBy="user", cascade={"all"})
     */
    protected $apuesta;

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
     * Set token
     *
     * @param string $token
     * @return User
     */
    public function setToken($token)
    {
        $this->token = $token;
    
        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->apuesta = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add apuesta
     *
     * @param Jm\SaleBundle\Entity\Apuesta $apuesta
     * @return User
     */
    public function addApuesta(\Jm\SaleBundle\Entity\Apuesta $apuesta)
    {
        $this->apuesta[] = $apuesta;
    
        return $this;
    }

    /**
     * Remove apuesta
     *
     * @param Jm\SaleBundle\Entity\Apuesta $apuesta
     */
    public function removeApuesta(\Jm\SaleBundle\Entity\Apuesta $apuesta)
    {
        $this->apuesta->removeElement($apuesta);
    }

    /**
     * Get apuesta
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getApuesta()
    {
        return $this->apuesta;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }
}