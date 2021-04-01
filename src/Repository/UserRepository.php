<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    const numberOfElementsByPage = 6;

    public function __construct(ManagerRegistry $registry, Security $security)
    {
        parent::__construct($registry, User::class);
        $this->security = $security;
    }

    /**
     * Retrieve the list of users.
     *
     * @return QueryBuilder
     */
    public function getAllUsersQueryBuilder($id)
    {
        $queryBuilder = $this->createQueryBuilder('user');
        $queryBuilder->andWhere('user.client = :id')
                        ->setParameter('id', $id);

        return $queryBuilder;
    }

    public function getUsers($page)
    {
        $id = $this->security->getUser();

        $firstResult = ($page - 1) * self::numberOfElementsByPage;

        $queryBuilder = $this->getAllUsersQueryBuilder($id);

        $queryBuilder->setFirstResult($firstResult);
        $queryBuilder->setMaxResults(self::numberOfElementsByPage);

        $query = $queryBuilder->getQuery();

        $paginator = new Paginator($query, true);

        return $paginator;
    }
}
