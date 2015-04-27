<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Flower;
use AppBundle\Form\FlowerType;

/**
 * Flower controller.
 *
 * @Route("/admin/flower")
 */
class FlowerController extends Controller
{

    /**
     * Lists all Flower entities.
     *
     * @Route("/", name="admin_flower")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Flower')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Flower entity.
     *
     * @Route("/", name="admin_flower_create")
     * @Method("POST")
     * @Template("AppBundle:Flower:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Flower();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_flower_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Flower entity.
     *
     * @param Flower $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Flower $entity)
    {
        $form = $this->createForm(new FlowerType(), $entity, array(
            'action' => $this->generateUrl('admin_flower_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Flower entity.
     *
     * @Route("/new", name="admin_flower_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Flower();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Flower entity.
     *
     * @Route("/{id}", name="admin_flower_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Flower')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Flower entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Flower entity.
     *
     * @Route("/{id}/edit", name="admin_flower_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Flower')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Flower entity.');
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
    * Creates a form to edit a Flower entity.
    *
    * @param Flower $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Flower $entity)
    {
        $form = $this->createForm(new FlowerType(), $entity, array(
            'action' => $this->generateUrl('admin_flower_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Flower entity.
     *
     * @Route("/{id}", name="admin_flower_update")
     * @Method("PUT")
     * @Template("AppBundle:Flower:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Flower')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Flower entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_flower_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Flower entity.
     *
     * @Route("/{id}", name="admin_flower_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Flower')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Flower entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_flower'));
    }

    /**
     * Creates a form to delete a Flower entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_flower_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
