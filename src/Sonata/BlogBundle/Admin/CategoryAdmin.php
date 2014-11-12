<?php

namespace Sonata\BlogBundle\Admin;


use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Knp\Menu\ItemInterface as MenuItemInterface;
class CategoryAdmin extends Admin{


    protected $baseRouteName = 'category';
    protected $baseRoutePattern = 'category';

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id', null, array('label' => 'Идентификатор'))
            ->add('parent', null, array('label' => 'Заголовок'))
            ->add('name', null, array('label' => 'Анонс'));
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('parent', null, array('label' => 'Заголовок'))
                ->add('name', null, array('label' => 'Анонс'))
            ->end();
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->addIdentifier('parent', null, array('label' => 'Родитель'))
            ->add('name', null, array('label' => 'Название'));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, array('label' => 'Заголовок'));
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