<?php

namespace Jm\SaleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Jm\SaleBundle\Entity\Equipo;
use Jm\SaleBundle\Form\EquipoType;

/**
 * Home controller.
 *
 * @Route("/home")
 */
class HomeController extends Controller
{
    /**
     * Lists all Equipo entities.
     *
     * @Route("/amigos/", name="home_amigos")
     * @Template()
     */
    public function amigosAction()
    {
        $em = $this->getDoctrine()->getManager();
        //$fecha = $em->getRepository('JmSaleBundle:Fecha')->find($fecha_id);
        //$partidos = $em->getRepository('JmSaleBundle:Partido')->findBy(array("fecha" => $fecha));
        
        return $this->render('JmSaleBundle:Home:amigos.html.twig', array());
    }
    
    
}
