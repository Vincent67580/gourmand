<?php

namespace App\Repository;

use App\Entity\Recipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @extends ServiceEntityRepository<Recipe>
 */
class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

    //    /**
    //     * @return Recipe[] Returns an array of Recipe objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Recipe
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
    /**
     * Récupère les recettes paginées avec filtres optionnels
     */
    public function findPaginated(int $page = 1, int $limit = 6, ?string $search = null, ?int $categoryId = null): Paginator
    {
        $qb = $this->createQueryBuilder('r')
            ->leftJoin('r.category', 'c')
            ->addSelect('c')
            // 1. Ordre strict de création des catégories : 1. Entrées, 2. Plats, 3. Desserts
            ->orderBy('c.id', 'ASC')
            // 2. Ordre alphabétique des recettes de A à Z
            ->addOrderBy('r.title', 'ASC');

        if ($search) {
            $qb->andWhere('r.title LIKE :search OR r.description LIKE :search')
            ->setParameter('search', '%' . $search . '%');
        }

        if ($categoryId) {
            $qb->andWhere('r.category = :categoryId')
            ->setParameter('categoryId', $categoryId);
        }

        $query = $qb->getQuery()
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit);

        return new Paginator($query);
    }

    public function findTopViewed(int $limit = 3): array
    {
        return $this->createQueryBuilder('r')
            ->orderBy('r.views', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

}
