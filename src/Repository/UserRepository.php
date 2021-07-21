<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\Security\Core\Security;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
	const NUMBER_OF_ELEMENTS_BY_PAGE = 6;

    public function __construct(ManagerRegistry $registry, Security $security)
    {
        parent::__construct($registry, User::class);
        $this->security = $security;
    }

    /**
	 * Retrieve the list of users
	 * @return QueryBuilder
	 */
	public function getAllUsersQueryBuilder($id){

		$queryBuilder = $this->createQueryBuilder('user');
        $queryBuilder   ->andWhere('user.client = :id')
                        ->setParameter('id', $id);
		
		return $queryBuilder;
	}

    public function getUsers($page){
        $id = $this->security->getUser();

		$firstResult = ($page - 1) * self::NUMBER_OF_ELEMENTS_BY_PAGE;

		$queryBuilder = $this->getAllUsersQueryBuilder($id);
		
		$queryBuilder->setFirstResult($firstResult);
		$queryBuilder->setMaxResults(self::NUMBER_OF_ELEMENTS_BY_PAGE);
		
		$query = $queryBuilder->getQuery()->getResult();

		return $query;
	}
}
