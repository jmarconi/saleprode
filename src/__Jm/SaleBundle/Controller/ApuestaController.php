<?php

namespace Jm\SaleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Jm\SaleBundle\Entity\Apuesta;
use Jm\SaleBundle\Form\ApuestaType;

/**
 * Apuesta controller.
 *
 * @Route("/admin/apuesta")
 */
class ApuestaController extends Controller
{
    /**
     * Lists all Apuesta entities.
     *
     * @Route("/", name="admin_apuesta")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('JmSaleBundle:Apuesta')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Apuesta entity.
     *
     * @Route("/{id}/show", name="admin_apuesta_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JmSaleBundle:Apuesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Apuesta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Apuesta entity.
     *
     * @Route("/new", name="admin_apuesta_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Apuesta();
        $form   = $this->createForm(new ApuestaType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Apuesta entity.
     *
     * @Route("/create", name="admin_apuesta_create")
     * @Method("POST")
     * @Template("JmSaleBundle:Apuesta:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Apuesta();
        $form = $this->createForm(new ApuestaType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_apuesta_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Apuesta entity.
     *
     * @Route("/{id}/edit", name="admin_apuesta_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JmSaleBundle:Apuesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Apuesta entity.');
        }

        $editForm = $this->createForm(new ApuestaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Apuesta entity.
     *
     * @Route("/{id}/update", name="admin_apuesta_update")
     * @Method("POST")
     * @Template("JmSaleBundle:Apuesta:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JmSaleBundle:Apuesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Apuesta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ApuestaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_apuesta_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Apuesta entity.
     *
     * @Route("/{id}/delete", name="admin_apuesta_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('JmSaleBundle:Apuesta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Apuesta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_apuesta'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
