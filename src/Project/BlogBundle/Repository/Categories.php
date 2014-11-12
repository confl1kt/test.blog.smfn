<?php

namespace Project\BlogBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Project\BlogBundle\Entity\Category;

class Categories extends EntityRepository{

    /**
     * @return Category[]
     */
    public function getCategories()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $select = $qb->select('c,a')
            ->from('ProjectBlogBundle:Category','c')
            ->leftJoin('c.articles','a')
            ->orderBy('c.name','ASC');
        return $select->getQuery()->useResultCache(true)->getResult();
    }
}