<?php

namespace App\Repository;

use App\Entity\Hobbies;
use App\Entity\Photos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Hobbies>
 *
 * @method Hobbies|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hobbies|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hobbies[]    findAll()
 * @method Hobbies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HobbiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hobbies::class);
    }

    public function add(Hobbies $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Hobbies $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function findOneByHobbiesField(string $value): ?Hobbies
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.loisir = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }


//    /**
//     * @return Hobbies[] Returns an array of Hobbies objects
//     */
//    public function findByCategorieField($value): array
//    {
//        return $this->createQueryBuilder('h')
//         //    ->from('categorie', 'c')
//            ->leftJoin('h.categorie', 'c', 'WITH','c.categorie = :val', 'c.id')
//            ->leftJoin('h.pays', 'p')
//            ->setParameter('val', $value)
//         //    ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Hobbies
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}


