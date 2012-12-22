<?php

namespace Jm\SaleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Jm\SaleBundle\Entity\Fecha;
use Jm\SaleBundle\Form\FechaType;

/**
 * Fecha controller.
 *
 * @Route("/admin/fecha")
 */
class FechaController extends Controller
{
    /**
     * Lists all Fecha entities.
     *
     * @Route("/", name="admin_fecha")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('JmSaleBundle:Fecha')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Fecha entity.
     *
     * @Route("/{id}/show", name="admin_fecha_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JmSaleBundle:Fecha')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fecha entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Fecha entity.
     *
     * @Route("/new", name="admin_fecha_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Fecha();
        $form   = $this->createForm(new FechaType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Fecha entity.
     *
     * @Route("/create", name="admin_fecha_create")
     * @Method("POST")
     * @Template("JmSaleBundle:Fecha:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Fecha();
        $form = $this->createForm(new FechaType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_fecha_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Fecha entity.
     *
     * @Route("/{id}/edit", name="admin_fecha_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JmSaleBundle:Fecha')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fecha entity.');
        }

        $editForm = $this->createForm(new FechaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Fecha entity.
     *
     * @Route("/{id}/update", name="admin_fecha_update")
     * @Method("POST")
     * @Template("JmSaleBundle:Fecha:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JmSaleBundle:Fecha')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fecha entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new FechaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_fecha_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Fecha entity.
     *
     * @Route("/{id}/delete", name="admin_fecha_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('JmSaleBundle:Fecha')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Fecha entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_fecha'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
