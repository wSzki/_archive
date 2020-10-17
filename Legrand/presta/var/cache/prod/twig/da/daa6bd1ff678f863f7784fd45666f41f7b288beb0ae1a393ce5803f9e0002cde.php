<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* @PrestaShop/Admin/Common/Grid/Columns/Header/Content/default.html.twig */
class __TwigTemplate_da1bfd5f79017ecc896caedd2892cc8aa28a30854dcdf156c7bf12567107b11b extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 26
        $context["ps"] = $this->loadTemplate("@PrestaShop/Admin/macros.html.twig", "@PrestaShop/Admin/Common/Grid/Columns/Header/Content/default.html.twig", 26);
        // line 28
        list($context["orderBy"], $context["orderWay"]) =         [$this->getAttribute($this->getAttribute(($context["grid"] ?? null), "sorting", []), "order_by", []), $this->getAttribute($this->getAttribute(($context["grid"] ?? null), "sorting", []), "order_way", [])];
        // line 30
        if ((($this->getAttribute($this->getAttribute(($context["column"] ?? null), "options", [], "any", false, true), "sortable", [], "any", true, true) && $this->getAttribute($this->getAttribute(($context["column"] ?? null), "options", []), "sortable", [])) && ($this->getAttribute($this->getAttribute(($context["grid"] ?? null), "data", []), "records_total", []) > 0))) {
            // line 31
            echo $context["ps"]->getsortable_column_header($this->getAttribute(($context["column"] ?? null), "name", []), $this->getAttribute(($context["column"] ?? null), "id", []), ($context["orderBy"] ?? null), ($context["orderWay"] ?? null), $this->getAttribute(($context["grid"] ?? null), "form_prefix", []));
        } else {
            // line 33
            echo twig_escape_filter($this->env, $this->getAttribute(($context["column"] ?? null), "name", []), "html", null, true);
        }
    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Common/Grid/Columns/Header/Content/default.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 33,  36 => 31,  34 => 30,  32 => 28,  30 => 26,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@PrestaShop/Admin/Common/Grid/Columns/Header/Content/default.html.twig", "/srv/http/presta/src/PrestaShopBundle/Resources/views/Admin/Common/Grid/Columns/Header/Content/default.html.twig");
    }
}
