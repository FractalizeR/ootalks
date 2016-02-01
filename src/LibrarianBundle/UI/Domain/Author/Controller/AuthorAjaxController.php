<?php

namespace FractalizeR\LibrarianBundle\UI\Domain\Author\Controller;

use FractalizeR\LibrarianBundle\Logic\Domain\Author\Repository\AuthorRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * @Route(service="ui.author_controller.ajax")
 * @package FractalizeR\LibrarianBundle\UI\Domain\Author\Controller
 */
class AuthorAjaxController extends Controller
{
    const MAX_RESPONSE_LENGTH = 200;

    /**
     * @var AuthorRepository
     */
    private $repository;

    /**
     * @var NormalizerInterface
     */
    private $normalizer;


    /**
     * @param AuthorRepository    $repository
     * @param NormalizerInterface $normalizer
     */
    public function __construct(AuthorRepository $repository, NormalizerInterface $normalizer)
    {
        $this->repository = $repository;
        $this->normalizer = $normalizer;
    }

    /**
     * @Route("/api/v1/authors", name="api_authors")
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function indexAction(Request $request)
    {
        $authorName = $request->query->get('fullNameStartsWith');
        if (strlen($authorName) < 3) {
            throw new BadRequestHttpException("At least three letters needed to fetch author list");
        }

        $authors = $this->repository->findWithNameStartingWith($authorName);

        return new JsonResponse($this->normalizer->normalize($authors, 'json', ['groups' => ['list']]));
    }
}
