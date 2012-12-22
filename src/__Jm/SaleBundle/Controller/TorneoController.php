<?php

namespace Jm\SaleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Jm\SaleBundle\Entity\Torneo;
use Jm\SaleBundle\Form\TorneoType;

/**
 * Torneo controller.
 *
 * @Route("/admin/torneo")
 */
class TorneoController extends Controller
{
    /**
     * Lists all Torneo entities.
     *
     * @Route("/", name="admin_torneo")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('JmSaleBundle:Torneo')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Torneo entity.
     *
     * @Route("/{id}/show", name="admin_torneo_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JmSaleBundle:Torneo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Torneo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Torneo entity.
     *
     * @Route("/new", name="admin_torneo_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Torneo();
        $form   = $this->createForm(new TorneoType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Torneo entity.
     *
     * @Route("/create", name="admin_torneo_create")
     * @Method("POST")
     * @Template("JmSaleBundle:Torneo:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Torneo();
        $form = $this->createForm(new TorneoType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_torneo_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Torneo entity.
     *
     * @Route("/{id}/edit", name="admin_torneo_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JmSaleBundle:Torneo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Torneo entity.');
        }

        $editForm = $this->createForm(new TorneoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Torneo entity.
     *
     * @Route("/{id}/update", name="admin_torneo_update")
     * @Method("POST")
     * @Template("JmSaleBundle:Torneo:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JmSaleBundle:Torneo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Torneo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TorneoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_torneo_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Torneo entity.
     *
     * @Route("/{id}/delete", name="admin_torneo_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('JmSaleBundle:Torneo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Torneo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_torneo'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
