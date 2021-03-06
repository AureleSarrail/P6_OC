<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param $mail
     * @return User
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findUserByMail($mail)
    {
        $req = $this->createQueryBuilder('u')
            ->where('u.mail = :value')
            ->setParameter('value', $mail)
            ->getQuery();

        return $req->getOneOrNullResult();
    }

    public function findUserByResetToken($token)
    {
        $req = $this->createQueryBuilder('u')
            ->where('u.resetToken = :value')
            ->setParameter('value', $token)
            ->getQuery();

        $result = $req->execute();

        return $result[0];
    }
}
