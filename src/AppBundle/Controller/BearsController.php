<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Bears;
use AppBundle\Form\BearsType;

/**
 * Bears controller.
 *
 * @Route("/admin/bears")
 */
class BearsController extends Controller
{

    /**
     * Lists all Bears entities.
     *
     * @Route("/", name="admin_bears")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Bears')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Bears entity.
     *
     * @Route("/", name="admin_bears_create")
     * @Method("POST")
     * @Template("AppBundle:Bears:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Bears();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_bears_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Bears entity.
     *
     * @param Bears $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Bears $entity)
    {
        $form = $this->createForm(new BearsType(), $entity, array(
            'action' => $this->generateUrl('admin_bears_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Bears entity.
     *
     * @Route("/new", name="admin_bears_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Bears();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Bears entity.
     *
     * @Route("/{id}", name="admin_bears_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Bears')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bears entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Bears entity.
     *
     * @Route("/{id}/edit", name="admin_bears_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Bears')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bears entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Bears entity.
    *
    * @param Bears $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Bears $entity)
    {
        $form = $this->createForm(new BearsType(), $entity, array(
            'action' => $this->generateUrl('admin_bears_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Bears entity.
     *
     * @Route("/{id}", name="admin_bears_update")
     * @Method("PUT")
     * @Template("AppBundle:Bears:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Bears')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bears entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_bears_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Bears entity.
     *
     * @Route("/{id}", name="admin_bears_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Bears')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Bears entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_bears'));
    }

    /**
     * Creates a form to delete a Bears entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_bears_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
