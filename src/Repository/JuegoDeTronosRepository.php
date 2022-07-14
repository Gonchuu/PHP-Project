<?php

namespace App\Repository;

use App\Entity\JuegoDeTronos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<JuegoDeTronos>
 *
 * @method JuegoDeTronos|null find($id, $lockMode = null, $lockVersion = null)
 * @method JuegoDeTronos|null findOneBy(array $criteria, array $orderBy = null)
 * @method JuegoDeTronos[]    findAll()
 * @method JuegoDeTronos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JuegoDeTronosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JuegoDeTronos::class);
    }

    public function add(JuegoDeTronos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(JuegoDeTronos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return JuegoDeTronos[] Returns an array of JuegoDeTronos objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('j.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?JuegoDeTronos
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
