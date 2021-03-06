<?php

namespace App\Http\Repository;

use App\Http\Entity\Product;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\QueryException;

/**
 * Class ProductRepository
 * @package App\Http\Repository
 */
class ProductRepository extends EntityRepository
{

    /**
     * @param array $productIds
     * @return Product[]
     * @throws QueryException
     */
    public function productsByIds(array $productIds): array
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('p')
            ->from(Product::class, 'p')
            ->where($qb->expr()->in('p.id', $productIds))
            ->indexBy('p', 'p.id');

        return $qb->getQuery()->getResult();
    }

    public function productsAll(): array
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('p')
            ->from(Product::class, 'p');
        return $qb->getQuery()->getResult();
    }
}