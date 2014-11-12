<?php

namespace Project\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Category
 * @package Project\BlogBundle\Entity
 * @ORM\Entity(repositoryClass="Project\BlogBundle\Repository\Categories")
 * @ORM\Table(name="blog_categories")
 */
class Category {

    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Category
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="subCategories")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=1024, nullable=false)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="alias", type="string", length=64, nullable=false)
     */
    private $alias;

    /**
     * @var Category[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     */
    private $subCategories;

    /**
     * @var Article[]
     * @ORM\ManyToMany(targetEntity="Article", mappedBy="category")
     */
    private $articles;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function __construct()
    {
        $this->subCategories = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Category
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param Category $parent
     * @return $this
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return ArrayCollection|Category[]
     */
    public function getSubCategories()
    {
        return $this->subCategories;
    }

    /**
     * @param ArrayCollection|Category[] $subCategories
     * @return $this
     */
    public function setSubCategories($subCategories)
    {
        $this->subCategories = $subCategories;
        return $this;
    }

    function __toString()
    {
        return $this->getName();
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     * @return $this
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
        return $this;
    }
}