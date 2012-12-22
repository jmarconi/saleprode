<?php

namespace Jm\SaleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jm\SaleBundle\Entity\Fecha
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Jm\SaleBundle\Entity\FechaRepository")
 */
class Fecha
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
     * @var integer $orden
     *
     * @ORM\Column(name="orden", type="integer")
     */
    private $orden;
    
    
    /**
     * @ORM\OneToMany(targetEntity="Partido", mappedBy="fecha", cascade={"all"})
     */
    protected $partido;
    
    /**
     * @ORM\ManyToOne(targetEntity="Torneo", inversedBy="torneo")
     * @ORM\JoinColumn(name="torneo_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $torneo;
    
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
     * Set orden
     *
     * @param integer $orden
     * @return Fecha
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;
    
        return $this;
    }

    /**
     * Get orden
     *
     * @return integer 
     */
    public function getOrden()
    {
        return $this->orden;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->partido = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add partido
     *
     * @param Jm\SaleBundle\Entity\Partido $partido
     * @return Fecha
     */
    public function addPartido(\Jm\SaleBundle\Entity\Partido $partido)
    {
        $this->partido[] = $partido;
    
        return $this;
    }

    /**
     * Remove partido
     *
     * @param Jm\SaleBundle\Entity\Partido $partido
     */
    public function removePartido(\Jm\SaleBundle\Entity\Partido $partido)
    {
        $this->partido->removeElement($partido);
    }

    /**
     * Get partido
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPartido()
    {
        return $this->partido;
    }

    /**
     * Set torneo
     *
     * @param Jm\SaleBundle\Entity\Torneo $torneo
     * @return Fecha
     */
    public function setTorneo(\Jm\SaleBundle\Entity\Torneo $torneo = null)
    {
        $this->torneo = $torneo;
    
        return $this;
    }

    /**
     * Get torneo
     *
     * @return Jm\SaleBundle\Entity\Torneo 
     */
    public function getTorneo()
    {
        return $this->torneo;
    }
}