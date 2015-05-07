<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Hamster;
use AppBundle\Form\HamsterType;

/**
 * Hamster controller.
 *
 * @Route("/admin/hamster")
 */
class HamsterController extends Controller
{

    /**
     * Lists all Hamster entities.
     *
     * @Route("/", name="admin_hamster")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Hamster')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Hamster entity.
     *
     * @Route("/", name="admin_hamster_create")
     * @Method("POST")
     * @Template("AppBundle:Hamster:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Hamster();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_hamster_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Hamster entity.
     *
     * @param Hamster $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Hamster $entity)
    {
        $form = $this->createForm(new HamsterType(), $entity, array(
            'action' => $this->generateUrl('admin_hamster_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Hamster entity.
     *
     * @Route("/new", name="admin_hamster_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Hamster();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Hamster entity.
     *
     * @Route("/{id}", name="admin_hamster_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Hamster')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Hamster entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Hamster entity.
     *
     * @Route("/{id}/edit", name="admin_hamster_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Hamster')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Hamster entity.');
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
    * Creates a form to edit a Hamster entity.
    *
    * @param Hamster $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Hamster $entity)
    {
        $form = $this->createForm(new HamsterType(), $entity, array(
            'action' => $this->generateUrl('admin_hamster_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Hamster entity.
     *
     * @Route("/{id}", name="admin_hamster_update")
     * @Method("PUT")
     * @Template("AppBundle:Hamster:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Hamster')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Hamster entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_hamster_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Hamster entity.
     *
     * @Route("/{id}", name="admin_hamster_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Hamster')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Hamster entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_hamster'));
    }

    /**
     * Creates a form to delete a Hamster entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_hamster_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
