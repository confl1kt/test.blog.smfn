<?php

namespace Project\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Article
 * @package Project\BlogBundle\Entity
 * @ORM\Entity(repositoryClass="Project\BlogBundle\Repository\Articles")
 * @ORM\Table(name="blog_articles")
 * @ORM\HasLifecycleCallbacks()
 */
class Article {

    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=1024, nullable=false)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(name="simple_content", type="string", length=65535, nullable=false)
     */
    private $simpleContent;

    /**
     * @var string
     * @ORM\Column(name="content", type="string", length=4294967295, nullable=false)
     */
    private $content;

    /**
     * @var bool
     * @ORM\Column(name="deleted", type="boolean", nullable=false)
     */
    private $deleted = false;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var Category
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="articles")
     * @ORM\JoinTable(name="blog_article_categories",
     *  joinColumns={@ORM\JoinColumn(name="article_id", referencedColumnName="id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")}
     * )
     */
    private $category;

    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        if(is_null($this->createdAt)){
            $this->createdAt = new \DateTime('now');
        }else{
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param boolean $deleted
     * @return $this
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSimpleContent()
    {
        return $this->simpleContent;
    }

    /**
     * @param string $simpleContent
     * @return $this
     */
    public function setSimpleContent($simpleContent)
    {
        $this->simpleContent = $simpleContent;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     * @return $this
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }
}