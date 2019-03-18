<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Event::class);
    }

    // /**
    //  * @return Event[] Returns an array of Event objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    
    public function recup()
    {
        return $this->createQueryBuilder('e')
            //->andWhere('e.exampleField = :val')
            //->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

    public function recupFive($un, $deux)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.date BETWEEN :un AND :deux')
            ->setParameter('un', $un)
            ->setParameter('deux', $deux)
            ->orderBy('e.date', 'DESC')
            ->setFirstResult(0)
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }

    public function recupFL()
    {
        /*$aC = new ArrayCollection();
        $all= $this->recup();
        $aC->add(reset($all));
        $aC->add(end($all));
        return $aC;*/

        $sql = 'SELECT * FROM `event` AS A WHERE `date` = (SELECT MIN(`date`) from `event` AS B) OR `date` = (SELECT MAX(`date`) from `event` AS C)';

        $em = $this->getEntityManager()->getConnection();
        $stmt = $em->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function recupDate($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.date = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }
    
}
