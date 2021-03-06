<?php

namespace ESGI\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UserAdmin extends Admin
{
    protected $securityContext;
    public function setSecurityContext($securityContext)
    {
        $this->securityContext = $securityContext;
    }

    // setup the default sort column and order
    protected $datagridValues = array(
        '_sort_order' => 'ASC',
        '_sort_by' => 'title',
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('username')
            ->add('email', 'email')
            ->add('password', 'password')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('username')
            ->add('email')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('username')
            ->add('email')
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

            $actions['deleteNeverActivated'] = array(
                'label'            => 'Delete never activated jobs',
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
            $this->get('session')->setFlash('sonata_flash_success',  sprintf('%d never activated jobs have been deleted successfully.', $nb));
        } else {
            $this->get('session')->setFlash('sonata_flash_info',  'No job to delete.');
        }

        return new RedirectResponse($this->admin->generateUrl('list', $this->admin->getFilterParameters()));
    }
}
