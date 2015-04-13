<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Cats;
use AppBundle\Form\CatsType;

/**
 * Cats controller.
 *
 * @Route("/admin/cats")
 */
class CatsController extends Controller
{

    /**
     * Lists all Cats entities.
     *
     * @Route("/", name="admin_cats")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Cats')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Cats entity.
     *
     * @Route("/", name="admin_cats_create")
     * @Method("POST")
     * @Template("AppBundle:Cats:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Cats();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_cats_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Cats entity.
     *
     * @param Cats $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Cats $entity)
    {
        $form = $this->createForm(new CatsType(), $entity, array(
            'action' => $this->generateUrl('admin_cats_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Cats entity.
     *
     * @Route("/new", name="admin_cats_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Cats();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Cats entity.
     *
     * @Route("/{id}", name="admin_cats_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Cats')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cats entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Cats entity.
     *
     * @Route("/{id}/edit", name="admin_cats_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Cats')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cats entity.');
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
    * Creates a form to edit a Cats entity.
    *
    * @param Cats $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Cats $entity)
    {
        $form = $this->createForm(new CatsType(), $entity, array(
            'action' => $this->generateUrl('admin_cats_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Cats entity.
     *
     * @Route("/{id}", name="admin_cats_update")
     * @Method("PUT")
     * @Template("AppBundle:Cats:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Cats')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cats entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_cats_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Cats entity.
     *
     * @Route("/{id}", name="admin_cats_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Cats')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cats entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_cats'));
    }

    /**
     * Creates a form to delete a Cats entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_cats_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
