<?php

namespace App\Repository;

use App\Entity\Comment;
use App\Entity\Trick;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    const NB_COMMENT_MAX = 10;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    public function loadMoreComment(Trick $trick, int $page = 1)
    {

        $req = $this->createQueryBuilder('p')
            ->where('p.trick = :trick')
            ->setMaxResults(self::NB_COMMENT_MAX)
            ->setFirstResult(($page - 1) * self::NB_COMMENT_MAX)
            ->orderBy('p.createdAt', 'DESC')
            ->setParameter('trick', $trick)
            ->getQuery();

        return $req->execute();
    }
}
