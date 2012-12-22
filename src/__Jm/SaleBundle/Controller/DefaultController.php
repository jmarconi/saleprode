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
 * @Route("/home")
 */
class DefaultController extends Controller
{
    /**
     * Lists all Equipo entities.
     *
     * @Route("/nombre/{nombre}/", name="home_equipos")
     * @Template()
     */
    public function indexAction($nombre)
    {
        return $this->render('JmSaleBundle:Default:index.html.twig', array('name' => $nombre));
    }
}
