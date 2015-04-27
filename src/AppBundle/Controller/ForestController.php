<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Forest;
use AppBundle\Form\ForestType;

/**
 * Forest controller.
 *
 * @Route("/admin/forest")
 */
class ForestController extends Controller
{

    /**
     * Lists all Forest entities.
     *
     * @Route("/", name="admin_forest")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Forest')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Forest entity.
     *
     * @Route("/", name="admin_forest_create")
     * @Method("POST")
     * @Template("AppBundle:Forest:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Forest();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_forest_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Forest entity.
     *
     * @param Forest $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Forest $entity)
    {
        $form = $this->createForm(new ForestType(), $entity, array(
            'action' => $this->generateUrl('admin_forest_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Forest entity.
     *
     * @Route("/new", name="admin_forest_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Forest();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Forest entity.
     *
     * @Route("/{id}", name="admin_forest_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Forest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Forest entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Forest entity.
     *
     * @Route("/{id}/edit", name="admin_forest_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Forest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Forest entity.');
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
    * Creates a form to edit a Forest entity.
    *
    * @param Forest $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Forest $entity)
    {
        $form = $this->createForm(new ForestType(), $entity, array(
            'action' => $this->generateUrl('admin_forest_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Forest entity.
     *
     * @Route("/{id}", name="admin_forest_update")
     * @Method("PUT")
     * @Template("AppBundle:Forest:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Forest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Forest entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_forest_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Forest entity.
     *
     * @Route("/{id}", name="admin_forest_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Forest')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Forest entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_forest'));
    }

    /**
     * Creates a form to delete a Forest entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_forest_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}