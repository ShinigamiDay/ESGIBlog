<?php

namespace ESGI\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SuggestArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('body')
            ->add('category', 'entity', array(
                'class'    => 'ESGIBlogBundle:Category',
                'property' => 'name',
                'multiple' => false, ))
            ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'esgi_blogbundle_suggestArticle';
    }
}
