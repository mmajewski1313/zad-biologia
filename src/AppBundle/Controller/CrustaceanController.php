<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Crustacean;
use AppBundle\Form\CrustaceanType;

/**
 * Crustacean controller.
 *
 * @Route("/admin/crustacean")
 */
class CrustaceanController extends Controller
{

    /**
     * Lists all Crustacean entities.
     *
     * @Route("/", name="admin_crustacean")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Crustacean')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Crustacean entity.
     *
     * @Route("/", name="admin_crustacean_create")
     * @Method("POST")
     * @Template("AppBundle:Crustacean:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Crustacean();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_crustacean_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Crustacean entity.
     *
     * @param Crustacean $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Crustacean $entity)
    {
        $form = $this->createForm(new CrustaceanType(), $entity, array(
            'action' => $this->generateUrl('admin_crustacean_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Crustacean entity.
     *
     * @Route("/new", name="admin_crustacean_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Crustacean();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Crustacean entity.
     *
     * @Route("/{id}", name="admin_crustacean_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Crustacean')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Crustacean entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Crustacean entity.
     *
     * @Route("/{id}/edit", name="admin_crustacean_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Crustacean')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Crustacean entity.');
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
    * Creates a form to edit a Crustacean entity.
    *
    * @param Crustacean $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Crustacean $entity)
    {
        $form = $this->createForm(new CrustaceanType(), $entity, array(
            'action' => $this->generateUrl('admin_crustacean_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Crustacean entity.
     *
     * @Route("/{id}", name="admin_crustacean_update")
     * @Method("PUT")
     * @Template("AppBundle:Crustacean:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Crustacean')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Crustacean entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_crustacean_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Crustacean entity.
     *
     * @Route("/{id}", name="admin_crustacean_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Crustacean')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Crustacean entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_crustacean'));
    }

    /**
     * Creates a form to delete a Crustacean entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_crustacean_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
