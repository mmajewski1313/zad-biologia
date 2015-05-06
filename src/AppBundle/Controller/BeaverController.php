<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Beaver;
use AppBundle\Form\BeaverType;

/**
 * Beaver controller.
 *
 * @Route("/admin/beaver")
 */
class BeaverController extends Controller
{

    /**
     * Lists all Beaver entities.
     *
     * @Route("/", name="admin_beaver")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Beaver')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Beaver entity.
     *
     * @Route("/", name="admin_beaver_create")
     * @Method("POST")
     * @Template("AppBundle:Beaver:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Beaver();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_beaver_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Beaver entity.
     *
     * @param Beaver $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Beaver $entity)
    {
        $form = $this->createForm(new BeaverType(), $entity, array(
            'action' => $this->generateUrl('admin_beaver_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Beaver entity.
     *
     * @Route("/new", name="admin_beaver_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Beaver();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Beaver entity.
     *
     * @Route("/{id}", name="admin_beaver_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Beaver')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Beaver entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Beaver entity.
     *
     * @Route("/{id}/edit", name="admin_beaver_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Beaver')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Beaver entity.');
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
    * Creates a form to edit a Beaver entity.
    *
    * @param Beaver $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Beaver $entity)
    {
        $form = $this->createForm(new BeaverType(), $entity, array(
            'action' => $this->generateUrl('admin_beaver_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Beaver entity.
     *
     * @Route("/{id}", name="admin_beaver_update")
     * @Method("PUT")
     * @Template("AppBundle:Beaver:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Beaver')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Beaver entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_beaver_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Beaver entity.
     *
     * @Route("/{id}", name="admin_beaver_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Beaver')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Beaver entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_beaver'));
    }

    /**
     * Creates a form to delete a Beaver entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_beaver_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
