<?php

namespace Jm\SaleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jm\SaleBundle\Entity\Equipo
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Jm\SaleBundle\Entity\EquipoRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Equipo
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
     * @var string $nombre
     *
     * @ORM\Column(name="nombre_corto", type="string", length=255)
     */
    private $nombre_corto;
    
    /**
     * @var string $nombre
     *
     * @ORM\Column(name="iniciales", type="string", length=255)
     */
    private $iniciales;

    
    
    /**
     * @var string $logo
     *
     * @ORM\Column(name="logo", type="string", length=255)
     */
    private $logo;
    
    /**
     * @ORM\OneToMany(targetEntity="Partido", mappedBy="local", cascade={"all"})
     */
    protected $local;
    
    /**
     * @ORM\OneToMany(targetEntity="Partido", mappedBy="visitante", cascade={"all"})
     */
    protected $visitante;
    
    
    public $file;
    
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
     * @return Equipo
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
     * Set logo
     *
     * @param string $logo
     * @return Equipo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    
        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->local = new \Doctrine\Common\Collections\ArrayCollection();
        $this->visitante = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add local
     *
     * @param Jm\SaleBundle\Entity\Partido $local
     * @return Equipo
     */
    public function addLocal(\Jm\SaleBundle\Entity\Partido $local)
    {
        $this->local[] = $local;
    
        return $this;
    }

    /**
     * Remove local
     *
     * @param Jm\SaleBundle\Entity\Partido $local
     */
    public function removeLocal(\Jm\SaleBundle\Entity\Partido $local)
    {
        $this->local->removeElement($local);
    }

    /**
     * Get local
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLocal()
    {
        return $this->local;
    }

    /**
     * Add visitante
     *
     * @param Jm\SaleBundle\Entity\Partido $visitante
     * @return Equipo
     */
    public function addVisitante(\Jm\SaleBundle\Entity\Partido $visitante)
    {
        $this->visitante[] = $visitante;
    
        return $this;
    }

    /**
     * Remove visitante
     *
     * @param Jm\SaleBundle\Entity\Partido $visitante
     */
    public function removeVisitante(\Jm\SaleBundle\Entity\Partido $visitante)
    {
        $this->visitante->removeElement($visitante);
    }

    /**
     * Get visitante
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getVisitante()
    {
        return $this->visitante;
    }

    /**
     * Set nombre_corto
     *
     * @param string $nombreCorto
     * @return Equipo
     */
    public function setNombreCorto($nombreCorto)
    {
        $this->nombre_corto = $nombreCorto;
    
        return $this;
    }

    /**
     * Get nombre_corto
     *
     * @return string 
     */
    public function getNombreCorto()
    {
        return $this->nombre_corto;
    }

    /**
     * Set iniciales
     *
     * @param string $iniciales
     * @return Equipo
     */
    public function setIniciales($iniciales)
    {
        $this->iniciales = $iniciales;
    
        return $this;
    }

    /**
     * Get iniciales
     *
     * @return string 
     */
    public function getIniciales()
    {
        return $this->iniciales;
    }
    
    protected function getUploadDir()
    {
        return 'uploads/equipos';
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    public function getWebPath()
    {
        return null === $this->logo ? null : "/saleprode/web/".$this->getUploadDir().'/'.$this->logo;
    }

    public function getAbsolutePath()
    {
        return null === $this->logo ? null : $this->getUploadRootDir().'/'.$this->logo;
    }
    
    /**
    * @ORM\prePersist
    */
    public function prePersist(){
      $this->preUpload();
    }
    
    /**
    * @ORM\postPersist
    */
    public function postPersist(){
      $this->upload();
    }
    
    /**
    * @ORM\preUpdate
    */
    public function preUpdate(){
       if (null === $this->file) {
        return;
      }
      $this->removeUpload();
      $this->upload();
    }
    
    /**
    * @ORM\postRemove
    */
    public function postRemove(){
      if (null === $this->file) {
        return;
      }
      $this->removeUpload();
    }
    
    
    
    
    
    
    
    
    public function preUpload()
    {
      if (null !== $this->file) {
        // do whatever you want to generate a unique name
        $this->logo = uniqid().'.'.$this->file->guessExtension();
      }
    }

    
    public function upload()
    {
      if (null === $this->file) {
        return;
      }
      
      // if there is an error when moving the file, an exception will
      // be automatically thrown by move(). This will properly prevent
      // the entity from being persisted to the database on error
      $this->file->move($this->getUploadRootDir(), $this->logo);

      unset($this->file);
    }
    
    

    
    public function removeUpload()
    {
      if ($file = $this->getAbsolutePath()) {
        @unlink($file);
      }
    }
}