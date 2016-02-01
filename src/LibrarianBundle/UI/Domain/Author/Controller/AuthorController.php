<?php

namespace FractalizeR\LibrarianBundle\UI\Domain\Author\Controller;

use FractalizeR\LibrarianBundle\Logic\Domain\Author\Entity\Author;
use FractalizeR\LibrarianBundle\Logic\Domain\Author\Repository\AuthorRepository;
use FractalizeR\LibrarianBundle\UI\Domain\Author\Form\AuthorForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Author controller
 * @Route(service="ui.author_controller")
 *
 * @package FractalizeR\LibrarianBundle\UI\Domain\Author\Controller
 */
class AuthorController extends Controller
{
    /**
     * @var AuthorRepository
     */
    private $repository;

    /**
     * AuthorController constructor.
     *
     * @param AuthorRepository $repository
     */
    public function __construct(AuthorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/authors/{id}-{title}", requirements={"id" = "\d+"}, name="author_display")
     * @param int $id
     *
*@return \Symfony\Component\HttpFoundation\Response
     */
    public function displayAction(int $id)
    {
        $author = $this->getAuthorById($id);

        return $this->render('@author/index.html.twig', ['author' => $author]);
    }

    /**
     * @Route("/authors/create", name="author_create")
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $form = $this->getAuthorCreateForm()->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Author $author */
            $author = $form->getData();
            $this->repository->save($author);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('author_display', ['id' => $author->id, 'title' => $author->title]);
        }

        return $this->render('@author/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/authors/{id}-{title}/edit", name="author_edit")
     * @param Request $request
     * @param int     $id
     * @param string  $title
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, int $id, string $title)
    {
        $author = $this->getAuthorById($id);

        $form = $this->getAuthorEditForm($author)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Author $author */
            $author = $form->getData();
            $this->repository->save($author);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('author_display', ['id' => $author->id, 'title' => $author->title]);
        }

        return $this->render('@author/edit.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @return \Symfony\Component\Form\Form
     */
    protected function getAuthorCreateForm()
    {
        $action = $this->generateUrl('author_create');

        return $this->createForm(AuthorForm::class, null, ['action' => $action, 'method' => 'POST']);
    }

    /**
     * @param Author $author
     *
     * @return \Symfony\Component\Form\Form
     */
    protected function getAuthorEditForm(Author $author = null)
    {
        $action = $this->generateUrl('author_edit', ['id' => $author->id, 'title' => $author->title]);

        return $this->createForm(AuthorForm::class, $author, ['action' => $action, 'method' => 'POST']);
    }

    /**
     * @param int $id
     *
     * @return Author|null|object
     */
    private function getAuthorById(int $id)
    {
        $author = $this->repository->find($id);
        if (null === $author) {
            throw new NotFoundHttpException("Author with id '$id' is not found");

        }

        return $author;
    }
}
