<?php

namespace Jm\SaleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jm\SaleBundle\Entity\Apuesta
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Jm\SaleBundle\Entity\ApuestaRepository")
 */
class Apuesta
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
     * @ORM\ManyToOne(targetEntity="Partido", inversedBy="partido")
     * @ORM\JoinColumn(name="partido_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $partido;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="user")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $user;
    
    /**
     * @var integer $resultado
     *
     * @ORM\Column(name="resultado", type="integer")
     */
    private $resultado;
    
    
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
     * Set partido
     *
     * @param Jm\SaleBundle\Entity\Partido $partido
     * @return Apuesta
     */
    public function setPartido(\Jm\SaleBundle\Entity\Partido $partido = null)
    {
        $this->partido = $partido;
    
        return $this;
    }

    /**
     * Get partido
     *
     * @return Jm\SaleBundle\Entity\Partido 
     */
    public function getPartido()
    {
        return $this->partido;
    }

    /**
     * Set user
     *
     * @param Jm\SaleBundle\Entity\User $user
     * @return Apuesta
     */
    public function setUser(\Jm\SaleBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return Jm\SaleBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set resultado
     *
     * @param integer $resultado
     * @return Apuesta
     */
    public function setResultado($resultado)
    {
        $this->resultado = $resultado;
    
        return $this;
    }

    /**
     * Get resultado
     *
     * @return integer 
     */
    public function getResultado()
    {
        return $this->resultado;
    }
}