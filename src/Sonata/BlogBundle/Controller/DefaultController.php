<?php

namespace Sonata\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SonataBlogBundle:Default:index.html.twig', array('name' => $name));
    }
}
