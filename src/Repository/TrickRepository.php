<?php

namespace App\Repository;

    use App\Entity\Trick;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Doctrine\Common\Collections\ArrayCollection;
    use Doctrine\Common\Persistence\ManagerRegistry;

    /**
     * @method Trick|null find($id, $lockMode = null, $lockVersion = null)
     * @method Trick|null findOneBy(array $criteria, array $orderBy = null)
     * @method Trick[]    findAll()
     * @method Trick[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
     */
class TrickRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trick::class);
    }


    /**
     * @param int $page
     * @return Trick[]
     */
    public function findTricksPerPage(int $page): array
    {
        if ($page==0) {
            $max = 15;
        }
        else {
            $max = $page*15;
        }

        $min = $max-14;

        $req = $this->createQueryBuilder('p')
            ->where('p.id >= :min')
            ->andWhere('p.id <= :max')
            ->setParameters(array(
                'min' => $min,
                'max' => $max
            ))
            ->orderBy('p.id', 'ASC')
            ->getQuery();

        return $req->execute();
    }

    // /**
    //  * @return Trick[] Returns an array of Trick objects
    //  */

//    public function findByExampleField($value)
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->setFirstResult(15*$page)
//            ->getQuery()
//            ->getResult()
//        ;
//    }


    /*
    public function findOneBySomeField($value): ?Trick
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
