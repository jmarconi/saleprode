<?php

namespace Jm\SaleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Jm\SaleBundle\Entity\Equipo;
use Jm\SaleBundle\Form\EquipoType;

/**
 * Equipo controller.
 *
 * @Route("/jugar")
 */
class JugarController extends Controller
{
    /**
     * Lists all Equipo entities.
     *
     * @Route("/apostar/{fecha_id}/", name="jugar_apuesta")
     * @Template()
     */
    public function apostarAction($fecha_id)
    {
        $em = $this->getDoctrine()->getManager();
        $fecha = $em->getRepository('JmSaleBundle:Fecha')->find($fecha_id);
        $partidos = $em->getRepository('JmSaleBundle:Partido')->findBy(array("fecha" => $fecha));
        
        return $this->render('JmSaleBundle:Jugar:apostar.html.twig', array("fecha" => $fecha,"partidos" => $partidos));
    }
    
    /**
     * Lists all fechas.
     *
     * @Route("/listadofechas/", name="jugar_listadofechas")
     * @Template()
     */
    public function listadoFechasAction()
    {
        $em = $this->getDoctrine()->getManager();
        $fechas = $em->getRepository('JmSaleBundle:Fecha')->findAll();
        
        return $this->render('JmSaleBundle:Jugar:listado-fechas.html.twig', array("fechas" => $fechas));
    }
    
    /**
     * Guardar una apuesta
     *
     * @Route("/ajax/saveapuesta/{fecha_id}/", name="jugar_guardarapuesta")
     * 
     */
    public function guardarApuestaAction($fecha_id)
    {
        $em = $this->getDoctrine()->getManager();
        $fecha = $em->getRepository('JmSaleBundle:Fecha')->find($fecha_id);
        $partidos = $em->getRepository('JmSaleBundle:Partido')->findAll();
        
        return $this->render('JmSaleBundle:Jugar:apostar.html.twig', array("fecha" => $fecha,"partidos" => $partidos));
    }
}
