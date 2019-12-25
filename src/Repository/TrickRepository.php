<?php

namespace App\Repository;

use App\Entity\Trick;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Trick|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trick|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trick[]    findAll()
 * @method Trick[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrickRepository extends ServiceEntityRepository
{
    /**
     *
     */
    const NB_PRICK_PER_PAGE = 4;

    /**
     * TrickRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trick::class);
    }


    /**
     * @param int $page
     * @return Trick[]
     */
    public function findTricksPerPage(int $page = 1): array
    {

        if ($page < 1) {
            throw new \InvalidArgumentException();
        }

        $req = $this->createQueryBuilder('p')
            ->setMaxResults(self::NB_PRICK_PER_PAGE)
            ->setFirstResult(($page - 1) * self::NB_PRICK_PER_PAGE)
            ->orderBy('p.id', 'DESC')
            ->getQuery();

        return $req->execute();
    }

    /**
     * @param $id
     * @return Trick|null
     */
    public function oneTrickById($id)
    {
        return $req = $this->find($id);
    }

    public function tricksForLoadMore(int $page)
    {
        $req = $this->createQueryBuilder('p')
            ->setMaxResults(self::NB_PRICK_PER_PAGE)
            ->setFirstResult(($page - 1) * self::NB_PRICK_PER_PAGE)
            ->orderBy('p.id', 'DESC')
            ->getQuery();

        return $req->execute();
    }

    public function countMaxPage()
    {
        $req = $this->findAll();
        $count = count($req);

        $pages = $count / self::NB_PRICK_PER_PAGE;

        return $pages;
    }

    public function save(Trick $trick)
    {
        $this->_em->persist($trick);
        $this->_em->flush();
    }
}
