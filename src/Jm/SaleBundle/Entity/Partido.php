<?php

namespace Jm\SaleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jm\SaleBundle\Entity\Partido
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Jm\SaleBundle\Entity\PartidoRepository")
 */
class Partido
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
     * @ORM\ManyToOne(targetEntity="Equipo", inversedBy="equipo")
     * @ORM\JoinColumn(name="local", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $local;
    
    /**
     * @ORM\ManyToOne(targetEntity="Equipo", inversedBy="equipo")
     * @ORM\JoinColumn(name="visitante", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $visitante;
    
    
   

    /**
     * @var integer $orden
     *
     * @ORM\Column(name="orden", type="integer")
     */
    private $orden;

    /**
     * @var integer $estado
     *
     * @ORM\Column(name="estado", type="integer")
     */
    private $estado;

    
    /**
     * @ORM\ManyToOne(targetEntity="Fecha", inversedBy="fecha")
     * @ORM\JoinColumn(name="fecha_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $fecha;
    
    
    /**
     * @ORM\OneToMany(targetEntity="Apuesta", mappedBy="partido", cascade={"all"})
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
     * Set local
     *
     * @param \stdClass $local
     * @return Partido
     */
    public function setLocal($local)
    {
        $this->local = $local;
    
        return $this;
    }

    /**
     * Get local
     *
     * @return \stdClass 
     */
    public function getLocal()
    {
        return $this->local;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     * @return Partido
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
     * Set estado
     *
     * @param integer $estado
     * @return Partido
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return integer 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set visitante
     *
     * @param \stdClass $visitante
     * @return Partido
     */
    public function setVisitante($visitante)
    {
        $this->visitante = $visitante;
    
        return $this;
    }

    /**
     * Get visitante
     *
     * @return \stdClass 
     */
    public function getVisitante()
    {
        return $this->visitante;
    }

    /**
     * Set fecha
     *
     * @param Jm\SaleBundle\Entity\Fecha $fecha
     * @return Partido
     */
    public function setFecha(\Jm\SaleBundle\Entity\Fecha $fecha = null)
    {
        $this->fecha = $fecha;
    
        return $this;
    }
    
    /**
     * Get Titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->local->getNombre()." vs ".$this->visitante->getNombre();
    }
    
    
    /**
     * Get fecha
     *
     * @return Jm\SaleBundle\Entity\Fecha 
     */
    public function getFecha()
    {
        return $this->fecha;
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
     * @return Partido
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
}