<?php

namespace ESGI\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class CommentAdmin extends Admin
{

    // setup the default sort column and order
    protected $datagridValues = array(
        '_sort_order' => 'ASC',
        '_sort_by' => 'title',
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('content')
            ->add('article', 'entity', array(
                'class'    => 'ESGIBlogBundle:Article',
                'property' => 'title',
                'multiple' => false, ))
            ->add('user', 'entity', array(
                'class'    => 'ESGIUserBundle:User',
                'property' => 'username',
                'multiple' => false, ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('article')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('content')
            ->add('article')
        ;
    }

    public function getBatchActions()
    {
        // retrieve the default (currently only the delete action) actions
        $actions = parent::getBatchActions();

        // check user permissions
        if ($this->hasRoute('edit') && $this->isGranted('EDIT') && $this->hasRoute('delete') && $this->isGranted('DELETE')) {
            $actions['extend'] = array(
                'label'            => 'Extend',
                'ask_confirmation' => true, // If true, a confirmation will be asked before performing the action
            );
        }

        return $actions;
    }

    public function batchActionDeleteNeverActivatedIsRelevant()
    {
        return true;
    }

    public function batchActionDeleteNeverActivated()
    {
        if ($this->admin->isGranted('EDIT') === false || $this->admin->isGranted('DELETE') === false) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getEntityManager();
        $nb = $em->getRepository('EnsJobeetBundle:Job')->cleanup(60);

        if ($nb) {
            $this->get('session')->setFlash('sonata_flash_success',  sprintf('%d never activated comment have been deleted successfully.', $nb));
        } else {
            $this->get('session')->setFlash('sonata_flash_info',  'No comment to delete.');
        }

        return new RedirectResponse($this->admin->generateUrl('list', $this->admin->getFilterParameters()));
    }
}
