<?php

namespace FractalizeR\LibrarianBundle\Logic\Domain\Author\Repository;

use Doctrine\ORM\EntityRepository;
use FractalizeR\LibrarianBundle\Logic\Domain\Author\Entity\Author;

/**
 * Class AuthorRepository
 *
 * @package FractalizeR\LibrarianBundle\Logic\Domain\Author\Repository
 */
class AuthorRepository extends EntityRepository
{
    /**
     * @param Author $author
     */
    public function save(Author $author)
    {
        $this->getEntityManager()->persist($author);
    }
}
