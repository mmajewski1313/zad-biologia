<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Malacostraca;
use AppBundle\Form\MalacostracaType;

/**
 * Malacostraca controller.
 *
 * @Route("/admin/malacostraca")
 */
class MalacostracaController extends Controller
{

    /**
     * Lists all Malacostraca entities.
     *
     * @Route("/", name="admin_malacostraca")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Malacostraca')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Malacostraca entity.
     *
     * @Route("/", name="admin_malacostraca_create")
     * @Method("POST")
     * @Template("AppBundle:Malacostraca:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Malacostraca();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_malacostraca_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Malacostraca entity.
     *
     * @param Malacostraca $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Malacostraca $entity)
    {
        $form = $this->createForm(new MalacostracaType(), $entity, array(
            'action' => $this->generateUrl('admin_malacostraca_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Malacostraca entity.
     *
     * @Route("/new", name="admin_malacostraca_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Malacostraca();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Malacostraca entity.
     *
     * @Route("/{id}", name="admin_malacostraca_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Malacostraca')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Malacostraca entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Malacostraca entity.
     *
     * @Route("/{id}/edit", name="admin_malacostraca_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Malacostraca')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Malacostraca entity.');
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
    * Creates a form to edit a Malacostraca entity.
    *
    * @param Malacostraca $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Malacostraca $entity)
    {
        $form = $this->createForm(new MalacostracaType(), $entity, array(
            'action' => $this->generateUrl('admin_malacostraca_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Malacostraca entity.
     *
     * @Route("/{id}", name="admin_malacostraca_update")
     * @Method("PUT")
     * @Template("AppBundle:Malacostraca:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Malacostraca')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Malacostraca entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_malacostraca_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Malacostraca entity.
     *
     * @Route("/{id}", name="admin_malacostraca_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Malacostraca')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Malacostraca entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_malacostraca'));
    }

    /**
     * Creates a form to delete a Malacostraca entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_malacostraca_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
