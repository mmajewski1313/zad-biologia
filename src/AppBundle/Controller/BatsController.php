<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Bats;
use AppBundle\Form\BatsType;

/**
 * Bats controller.
 *
 * @Route("/admin/bats")
 */
class BatsController extends Controller
{

    /**
     * Lists all Bats entities.
     *
     * @Route("/", name="admin_bats")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Bats')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Bats entity.
     *
     * @Route("/", name="admin_bats_create")
     * @Method("POST")
     * @Template("AppBundle:Bats:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Bats();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_bats_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Bats entity.
     *
     * @param Bats $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Bats $entity)
    {
        $form = $this->createForm(new BatsType(), $entity, array(
            'action' => $this->generateUrl('admin_bats_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Bats entity.
     *
     * @Route("/new", name="admin_bats_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Bats();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Bats entity.
     *
     * @Route("/{id}", name="admin_bats_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Bats')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bats entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Bats entity.
     *
     * @Route("/{id}/edit", name="admin_bats_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Bats')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bats entity.');
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
    * Creates a form to edit a Bats entity.
    *
    * @param Bats $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Bats $entity)
    {
        $form = $this->createForm(new BatsType(), $entity, array(
            'action' => $this->generateUrl('admin_bats_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Bats entity.
     *
     * @Route("/{id}", name="admin_bats_update")
     * @Method("PUT")
     * @Template("AppBundle:Bats:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Bats')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bats entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_bats_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Bats entity.
     *
     * @Route("/{id}", name="admin_bats_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Bats')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Bats entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_bats'));
    }

    /**
     * Creates a form to delete a Bats entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_bats_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
