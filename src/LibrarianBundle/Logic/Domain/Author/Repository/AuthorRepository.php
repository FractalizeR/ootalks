<?php

namespace FractalizeR\LibrarianBundle\Logic\Domain\Author\Repository;

use Doctrine\ORM\EntityRepository;
use FractalizeR\LibrarianBundle\Logic\Domain\Author\Entity\Author;
use FractalizeR\LibrarianBundle\Logic\Infrastructure\Repository\RepositoryQueryLimitsTrait;

/**
 * Class AuthorRepository
 *
 * @package FractalizeR\LibrarianBundle\Logic\Domain\Author\Repository
 */
class AuthorRepository extends EntityRepository
{
    use RepositoryQueryLimitsTrait;

    /**
     * @param Author $author
     */
    public function save(Author $author)
    {
        $this->getEntityManager()->persist($author);
    }

    /**
     * @param $namePart
     *
     * @return Author[]
     */
    public function findWithNameStartingWith($namePart)
    {
        $queryBuilder = $this->createQueryBuilder('A')
            ->where("A.fullName LIKE :fullName")
            ->orderBy('A.fullName')
            ->setParameter('fullName', "{$namePart}%");

        $this->applyQueryLimits($queryBuilder);

        return $queryBuilder->getQuery()->getResult();
    }
}
