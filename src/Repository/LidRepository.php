<?php

namespace App\Repository;

use App\Entity\Lid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Lid|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lid|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lid[]    findAll()
 * @method Lid[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LidRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lid::class);
    }

    /**
     * @return Lid[] Returns an array of Lid objects
     */
    public function findAllLidnummersAndGeboortedatums(): array
    {
        return $this->createQueryBuilder('l')
            ->select('l.lidnummer, l.geboortedatum')
            ->getQuery()
            ->getResult();
    }
}
