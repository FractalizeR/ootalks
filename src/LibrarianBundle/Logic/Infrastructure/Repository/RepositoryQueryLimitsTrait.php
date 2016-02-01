<?php

namespace FractalizeR\LibrarianBundle\Logic\Infrastructure\Repository;

use Doctrine\ORM\QueryBuilder;

/**
 * Trait to limit system queries from a user standpoint in a sane way
 *
 * @package FractalizeR\LibrarianBundle\Logic\Infrastructure\Repository
 */
trait RepositoryQueryLimitsTrait
{
    /**
     * @var int Current maximum of query results
     */
    private $queryMaxResults;

    /**
     * @var int Absolute maximum of query results a system supports
     */
    private $absQueryMaxResults = 1000;

    /**
     * Sets the maximum results query can return this time
     *
     * @param int $queryMaxResults
     */
    public function setQueryMaxResults(int $queryMaxResults)
    {
        $this->queryMaxResults = $queryMaxResults;
    }

    public function applyQueryLimits(QueryBuilder $queryBuilder)
    {
        $queryBuilder->setMaxResults(min($this->queryMaxResults, $this->absQueryMaxResults));
    }
}
