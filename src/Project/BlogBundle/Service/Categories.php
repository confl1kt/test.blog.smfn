<?php

namespace Project\BlogBundle\Service;


use Doctrine\Common\Cache\CacheProvider;
use Doctrine\ORM\EntityManager;

class Categories {

    const CATEGORY_ALIAS_LIST = 'category_alias_list';
    const CATEGORY_ID_TREE = 'category_id_tree';

    /** @var EntityManager */
    private $entityManager;
    /** @var CacheProvider */
    private $cache;

    public function __construct(EntityManager $entityManager, CacheProvider $cache)
    {
        $this->entityManager = $entityManager;
        $this->cache = $cache;
    }

    public function getCategories()
    {
        return $this->getRepository()->getCategories();
    }

    public function getCategoryWithChildren($category = null)
    {
        if(is_null($category)){
            return null;
        }
        $id = $this->getCategoryId($category);
        $childs = $this->getChilds($id);
        return $childs;
    }

    private function getCategoryId($alias)
    {
        if(!$this->cache->contains(self::CATEGORY_ALIAS_LIST)){
            $categories = $this->getCategories();
            $resultMap = [];
            foreach($categories as $category){
                $resultMap[$category->getAlias()] = $category->getId();
            }
            $this->cache->save(self::CATEGORY_ALIAS_LIST,$resultMap);
        }else{
            $resultMap = $this->cache->fetch(self::CATEGORY_ALIAS_LIST);
        }

        return $resultMap[$alias];
    }

    private function getChilds($id)
    {
        if(!$this->cache->contains(self::CATEGORY_ID_TREE)){
            $categories = $this->getCategories();
            $resultMap = [];
            foreach($categories as $category){
                if($category->getParent()){
                    $resultMap[$category->getParent()->getId()][] = $category->getId();
                }else{
                    $resultMap[0][] = $category->getId();
                }
                if(!isset($resultMap[$category->getId()])){
                    $resultMap[$category->getId()] = [];
                }
            }
            $this->cache->save(self::CATEGORY_ID_TREE,$resultMap);
        }else{
            $resultMap = $this->cache->fetch(self::CATEGORY_ID_TREE);
        }

        return $this->dfs($id, $resultMap, 0);
    }

    private function dfs($searchedValue, $map, $currentNode = null, $getValue = false)
    {
        if($currentNode == $searchedValue){
            $getValue = true;
        }
        $result = [];
        if($getValue){
            $result[] = $currentNode;
        }
        $currentMap = $map[$currentNode];
        foreach($currentMap as $key => $node){
            $array = $this->dfs($searchedValue, $map, $node, $getValue);
            $result = array_merge($result, $array);
        }

        return $result;
    }

    /**
     * @return \Project\BlogBundle\Repository\Categories
     */
    private function getRepository()
    {
        return $this->entityManager->getRepository('ProjectBlogBundle:Category');
    }
} 