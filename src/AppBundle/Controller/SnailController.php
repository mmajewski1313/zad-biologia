<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Snail;
use AppBundle\Form\SnailType;

/**
 * Snail controller.
 *
 * @Route("/admin/Snail")
 */
class SnailController extends Controller
{

    /**
     * Lists all Snail entities.
     *
     * @Route("/", name="admin_Snail")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Snail')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Snail entity.
     *
     * @Route("/", name="admin_Snail_create")
     * @Method("POST")
     * @Template("AppBundle:Snail:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Snail();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_Snail_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Snail entity.
     *
     * @param Snail $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Snail $entity)
    {
        $form = $this->createForm(new SnailType(), $entity, array(
            'action' => $this->generateUrl('admin_Snail_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Snail entity.
     *
     * @Route("/new", name="admin_Snail_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Snail();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Snail entity.
     *
     * @Route("/{id}", name="admin_Snail_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Snail')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Snail entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Snail entity.
     *
     * @Route("/{id}/edit", name="admin_Snail_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Snail')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Snail entity.');
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
    * Creates a form to edit a Snail entity.
    *
    * @param Snail $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Snail $entity)
    {
        $form = $this->createForm(new SnailType(), $entity, array(
            'action' => $this->generateUrl('admin_Snail_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Snail entity.
     *
     * @Route("/{id}", name="admin_Snail_update")
     * @Method("PUT")
     * @Template("AppBundle:Snail:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Snail')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Snail entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_Snail_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Snail entity.
     *
     * @Route("/{id}", name="admin_Snail_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Snail')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Snail entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_Snail'));
    }

    /**
     * Creates a form to delete a Snail entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_Snail_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
