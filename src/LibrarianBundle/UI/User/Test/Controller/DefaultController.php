<?php

namespace FractalizeR\LibrarianBundle\UI\User\Test\Controller;

use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render(
            '@user_test/index.html.twig',
            [
                'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            ]
        );
    }

    /**
     * @Route("/article/{id}-{name}", requirements={"id" = "\d+"}, name="article_display")
     * @param int     $id
     * @param string  $name
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function displayAction($id, $name, Request $request)
    {
        $doctrine = $this->getDoctrine();

        /** @var EntityManager $doctrineManager */
        $doctrineManager = $doctrine->getManager();

        $qb = $doctrineManager->createQueryBuilder();
        $article = $qb
            ->select("a")
            ->from('Article:Article', 'a')
            ->where("a.id = :id")
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleResult();


        // replace this example code with whatever you need
        return $this->render(
            '@user_test/index.html.twig',
            [
                'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
                'article' => $article,
            ]
        );
    }
}
