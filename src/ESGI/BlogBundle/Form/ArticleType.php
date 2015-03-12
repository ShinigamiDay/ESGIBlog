<?php

namespace ESGI\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('body')
            ->add('isPublished',  'checkbox', array(  'label'  => 'Publier'))
            ->add('image', new ImageType())
            ->add('isCommented', 'checkbox', array(  'label'  => 'Autorisé les commentaires'))
            ->add('category', 'entity', array(
                                                'class'    => 'ESGIBlogBundle:Category',
                                                'property' => 'name',
                                                'multiple' => false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ESGI\BlogBundle\Entity\Article',
            'intention' => 'task_contenthsh'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'esgi_blogbundle_article';
    }
}
