<?php

namespace App\Repository;

use App\Entity\Commentaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Commentaire>
 *
 * @method Commentaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commentaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commentaire[]    findAll()
 * @method Commentaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commentaire::class);
    }

    public function add(Commentaire $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Commentaire $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Commentaire[] Returns an array of Commentaire objects
//     */
   public function findAllByPays($value): array
   {
       return $this->createQueryBuilder('c')
           ->andWhere('c.pays = :val')
           ->setParameter('val', $value)
           ->orderBy('c.id DESC')
           ->setMaxResults(10)
           ->getQuery()
           ->getResult()
       ;
   }
   
//    public function findOneBySomeField($value): ?Commentaire
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

public function searchCommentsByTag(string $value)
{
    $query = $this->createQueryBuilder('c');
    $query->orWhere('c.message like :val')       
    ->addSelect('p')
    ->leftJoin('c.pays', 'p', 'WITH','p.nom like :val') 
    ->setParameter('val', '%'.$value.'%');
    
    return $query->getQuery()
          ->getResult()
      ;

}
}
