<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Fish;
use AppBundle\Form\FishType;

/**
 * Fish controller.
 *
 * @Route("/admin/fish")
 */
class FishController extends Controller
{

    /**
     * Lists all Fish entities.
     *
     * @Route("/", name="admin_fish")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Fish')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Fish entity.
     *
     * @Route("/", name="admin_fish_create")
     * @Method("POST")
     * @Template("AppBundle:Fish:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Fish();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_fish_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Fish entity.
     *
     * @param Fish $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Fish $entity)
    {
        $form = $this->createForm(new FishType(), $entity, array(
            'action' => $this->generateUrl('admin_fish_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Fish entity.
     *
     * @Route("/new", name="admin_fish_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Fish();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Fish entity.
     *
     * @Route("/{id}", name="admin_fish_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Fish')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fish entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Fish entity.
     *
     * @Route("/{id}/edit", name="admin_fish_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Fish')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fish entity.');
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
    * Creates a form to edit a Fish entity.
    *
    * @param Fish $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Fish $entity)
    {
        $form = $this->createForm(new FishType(), $entity, array(
            'action' => $this->generateUrl('admin_fish_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Fish entity.
     *
     * @Route("/{id}", name="admin_fish_update")
     * @Method("PUT")
     * @Template("AppBundle:Fish:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Fish')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fish entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_fish_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Fish entity.
     *
     * @Route("/{id}", name="admin_fish_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Fish')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Fish entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_fish'));
    }

    /**
     * Creates a form to delete a Fish entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_fish_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
