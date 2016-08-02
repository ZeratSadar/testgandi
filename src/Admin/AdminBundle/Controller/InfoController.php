<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pages\CoreBundle\Entity\Info;
use Admin\AdminBundle\Form\InfoType;

/**
 * Info controller.
 *
 */
class InfoController extends Controller
{
    // /**
    //  * Lists all Info entities.
    //  *
    //  */
    // public function indexAction()
    // {
    //     $em = $this->getDoctrine()->getManager();

    //     $infos = $em->getRepository('CoreBundle:Info')->findAll();

    //     return $this->render('info/index.html.twig', array(
    //         'infos' => $infos,
    //     ));
    // }

    // /**
    //  * Creates a new Info entity.
    //  *
    //  */
    // public function newAction(Request $request)
    // {
    //     $info = new Info();
    //     $form = $this->createForm('Pages\CoreBundle\Form\InfoType', $info);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $em = $this->getDoctrine()->getManager();
    //         $em->persist($info);
    //         $em->flush();

    //         return $this->redirectToRoute('info_show', array('id' => $info->getId()));
    //     }

    //     return $this->render('info/new.html.twig', array(
    //         'info' => $info,
    //         'form' => $form->createView(),
    //     ));
    // }

    // /**
    //  * Finds and displays a Info entity.
    //  *
    //  */
    // public function showAction(Info $info)
    // {
    //     $deleteForm = $this->createDeleteForm($info);

    //     return $this->render('info/show.html.twig', array(
    //         'info' => $info,
    //         'delete_form' => $deleteForm->createView(),
    //     ));
    // }

    /**
     * Displays a form to edit an existing Info entity.
     *
     */
    public function editAction(Request $request, Info $info)
    {
        // $deleteForm = $this->createDeleteForm($info);
        $editForm = $this->createForm(new InfoType(), $info);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($info);
            $em->flush();

            return $this->redirectToRoute('admin_info_edit', array('id' => $info->getId()));
        }

        return $this->render('AdminBundle:Info:edit.html.twig', array(
            'info' => $info,
            'edit_form' => $editForm->createView(),
            // 'delete_form' => $deleteForm->createView(),
        ));
    }

    // /**
    //  * Deletes a Info entity.
    //  *
    //  */
    // public function deleteAction(Request $request, Info $info)
    // {
    //     $form = $this->createDeleteForm($info);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $em = $this->getDoctrine()->getManager();
    //         $em->remove($info);
    //         $em->flush();
    //     }

    //     return $this->redirectToRoute('info_index');
    // }

    // /**
    //  * Creates a form to delete a Info entity.
    //  *
    //  * @param Info $info The Info entity
    //  *
    //  * @return \Symfony\Component\Form\Form The form
    //  */
    // private function createDeleteForm(Info $info)
    // {
    //     return $this->createFormBuilder()
    //         ->setAction($this->generateUrl('info_delete', array('id' => $info->getId())))
    //         ->setMethod('DELETE')
    //         ->getForm()
    //     ;
    // }
}
