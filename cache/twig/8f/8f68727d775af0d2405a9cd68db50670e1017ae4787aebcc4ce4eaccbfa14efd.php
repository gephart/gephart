<?php

/* _framework/error/base.html.twig */
class __TwigTemplate_48dd4b49f5bea4f53dbbc8cb5dc0c62ba667849f4e47904a1f02a5398234088e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'header' => array($this, 'block_header'),
            'main' => array($this, 'block_main'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "
<!doctype html>
<html>
<head>
    <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
    <link href=\"https://fonts.googleapis.com/css?family=Inconsolata:400,700|Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i\" rel=\"stylesheet\">
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: \"Raleway\";
            color: #222;
        }
        code {
            font-family: \"Inconsolata\";
        }
        header {
            text-align: center;
            background: red;
            color: #fff;
            padding: 50px 24px;
            position: relative;
        }
        header:before {
            content: '';
            position: absolute;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background: rgba(0,0,0,.5);
        }
        main {
            padding: 24px;
            max-width: 900px;
            margin: 0 auto;
            overflow: auto;
        }
        h1,h2 {
            position: relative;
        }
        h1 {
            font-size: 42px;
            font-weight: 900;
            margin-bottom: 24px;
        }
        h2 {
            font-weight: 100;
            font-size: 22px
        }
        table {
            border-collapse: collapse;
            border-top: 1px #ddd solid;
            border-left: 1px #ddd solid;
            width: 100%;
            table-layout: fixed;
        }
        td {
            border-right: 1px #ddd solid;
            border-bottom: 1px #ddd solid;
            padding: 5px 10px;
            font-size: 14px;
            word-wrap: break-word;
        }
        code {
            font-family: \"Inconsolata\";
            padding: 12px!important;
            background: #eee!important;
            overflow: auto;
            margin-bottom: 24px;
        }
        .line-number, .line-number * {
            color: #999!important;
            font-style: normal!important;
            font-weight: normal!important;
        }
        .line-number {
            display: inline-block;
            width: 40px;
        }
        .line-problem {
            margin: -1px -12px;
            padding: 1px 12px;
        }
    </style>
</head>
<body>
<header>
    ";
        // line 91
        $this->displayBlock('header', $context, $blocks);
        // line 92
        echo "</header>
<main>
    ";
        // line 94
        $this->displayBlock('main', $context, $blocks);
        // line 95
        echo "</main>

<link rel=\"stylesheet\" href=\"//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.9.0/styles/atom-one-light.min.css\">
<script src=\"//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.9.0/highlight.min.js\"></script>
<script>hljs.initHighlightingOnLoad();</script>

</body>
</html>";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
    }

    // line 91
    public function block_header($context, array $blocks = array())
    {
    }

    // line 94
    public function block_main($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "_framework/error/base.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  146 => 94,  141 => 91,  136 => 5,  125 => 95,  123 => 94,  119 => 92,  117 => 91,  28 => 5,  22 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "_framework/error/base.html.twig", "/Applications/XAMPP/xamppfiles/htdocs/gephard/gephart-generator-edition/template/_framework/error/base.html.twig");
    }
}
