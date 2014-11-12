<?php

namespace Project\BlogBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{

    public function indexAction()
    {
        return $this->redirect($this->generateUrl('project_blog_list',['page' => 1]));
    }

    public function viewAction($id)
    {
        $article = $this->container->get('doctrine.orm.default_entity_manager')
            ->getRepository('ProjectBlogBundle:Article')
            ->find($id);
        return $this->render('ProjectBlogBundle:Article:view.html.twig', array('article' => $article));
    }

    public function listAction($category = null, $page = 1)
    {
        /** @var \Project\BlogBundle\Service\ArticleList $service */
        $service  = $this->get('project_blog.blog.list');
        $pagination = $service->getList($page, $category);
        return $this->render('ProjectBlogBundle:Article:list.html.twig', array('pagination' => $pagination));
    }
}