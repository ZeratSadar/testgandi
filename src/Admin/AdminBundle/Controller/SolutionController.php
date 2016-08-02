<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pages\CoreBundle\Entity\Solution;
use Admin\AdminBundle\Form\SolutionType;

/**
 * Solution controller.
 *
 */
class SolutionController extends Controller
{
    /**
     * Lists all Solution entities.
     *
     */
    public function indexAction(Request $request)
    {
        $solution = new Solution();
        $form = $this->createForm(new SolutionType(), $solution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($solution);
            $em->flush();

            return $this->redirectToRoute('admin_solution_index');
        }

        $em = $this->getDoctrine()->getManager();

        $solutions = $em->getRepository('CoreBundle:Solution')->findAll();

        return $this->render('AdminBundle:Solutions:index.html.twig', array(
            'solutions' => $solutions,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Solution entity.
     *
     */
    public function editAction(Request $request, Solution $solution)
    {
        $deleteForm = $this->createDeleteForm($solution);
        $editForm = $this->createForm(new SolutionType(), $solution);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($solution);
            $em->flush();

            return $this->redirectToRoute('admin_solution_index');
        }

        return $this->render('AdminBundle:Solutions:edit.html.twig', array(
            'solution' => $solution,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Solution entity.
     *
     */
    public function deleteAction(Request $request, Solution $solution)
    {
        $form = $this->createDeleteForm($solution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($solution);
            $em->flush();
        }

        return $this->redirectToRoute('admin_solution_index');
    }

    public function delete_formAction(Request $request, Solution $solution)
    {
        $deleteForm = $this->createDeleteForm($solution);
        return $this->render('AdminBundle:Solutions:delete_form.html.twig',
            array(
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Creates a form to delete a Solution entity.
     *
     * @param Solution $solution The Solution entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Solution $solution)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_solution_delete', array('id' => $solution->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
