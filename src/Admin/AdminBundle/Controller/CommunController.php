<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pages\CoreBundle\Entity\Commun;
use Admin\AdminBundle\Form\CommunType;

/**
 * Commun controller.
 *
 */
class CommunController extends Controller
{

    /**
     * Displays a form to edit an existing Commun entity.
     *
     */
    public function editAction(Request $request, Commun $commun)
    {
        $deleteForm = $this->createDeleteForm($commun);
        $editForm = $this->createForm(new CommunType(), $commun);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commun);
            $em->flush();

            return $this->redirectToRoute('admin_communaute_index');
        }

        return $this->render('AdminBundle:Communaute:editc.html.twig', array(
            'commun' => $commun,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Commun entity.
     *
     */
    public function deleteAction(Request $request, Commun $commun)
    {
        $form = $this->createDeleteForm($commun);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($commun);
            $em->flush();
        }

        return $this->redirectToRoute('admin_communaute_index');
    }

    /**
     * Creates a form to delete a Commun entity.
     *
     * @param Commun $commun The Commun entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Commun $commun)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_commun_delete', array('id' => $commun->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
