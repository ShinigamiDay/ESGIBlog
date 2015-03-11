<?php

/* ESGIBlogBundle:Article:add.html.twig */
class __TwigTemplate_4cceb8c85cb980a8d1b474684bea28e6f5fa3a3804f78de1b85218dcec649a72 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("ESGIBlogBundle::layout.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(1);

            throw $e;
        }

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'blog_body' => array($this, 'block_blog_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "ESGIBlogBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo $this->env->getExtension('translator')->getTranslator()->trans("Ajouter un article", array(), "messages");
    }

    // line 5
    public function block_blog_body($context, array $blocks = array())
    {
        // line 6
        echo "<h1>Welcome to the Article:add page</h1>
    ";
        // line 7
        $this->env->loadTemplate("ESGIBlogBundle:Article:form.html.twig")->display($context);
        // line 8
        echo "
";
    }

    public function getTemplateName()
    {
        return "ESGIBlogBundle:Article:add.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 8,  49 => 7,  46 => 6,  43 => 5,  37 => 3,  11 => 1,);
    }
}
