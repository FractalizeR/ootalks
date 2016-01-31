<?php

namespace FractalizeR\LibrarianBundle\UI\Domain\Article\Controller;

use FractalizeR\LibrarianBundle\Logic\Domain\Article\Entity\Article;
use FractalizeR\LibrarianBundle\Logic\Domain\Article\Repository\ArticleRepository;
use FractalizeR\LibrarianBundle\UI\Domain\Article\Form\ArticleForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Article controller
 * @Route(service="ui.article_controller")
 *
 * @package FractalizeR\LibrarianBundle\UI\Domain\Article\Controller
 */
class ArticleController extends Controller
{
    /**
     * @var ArticleRepository
     */
    private $repository;

    /**
     * ArticleController constructor.
     *
     * @param ArticleRepository $repository
     */
    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/articles/{id}-{title}", requirements={"id" = "\d+"}, name="article_display")
     * @param int     $id
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function displayAction(int $id, Request $request)
    {
        $article = $this->getArticleById($id);

        return $this->render('@article/index.html.twig', ['article' => $article,]);
    }

    /**
     * @Route("/articles/create", name="article_create")
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $form = $this->getArticleForm($this->generateUrl('article_create'))->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Article $article */
            $article = $form->getData();
            $this->repository->save($article);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_display', ['id' => $article->id, 'title' => $article->title]);
        }

        return $this->render('@article/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/articles/{id}-{title}/edit", name="article_edit")
     * @param Request $request
     * @param int     $id
     * @param string  $title
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, int $id, string $title)
    {
        $article = $this->getArticleById($id);
        $url = $this->generateUrl('article_edit', ['id' => $id, 'title' => $title]);
        $form = $this->getArticleForm($url, $article)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Article $article */
            $article = $form->getData();
            $this->repository->save($article);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_display', ['id' => $article->id, 'title' => $article->title]);
        }

        return $this->render('@article/edit.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @param string  $action
     * @param Article $article
     *
     * @return \Symfony\Component\Form\Form
     */
    protected function getArticleForm(string $action, Article $article = null)
    {
        $form = $this->createForm(ArticleForm::class, $article, ['action' => $action, 'method' => 'POST']);

        return $form;
    }

    /**
     * @param int $id
     *
     * @return null|object
     */
    private function getArticleById(int $id)
    {
        $article = $this->repository->find($id);

        if (null === $article) {
            throw new NotFoundHttpException("Article with id '$id' is not found");
        }

        return $article;
    }
}
