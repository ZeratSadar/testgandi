<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pages\CoreBundle\Entity\Commun;
use Pages\CoreBundle\Entity\Partner;
use Pages\CoreBundle\Entity\Equipe;
use Admin\AdminBundle\Form\CommunType;
use Admin\AdminBundle\Form\PartnerType;
use Admin\AdminBundle\Form\EquipeType;

/**
 * Communaute controller.
 *
 */
class CommunauteController extends Controller
{
    /**
     * Lists all Communaute entities.
     *
     */
    public function indexAction(Request $request)
    {
        $commun = new Commun();
        $partner = new Partner();
        $equipe = new Equipe();
        $formc = $this->createForm(new CommunType(), $commun);
        $formp = $this->createForm(new PartnerType(), $partner);
        $forme = $this->createForm(new EquipeType(), $equipe);
        $formc->handleRequest($request);
        $formp->handleRequest($request);
        $forme->handleRequest($request);

        if ($formc->isSubmitted() && $formc->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commun);
            $em->flush();

            return $this->redirectToRoute('admin_communaute_index');
        }

        if ($formp->isSubmitted() && $formp->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($partner);
            $em->flush();

            return $this->redirectToRoute('admin_communaute_index');
        }

        if ($forme->isSubmitted() && $forme->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($equipe);
            $em->flush();

            return $this->redirectToRoute('admin_communaute_index');
        }

        $em = $this->getDoctrine()->getManager();

        $communs = $em->createQueryBuilder()
                    ->select('c')
                    ->from('CoreBundle:Commun', 'c')
                    ->addOrderBy('c.vpNom', 'ASC')
                    ->getQuery()
                    ->getResult();

        $partners = $em->createQueryBuilder()
                    ->select('p')
                    ->from('CoreBundle:Partner', 'p')
                    ->addOrderBy('p.paPartner', 'ASC')
                    ->getQuery()
                    ->getResult();

        $equipes = $em->createQueryBuilder()
                    ->select('e')
                    ->from('CoreBundle:Equipe', 'e')
                    ->addOrderBy('e.eqNom', 'ASC')
                    ->getQuery()
                    ->getResult();

        return $this->render('AdminBundle:Communaute:index.html.twig', array(
            'communs' => $communs,
            'partners' => $partners,
            'equipes' => $equipes,
            'formc' => $formc->createView(),
            'formp' => $formp->createView(),
            'forme' => $forme->createView(),
        ));
    }
}
