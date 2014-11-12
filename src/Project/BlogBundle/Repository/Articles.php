<?php

namespace Project\BlogBundle\Repository;


use Doctrine\ORM\EntityRepository;

class Articles extends EntityRepository{


    public function getListQuery($categories = null)
    {
        $qb= $this->getEntityManager()->createQueryBuilder();
        $select = $qb->select('a')
            ->from('ProjectBlogBundle:Article','a')
            ->leftJoin('a.category','c')
            ->orderBy('a.createdAt','ASC');
        if(!is_null($categories)){
            $select->where($qb->expr()->in('c.id',$categories));
        }
        return $select;
    }
} 