<?php

namespace Pages\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pages\CoreBundle\Entity\Commun;
use Pages\CoreBundle\Entity\Partner;
use Pages\CoreBundle\Entity\Equipe;

/**
 * Core controller.
 *
 */
class CoreController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $news = $em->createQueryBuilder()
                    ->select('n')
                    ->from('CoreBundle:News',  'n')
                    ->addOrderBy('n.id', 'DESC')
                    ->setMaxResults('3')
                    ->getQuery()
                    ->getResult();

        return $this->render('CoreBundle:Pages:index.html.twig', array(
            'news' => $news,
        ));
    }

    public function newsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $news = $em->createQueryBuilder()
                    ->select('n')
                    ->from('CoreBundle:News',  'n')
                    ->addOrderBy('n.id', 'DESC')
                    ->getQuery()
                    ->getResult();

        return $this->render('CoreBundle:Pages:news.html.twig', array(
            'news' => $news,
        ));
    }

    public function infoAction()
    {
        $em = $this->getDoctrine()->getManager();

        $infos = $em->getRepository('CoreBundle:Info')->findAll();

        return $this->render('CoreBundle:Pages:info.html.twig', array(
            'infos' => $infos,
        ));
    }

    public function solutionAction()
    {
        $em = $this->getDoctrine()->getManager();

        $solutions = $em->createQueryBuilder()
                    ->select('s')
                    ->from('CoreBundle:Solution',  's')
                    ->addOrderBy('s.solNom', 'ASC')
                    ->getQuery()
                    ->getResult();

        return $this->render('CoreBundle:Pages:solution.html.twig', array(
            'solutions' => $solutions,
        ));
    }

    public function eventAction()
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->createQueryBuilder()
                    ->select('e')
                    ->from('CoreBundle:Event',  'e')
                    ->addOrderBy('e.dates', 'DESC')
                    ->getQuery()
                    ->getResult();

        return $this->render('CoreBundle:Pages:event.html.twig', array(
            'events' => $events,
        ));
    }

    public function mediaAction()
    {
        $em = $this->getDoctrine()->getManager();

        $media = $em->createQueryBuilder()
                    ->select('m')
                    ->from('CoreBundle:Media', 'm')
                    ->addOrderBy('m.dates', 'DESC')
                    ->getQuery()
                    ->getResult();

        return $this->render('CoreBundle:Pages:media.html.twig', array(
            'media' => $media,
        ));
    }

    public function communAction()
    {
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

        return $this->render('CoreBundle:Pages:commun.html.twig', array(
            'communs' => $communs,
            'partners' => $partners,
            'equipes' => $equipes,
        ));
    }
}
