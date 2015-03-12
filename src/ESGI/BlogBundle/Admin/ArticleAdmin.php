<?php

namespace ESGI\BlogBundle\Admin;

use ESGI\BlogBundle\Form\ImageType;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

class ArticleAdmin extends Admin
{

    protected $securityContext;
    public function setSecurityContext($securityContext) {
        $this->securityContext = $securityContext;
    }

    // setup the default sort column and order
    protected $datagridValues = array(
        '_sort_order' => 'ASC',
        '_sort_by' => 'title'
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title')
            ->add('body')
            ->add('isPublished')
            ->add('image', "sonata_type_model_list")
            ->add('category', 'entity', array(
                'class'    => 'ESGIBlogBundle:Category',
                'property' => 'name',
                'multiple' => false))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('isPublished')
            ->add('category')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('isPublished', null, array("editable" => true))
        ;
    }

    public function prePersist($article)
    {
        $article->setUser($this->securityContext->getToken()->getUser());
    }

}