<?php

namespace FractalizeR\LibrarianBundle\Logic\Domain\Article\Repository;

use Doctrine\ORM\EntityRepository;
use FractalizeR\LibrarianBundle\Logic\Domain\Article\Entity\Article;

/**
 * Class ArticleRepository
 *
 * @package FractalizeR\LibrarianBundle\Logic\Domain\Article\Repository
 */
class ArticleRepository extends EntityRepository
{
    /**
     * @param Article $article
     */
    public function save(Article $article)
    {
        $this->getEntityManager()->persist($article);
    }
}
