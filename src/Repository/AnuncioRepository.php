<?php

namespace App\Repository;
use App\Entity\User;
use App\Entity\Anuncio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Anuncio|null find($id, $lockMode = null, $lockVersion = null)
 * @method Anuncio|null findOneBy(array $criteria, array $orderBy = null)
 * @method Anuncio[]    findAll()
 * @method Anuncio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnuncioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Anuncio::class);
    }

    // /**
    //  * @return Anuncio[] Returns an array of Anuncio objects
    //  */
    /*
    public function findByExampleField($value)
    {
    return $this->createQueryBuilder('a')
    ->andWhere('a.exampleField = :val')
    ->setParameter('val', $value)
    ->orderBy('a.id', 'ASC')
    ->setMaxResults(10)
    ->getQuery()
    ->getResult()
    ;
    }
     */

    /*
    public function findOneBySomeField($value): ?Anuncio
    {
    return $this->createQueryBuilder('a')
    ->andWhere('a.exampleField = :val')
    ->setParameter('val', $value)
    ->getQuery()
    ->getOneOrNullResult()
    ;
    }
     */

    // /**
    //  * @return Anuncio[] Returns an array of Anuncio objects
    //  */
    public function findByPortada()
    {

$em = $this->getEntityManager();
$anuncios = $em->createQuery("SELECT a FROM App\Entity\Anuncio a ORDER BY a.fecha_crea DESC")
    ->getResult();

return $anuncios;
    }
    public function busquedaProvincia($provincia)
    {
       
            $em = $this->getEntityManager();
            $anuncios = $em->createQuery("SELECT a FROM App\Entity\Anuncio a JOIN App\Entity\User u  u.provincia=$provincia")->getResult();
                dd($anuncios);
        return $anuncios;

$products = $query->getResult();

    }
    public function vertodos()
    {

        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT a
            FROM App\Entity\Anuncio a
           '
        );

        return $query->getResult();
    }
    public function busqueda($elemento)
    {
        $query = $this->createQueryBuilder('a')
            ->andWhere('a.titulo LIKE :elemento')
            ->setParameter('elemento', '%' . $elemento . '%')
            ->getQuery();
        return $query->getResult();

    }
public function findByUsuario($id){
            $em = $this->getEntityManager();
            $anuncios = $em->createQuery("SELECT a FROM App\Entity\Anuncio a WHERE a.user_id=$id")
                ->getResult();
        return $anuncios;

}
public function ordenarPor($busqueda,$orden){
if($busqueda="titulo" OR $busqueda="fechacrea"){
    $em = $this->getEntityManager();
    $anuncios = $em->createQuery("SELECT a FROM App\Entity\Anuncio a ORDER BY a.$busqueda $orden")
        ->getResult();
}
else{// Busqueda = Autor
    $em = $this->getEntityManager();
    $anuncios = $em->createQuery("SELECT a FROM App\Entity\Anuncio a JOIN App\Entity\User ORDER BY u.$busqueda $orden")
        ->getResult();

}
return $anuncios; 
}

}
