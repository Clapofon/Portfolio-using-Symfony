<?php

namespace App\Repository;

use App\Entity\Render;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Render>
 *
 * @method Render|null find($id, $lockMode = null, $lockVersion = null)
 * @method Render|null findOneBy(array $criteria, array $orderBy = null)
 * @method Render[]    findAll()
 * @method Render[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RenderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Render::class);
    }

    public function save(Render $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Render $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByProjectSlug($projectSlug): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT r, p
            FROM App\Entity\Render r
            INNER JOIN r.project p
            WHERE p.slug = :slug'
        )->setParameter('slug', $projectSlug);

        return $query->getResult();
    }

   /**
    * @return Render[] Returns an array of Render objects
    */
   public function findByProject($value): array
   {
       return $this->createQueryBuilder('r')
           ->andWhere('r.exampleField = :val')
           ->setParameter('val', $value)
           ->orderBy('r.id', 'ASC')
           ->setMaxResults(10)
           ->getQuery()
           ->getResult()
       ;
   }

//    public function findOneBySomeField($value): ?Render
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
