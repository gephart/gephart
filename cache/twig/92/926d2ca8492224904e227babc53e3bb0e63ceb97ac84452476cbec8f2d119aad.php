<?php

/* _framework/assets/css/main.css */
class __TwigTemplate_e0a0d9ee435b2af04d595ce6d1794e2cee278ff8ba4dd630f4d0d848fc8ad010 extends Twig_Template
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
        echo "._gf-line, ._gf-line * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}
._gf-line {
    position: fixed;
    left: 0;
    bottom: 0;
    width:100%;
    background: rgba(20,20,20,.95);
    background: linear-gradient(#333, #111);
    padding: 0 10px;
    height: 32px;
    color: #fff;
    font-family: -apple-system, system-ui, BlinkMacSystemFont, \"Segoe UI\", \"Roboto\", \"Helvetica Neue\", Arial, sans-serif;
    font-weight: 300;
    font-size: 12px;
}

._gf-line__logo {
    height: 22px;
    width: auto;
    margin: 5px 10px 5px 0;
}

._gf-line__ico {
    height: 14px;
    position: relative;
    top: 8px;
    width: auto;
    float: left;
    margin-right: 6px;
}

._gf-line__logo, ._gf-line__box {
    float: left;
}

._gf-line__box--hand {
    cursor: pointer;
}

._gf-line__box--hover:hover {
    background: #333;
}

._gf-line__box__hover {
    position: absolute;
    bottom: 100%;
    right: -1px;
    background: #333;
    padding: 10px;
    overflow: auto;
    display: none;
}

._gf-line__box--hover:hover ._gf-line__box__hover {
    display: block;
}

._gf-line__box__hover a {
    color: #fff;
    text-decoration: underline;
}

._gf-line table {
    border-top: 1px #999 solid;
    border-left: 1px #999 solid;
    border-spacing: 0;
    table-layout: auto;
    color: #fff;
}

._gf-line th,
._gf-line td {
    border-right: 1px #999 solid;
    border-bottom: 1px #999 solid;
    padding: 5px 10px;
    text-align: left;
}

._gf-line__box {
    position: relative;
    border-left: 1px #333 solid;
    height: 32px;
    padding: 0 10px;
}

._gf-line__box__title {
    line-height: 32px;
}";
    }

    public function getTemplateName()
    {
        return "_framework/assets/css/main.css";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "_framework/assets/css/main.css", "/Applications/XAMPP/xamppfiles/htdocs/gephard/gephart-generator-edition/template/_framework/assets/css/main.css");
    }
}
