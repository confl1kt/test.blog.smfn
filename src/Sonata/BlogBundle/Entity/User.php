<?php

namespace Sonata\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package Sonata\BlogBundle\Entity\User
 * @ORM\Entity()
 * @ORM\Table(name="fos_user")
 */
class User extends \FOS\UserBundle\Model\User{

    /**
     * @var int
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
} 