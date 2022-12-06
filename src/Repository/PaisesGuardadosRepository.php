<?php

namespace App\Repository;

use App\Entity\PaisesGuardados;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PaisesGuardados>
 *
 * @method PaisesGuardados|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaisesGuardados|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaisesGuardados[]    findAll()
 * @method PaisesGuardados[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaisesGuardadosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaisesGuardados::class);
    }

    public function add(PaisesGuardados $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PaisesGuardados $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PaisesGuardados[] Returns an array of PaisesGuardados objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PaisesGuardados
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
