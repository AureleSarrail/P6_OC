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
    const NB_PRICK_PER_PAGE = 5;

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

        if($page < 1){
            throw new \InvalidArgumentException();
        }

        $req = $this->createQueryBuilder('p')
            ->setMaxResults(self::NB_PRICK_PER_PAGE)
            ->setFirstResult(($page-1) * self::NB_PRICK_PER_PAGE)
            ->orderBy('p.id', 'ASC')
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


}
