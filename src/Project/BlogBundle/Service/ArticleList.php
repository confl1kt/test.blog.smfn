<?php

namespace Project\BlogBundle\Service;


use Doctrine\Common\Cache\CacheProvider;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Knp\Component\Pager\Paginator as KnpPaginator;

class ArticleList {

    /** @var EntityManager */
    private $entityManager;
    /**
     * @var KnpPaginator
     */
    private $paginator;
    /**
     * @var Categories
     */
    private $categories;

    public function __construct(
        EntityManager $entityManager,
        Categories $categories,
        KnpPaginator $paginator
    )
    {
        $this->entityManager = $entityManager;
        $this->paginator = $paginator;
        $this->categories = $categories;
    }

    public function getList($page = 1, $category = null)
    {
        $query = $this->getRepository()->getListQuery($this->categories->getCategoryWithChildren($category));
        $pagination = $this->paginator->paginate(
            $query,
            $page,
            5
        );
        return $pagination;
    }

    /**
     * @return \Project\BlogBundle\Repository\Articles
     */
    private function getRepository()
    {
        return $this->entityManager->getRepository('ProjectBlogBundle:Article');
    }
} 