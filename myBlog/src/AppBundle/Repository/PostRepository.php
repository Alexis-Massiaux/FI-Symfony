<?php

namespace AppBundle\Repository;

/**
 * PostRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostRepository extends \Doctrine\ORM\EntityRepository
{
    //personnaliser les requetes pour faire une seule requetes au lieu de deux.
    public function findLatest(){
        return $this->latestQuery()
            ->getQuery();

    }

    public function findByTag($name){
        return $this->latestQuery()
            ->join('p.tags','tmp')
            ->where('tmp.name = :name')
            ->addSelect('t')
            ->setParameter('name',$name)
            ->getQuery();
    }

    private function latestQuery(){
        return $this ->createQueryBuilder('p')
            ->join('p.tags','t')
            ->select('p,t');
    }
}
