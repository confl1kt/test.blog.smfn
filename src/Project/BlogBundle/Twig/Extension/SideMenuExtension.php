<?php

namespace Project\BlogBundle\Twig\Extension;


use Project\BlogBundle\Service\Categories;
use Twig_Environment;
use Twig_Extension;

class SideMenuExtension extends Twig_Extension{

    /**
     * @var Twig_Environment
     */
    protected $environment;
    /**
     * @var Categories
     */
    private $categoryService;

    public function __construct(Categories $categoryService)
    {

        $this->categoryService = $categoryService;
    }

    /**
     * {@inheritDoc}
     */
    public function initRuntime(Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            'blog_render_side_menu' => new \Twig_Function_Method($this, 'render', array('is_safe' => array('html'))),
        );
    }

    /**
     * Renders the pagination template
     *
     *
     * @return string
     */
    public function render()
    {
        return $this->environment->render('ProjectBlogBundle:Extension:side-menu.html.twig',[
            'categories' => $this->categoryService->getCategories()
        ]);
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return 'blog_side_menu';
    }
}