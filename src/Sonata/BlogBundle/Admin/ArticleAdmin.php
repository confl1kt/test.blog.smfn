<?php

namespace Sonata\BlogBundle\Admin;


use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Knp\Menu\ItemInterface as MenuItemInterface;
class ArticleAdmin extends Admin{


    protected $baseRouteName = 'article';
    protected $baseRoutePattern = 'article';

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id', null, array('label' => 'Идентификатор'))
            ->add('title', null, array('label' => 'Заголовок'))
            ->add('simpleContent', null, array('label' => 'Анонс'))
            ->add('content', null, array('label' => 'Текст'))
            ->add('createdAt', null, array('label' => 'Дата публикации'));
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('title', null, array(
                    'label' => 'Заголовок',
                ))
                ->add('simpleContent', 'textarea', array(
                    'label' => 'Анонс'
                ))
                ->add('content', 'textarea', array(
                    'label' => 'Текст'
                ))
            ->end()
            ->with('Categories')
                ->add('category', 'sonata_type_model', array(
                    'label' => 'Категория',
                    'required' => false,
                    'expanded' => true,
                    'multiple' => true
                ))
            ->end();
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->addIdentifier('title', null, array('label' => 'Заголовок'))
            ->add('createdAt', null, array('label' => 'Дата публикации'))
            ->add('category', null, array('label' => 'Категория'));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title', null, array('label' => 'Заголовок'));
    }

    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = NULL)
    {
        /*$menu->addChild(
            $action == 'edit' ? 'Просмотр' : 'Редактирование',
            array('uri' => $this->generateUrl(
                $action == 'edit' ? 'show' : 'edit', array('id' => $this->getRequest()->get('id'))))
        );*/
    }

} 