<?php

/* _framework/error/exception.html.twig */
class __TwigTemplate_f88a781afdf786e762f615e9fd99f1f4ba643ddfb0afd28bf23d35e2d75c4df8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("_framework/error/base.html.twig", "_framework/error/exception.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'header' => array($this, 'block_header'),
            'main' => array($this, 'block_main'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "_framework/error/base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        echo twig_escape_filter($this->env, ($context["type"] ?? null), "html", null, true);
        echo ": ";
        echo twig_escape_filter($this->env, ($context["errstr"] ?? null), "html", null, true);
        echo "
";
    }

    // line 7
    public function block_header($context, array $blocks = array())
    {
        // line 8
        echo "    <h1>";
        echo twig_escape_filter($this->env, ($context["type"] ?? null), "html", null, true);
        echo ": ";
        echo twig_escape_filter($this->env, ($context["errstr"] ?? null), "html", null, true);
        echo "</h1>
    <h2>";
        // line 9
        echo twig_escape_filter($this->env, ($context["errfile"] ?? null), "html", null, true);
        echo " at line <b>";
        echo twig_escape_filter($this->env, ($context["errline"] ?? null), "html", null, true);
        echo "</b></h2>
";
    }

    // line 12
    public function block_main($context, array $blocks = array())
    {
        // line 13
        echo "    ";
        $this->loadTemplate("_framework/error/blocks/file.html.twig", "_framework/error/exception.html.twig", 13)->display($context);
        // line 14
        echo "    ";
        $this->loadTemplate("_framework/error/blocks/trace.html.twig", "_framework/error/exception.html.twig", 14)->display($context);
    }

    public function getTemplateName()
    {
        return "_framework/error/exception.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  66 => 14,  63 => 13,  60 => 12,  52 => 9,  45 => 8,  42 => 7,  33 => 4,  30 => 3,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "_framework/error/exception.html.twig", "/Applications/XAMPP/xamppfiles/htdocs/gephard/gephart-generator-edition/template/_framework/error/exception.html.twig");
    }
}
