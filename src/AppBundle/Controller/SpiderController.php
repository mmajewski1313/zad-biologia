<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Spider;
use AppBundle\Form\SpiderType;

/**
 * Spider controller.
 *
 * @Route("/admin/spider")
 */
class SpiderController extends Controller
{

    /**
     * Lists all Spider entities.
     *
     * @Route("/", name="admin_spider")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Spider')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Spider entity.
     *
     * @Route("/", name="admin_spider_create")
     * @Method("POST")
     * @Template("AppBundle:Spider:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Spider();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_spider_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Spider entity.
     *
     * @param Spider $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Spider $entity)
    {
        $form = $this->createForm(new SpiderType(), $entity, array(
            'action' => $this->generateUrl('admin_spider_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Spider entity.
     *
     * @Route("/new", name="admin_spider_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Spider();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Spider entity.
     *
     * @Route("/{id}", name="admin_spider_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Spider')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Spider entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Spider entity.
     *
     * @Route("/{id}/edit", name="admin_spider_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Spider')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Spider entity.');
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
    * Creates a form to edit a Spider entity.
    *
    * @param Spider $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Spider $entity)
    {
        $form = $this->createForm(new SpiderType(), $entity, array(
            'action' => $this->generateUrl('admin_spider_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Spider entity.
     *
     * @Route("/{id}", name="admin_spider_update")
     * @Method("PUT")
     * @Template("AppBundle:Spider:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Spider')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Spider entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_spider_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Spider entity.
     *
     * @Route("/{id}", name="admin_spider_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Spider')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Spider entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_spider'));
    }

    /**
     * Creates a form to delete a Spider entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_spider_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
