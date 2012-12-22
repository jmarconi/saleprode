<?php

namespace Jm\SaleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Jm\SaleBundle\Entity\Partido;
use Jm\SaleBundle\Form\PartidoType;

/**
 * Partido controller.
 *
 * @Route("/admin/partido")
 */
class PartidoController extends Controller
{
    /**
     * Lists all Partido entities.
     *
     * @Route("/", name="admin_partido")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('JmSaleBundle:Partido')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Partido entity.
     *
     * @Route("/{id}/show", name="admin_partido_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JmSaleBundle:Partido')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Partido entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Partido entity.
     *
     * @Route("/new", name="admin_partido_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Partido();
        $form   = $this->createForm(new PartidoType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Partido entity.
     *
     * @Route("/create", name="admin_partido_create")
     * @Method("POST")
     * @Template("JmSaleBundle:Partido:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Partido();
        $form = $this->createForm(new PartidoType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_partido_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Partido entity.
     *
     * @Route("/{id}/edit", name="admin_partido_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JmSaleBundle:Partido')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Partido entity.');
        }

        $editForm = $this->createForm(new PartidoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Partido entity.
     *
     * @Route("/{id}/update", name="admin_partido_update")
     * @Method("POST")
     * @Template("JmSaleBundle:Partido:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JmSaleBundle:Partido')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Partido entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PartidoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_partido_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Partido entity.
     *
     * @Route("/{id}/delete", name="admin_partido_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('JmSaleBundle:Partido')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Partido entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_partido'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
