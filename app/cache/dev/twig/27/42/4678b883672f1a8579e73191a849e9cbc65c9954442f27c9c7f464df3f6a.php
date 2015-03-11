<?php

/* ESGIBlogBundle:Article:form.html.twig */
class __TwigTemplate_27424678b883672f1a8579e73191a849e9cbc65c9954442f27c9c7f464df3f6a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->env->getExtension('form')->renderer->setTheme((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), array(0 => "bootstrap_3_layout.html.twig"));
        // line 2
        echo "<h3>";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Formulaire Contenu"), "html", null, true);
        echo "</h3>

";
        // line 5
        echo "<div class=\"\">
    <form method=\"post\" role=\"form\" ";
        // line 6
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
        echo " >
        ";
        // line 8
        echo "
        ";
        // line 10
        echo "        ";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
        echo "
        <br>
        <input type=\"submit\" class=\"btn btn-success\" />
    </form>
</div>";
    }

    public function getTemplateName()
    {
        return "ESGIBlogBundle:Article:form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  37 => 10,  34 => 8,  30 => 6,  27 => 5,  21 => 2,  19 => 1,);
    }
}
