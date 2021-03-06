<?php

namespace App\Repository;

use App\Entity\Foto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Foto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Foto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Foto[]    findAll()
 * @method Foto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FotoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Foto::class);
    }

    // /**
    //  * @return Foto[] Returns an array of Foto objects
    //  */
    
    public function findByUsuario($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.anuncio_id = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    
public function findByNombre($nombre){

    return $this->createQueryBuilder('f')
    ->andWhere('f.nombre = :val')
    ->setParameter('val', $nombre)
    ->orderBy('f.id', 'ASC')
    ->getQuery()
    ->getResult()
;
}
    /*
    public function findOneBySomeField($value): ?Foto
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
