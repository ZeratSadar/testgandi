<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pages\CoreBundle\Entity\Media;
use Admin\AdminBundle\Form\MediaType;

/**
 * Media controller.
 *
 */
class MediaController extends Controller
{
    /**
     * Lists all Media entities.
     *
     */
    public function indexAction(Request $request)
    {
        $medium = new Media();
        $form = $this->createForm(new MediaType(), $medium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($medium);
            $em->flush();

            return $this->redirectToRoute('admin_media_index');
        }

        $em = $this->getDoctrine()->getManager();

        $media = $em->getRepository('CoreBundle:Media')->findAll();

        return $this->render('AdminBundle:Media:index.html.twig', array(
            'media' => $media,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Media entity.
     *
     */
    public function editAction(Request $request, Media $medium)
    {
        $deleteForm = $this->createDeleteForm($medium);
        $editForm = $this->createForm(new MediaType(), $medium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($medium);
            $em->flush();

            return $this->redirectToRoute('admin_media_index');
        }

        return $this->render('AdminBundle:Media:edit.html.twig', array(
            'medium' => $medium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Media entity.
     *
     */
    public function deleteAction(Request $request, Media $medium)
    {
        $form = $this->createDeleteForm($medium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($medium);
            $em->flush();
        }

        return $this->redirectToRoute('admin_media_index');
    }

    public function delete_formAction(Request $request, Media $medium)
    {
        $deleteForm = $this->createDeleteForm($medium);
        return $this->render('AdminBundle:Media:delete_form.html.twig',
            array(
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Creates a form to delete a Media entity.
     *
     * @param Media $medium The Media entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Media $medium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_media_delete', array('id' => $medium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
