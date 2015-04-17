<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Bird;
use AppBundle\Form\BirdType;

/**
 * Bird controller.
 *
 * @Route("/admin/birds")
 */
class BirdController extends Controller
{

    /**
     * Lists all Bird entities.
     *
     * @Route("/", name="admin_birds")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Bird')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Bird entity.
     *
     * @Route("/", name="admin_birds_create")
     * @Method("POST")
     * @Template("AppBundle:Bird:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Bird();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_birds_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Bird entity.
     *
     * @param Bird $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Bird $entity)
    {
        $form = $this->createForm(new BirdType(), $entity, array(
            'action' => $this->generateUrl('admin_birds_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Bird entity.
     *
     * @Route("/new", name="admin_birds_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Bird();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Bird entity.
     *
     * @Route("/{id}", name="admin_birds_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Bird')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bird entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Bird entity.
     *
     * @Route("/{id}/edit", name="admin_birds_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Bird')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bird entity.');
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
    * Creates a form to edit a Bird entity.
    *
    * @param Bird $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Bird $entity)
    {
        $form = $this->createForm(new BirdType(), $entity, array(
            'action' => $this->generateUrl('admin_birds_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Bird entity.
     *
     * @Route("/{id}", name="admin_birds_update")
     * @Method("PUT")
     * @Template("AppBundle:Bird:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Bird')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bird entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_birds_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Bird entity.
     *
     * @Route("/{id}", name="admin_birds_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Bird')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Bird entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_birds'));
    }

    /**
     * Creates a form to delete a Bird entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_birds_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
