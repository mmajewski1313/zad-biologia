<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Reptile;
use AppBundle\Form\ReptileType;

/**
 * Reptile controller.
 *
 * @Route("/admin/reptile")
 */
class ReptileController extends Controller
{

    /**
     * Lists all Reptile entities.
     *
     * @Route("/", name="admin_reptile")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Reptile')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Reptile entity.
     *
     * @Route("/", name="admin_reptile_create")
     * @Method("POST")
     * @Template("AppBundle:Reptile:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Reptile();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_reptile_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Reptile entity.
     *
     * @param Reptile $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Reptile $entity)
    {
        $form = $this->createForm(new ReptileType(), $entity, array(
            'action' => $this->generateUrl('admin_reptile_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Reptile entity.
     *
     * @Route("/new", name="admin_reptile_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Reptile();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Reptile entity.
     *
     * @Route("/{id}", name="admin_reptile_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Reptile')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reptile entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Reptile entity.
     *
     * @Route("/{id}/edit", name="admin_reptile_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Reptile')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reptile entity.');
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
    * Creates a form to edit a Reptile entity.
    *
    * @param Reptile $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Reptile $entity)
    {
        $form = $this->createForm(new ReptileType(), $entity, array(
            'action' => $this->generateUrl('admin_reptile_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Reptile entity.
     *
     * @Route("/{id}", name="admin_reptile_update")
     * @Method("PUT")
     * @Template("AppBundle:Reptile:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Reptile')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reptile entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_reptile_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Reptile entity.
     *
     * @Route("/{id}", name="admin_reptile_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Reptile')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Reptile entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_reptile'));
    }

    /**
     * Creates a form to delete a Reptile entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_reptile_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
