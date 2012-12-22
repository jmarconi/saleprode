<?php

namespace Jm\SaleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jm\SaleBundle\Entity\Torneo
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Jm\SaleBundle\Entity\TorneoRepository")
 */
class Torneo
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
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="Fecha", mappedBy="torneo", cascade={"all"})
     */
    protected $fecha;
    
    
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
     * Set nombre
     *
     * @param string $nombre
     * @return Torneo
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fecha = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add fecha
     *
     * @param Jm\SaleBundle\Entity\Fecha $fecha
     * @return Torneo
     */
    public function addFecha(\Jm\SaleBundle\Entity\Fecha $fecha)
    {
        $this->fecha[] = $fecha;
    
        return $this;
    }

    /**
     * Remove fecha
     *
     * @param Jm\SaleBundle\Entity\Fecha $fecha
     */
    public function removeFecha(\Jm\SaleBundle\Entity\Fecha $fecha)
    {
        $this->fecha->removeElement($fecha);
    }

    /**
     * Get fecha
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFecha()
    {
        return $this->fecha;
    }
}