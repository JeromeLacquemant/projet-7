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
	const numberOfElementsByPage = 6;
	
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
	 * Retrieve the list of products 
	 * @return QueryBuilder
	 */
	public function getAllProductQueryBuilder(){

		$queryBuilder = $this->createQueryBuilder('product');
        $queryBuilder->addSelect('product');
		
		return $queryBuilder;
	}

    public function getProducts($page){
		$firstResult = ($page - 1) * self::numberOfElementsByPage;

		$queryBuilder = $this->getAllProductQueryBuilder();
		
		$queryBuilder->setFirstResult($firstResult);
		$queryBuilder->setMaxResults(self::numberOfElementsByPage);
		
		$query = $queryBuilder->getQuery()->getResult();

		return $query;
	}
}
