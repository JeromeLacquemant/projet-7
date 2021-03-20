<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

        /**
	 * Retrieve the list of active orders with all their actives packages
	 * @return QueryBuilder
	 */
	public function getAllProductQueryBuilder(){

		// Select the orders and their packages
		$queryBuilder = $this->createQueryBuilder('product');
        $queryBuilder->addSelect('product');
		
		//Return the QueryBuilder
		return $queryBuilder;
	}

    public function getProducts($page){
		$pageSize = 4;
		$firstResult = ($page - 1) * $pageSize;

		$queryBuilder = $this->getAllProductQueryBuilder();
		
		// Set the returned page
		$queryBuilder->setFirstResult($firstResult);
		$queryBuilder->setMaxResults($pageSize);
		
		// Generate the Query
		$query = $queryBuilder->getQuery();
		
		// Generate the Paginator
		$paginator = new Paginator($query, true);

		return $paginator;
	}
}
