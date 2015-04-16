<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Viruses;
use AppBundle\Form\VirusesType;

/**
 * Viruses controller.
 *
 * @Route("/admin/viruses")
 */
class VirusesController extends Controller
{

    /**
     * Lists all Viruses entities.
     *
     * @Route("/", name="admin_viruses")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Viruses')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Viruses entity.
     *
     * @Route("/", name="admin_viruses_create")
     * @Method("POST")
     * @Template("AppBundle:Viruses:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Viruses();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_viruses_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Viruses entity.
     *
     * @param Viruses $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Viruses $entity)
    {
        $form = $this->createForm(new VirusesType(), $entity, array(
            'action' => $this->generateUrl('admin_viruses_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Viruses entity.
     *
     * @Route("/new", name="admin_viruses_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Viruses();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Viruses entity.
     *
     * @Route("/{id}", name="admin_viruses_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Viruses')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Viruses entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Viruses entity.
     *
     * @Route("/{id}/edit", name="admin_viruses_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Viruses')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Viruses entity.');
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
    * Creates a form to edit a Viruses entity.
    *
    * @param Viruses $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Viruses $entity)
    {
        $form = $this->createForm(new VirusesType(), $entity, array(
            'action' => $this->generateUrl('admin_viruses_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Viruses entity.
     *
     * @Route("/{id}", name="admin_viruses_update")
     * @Method("PUT")
     * @Template("AppBundle:Viruses:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Viruses')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Viruses entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_viruses_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Viruses entity.
     *
     * @Route("/{id}", name="admin_viruses_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Viruses')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Viruses entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_viruses'));
    }

    /**
     * Creates a form to delete a Viruses entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_viruses_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
