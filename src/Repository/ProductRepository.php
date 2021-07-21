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
	const NUMBER_OF_ELEMENTS_BY_PAGE = 6;
	
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
		$firstResult = ($page - 1) * self::NUMBER_OF_ELEMENTS_BY_PAGE;

		$queryBuilder = $this->getAllProductQueryBuilder();
		
		$queryBuilder->setFirstResult($firstResult);
		$queryBuilder->setMaxResults(self::NUMBER_OF_ELEMENTS_BY_PAGE);
		
		$query = $queryBuilder->getQuery()->getResult();

		return $query;
	}
}
