<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Fungus;
use AppBundle\Form\FungusType;

/**
 * Fungus controller.
 *
 * @Route("/admin/fungus")
 */
class FungusController extends Controller
{

    /**
     * Lists all Fungus entities.
     *
     * @Route("/", name="admin_fungus")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Fungus')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Fungus entity.
     *
     * @Route("/", name="admin_fungus_create")
     * @Method("POST")
     * @Template("AppBundle:Fungus:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Fungus();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_fungus_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Fungus entity.
     *
     * @param Fungus $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Fungus $entity)
    {
        $form = $this->createForm(new FungusType(), $entity, array(
            'action' => $this->generateUrl('admin_fungus_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Fungus entity.
     *
     * @Route("/new", name="admin_fungus_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Fungus();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Fungus entity.
     *
     * @Route("/{id}", name="admin_fungus_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Fungus')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fungus entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Fungus entity.
     *
     * @Route("/{id}/edit", name="admin_fungus_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Fungus')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fungus entity.');
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
    * Creates a form to edit a Fungus entity.
    *
    * @param Fungus $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Fungus $entity)
    {
        $form = $this->createForm(new FungusType(), $entity, array(
            'action' => $this->generateUrl('admin_fungus_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Fungus entity.
     *
     * @Route("/{id}", name="admin_fungus_update")
     * @Method("PUT")
     * @Template("AppBundle:Fungus:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Fungus')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fungus entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_fungus_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Fungus entity.
     *
     * @Route("/{id}", name="admin_fungus_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Fungus')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Fungus entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_fungus'));
    }

    /**
     * Creates a form to delete a Fungus entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_fungus_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
