<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Client|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client[]    findAll()
 * @method Client[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientRepository extends ServiceEntityRepository
{
	const numberOfElementsByPage = 2;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    /**
	 * Retrieve the list of clients
	 * @return QueryBuilder
	 */
	public function getAllClientsQueryBuilder(){

		$queryBuilder = $this->createQueryBuilder('client');
        $queryBuilder->addSelect('client');
		
		return $queryBuilder;
	}

    public function getClients($page){
		$firstResult = ($page - 1) * self::numberOfElementsByPage;

		$queryBuilder = $this->getAllClientsQueryBuilder();
		
		$queryBuilder->setFirstResult($firstResult);
		$queryBuilder->setMaxResults(self::numberOfElementsByPage);
		
		$query = $queryBuilder->getQuery()->getResult();
		
		return $query;
	}
}
