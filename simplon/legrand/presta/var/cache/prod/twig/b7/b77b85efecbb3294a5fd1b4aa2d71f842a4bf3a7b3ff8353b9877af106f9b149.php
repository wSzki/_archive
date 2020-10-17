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

/* @PrestaShop/Admin/Common/Grid/Blocks/Table/filters_row.html.twig */
class __TwigTemplate_87f9a7a016d6e9fd14e222a4cc5f31c003033361206982a25641c688094dae99 extends \Twig\Template
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
        if ((twig_length_filter($this->env, $this->getAttribute(($context["grid"] ?? null), "filter_form", [])) > 1)) {
            // line 27
            echo "  <tr class=\"column-filters";
            if (((0 == $this->getAttribute($this->getAttribute(($context["grid"] ?? null), "data", []), "records_total", [])) && twig_test_empty($this->getAttribute(($context["grid"] ?? null), "filters", [])))) {
                echo "d-none";
            }
            echo "\">";
            // line 28
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["grid"] ?? null), "columns", []));
            foreach ($context['_seq'] as $context["_key"] => $context["column"]) {
                // line 29
                echo "      <td>";
                // line 30
                if ($this->getAttribute($this->getAttribute(($context["grid"] ?? null), "column_filters", [], "any", false, true), $this->getAttribute($context["column"], "id", []), [], "array", true, true)) {
                    // line 31
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute(($context["grid"] ?? null), "column_filters", []), $this->getAttribute($context["column"], "id", []), [], "array"));
                    foreach ($context['_seq'] as $context["_key"] => $context["filter_name"]) {
                        // line 32
                        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute($this->getAttribute(($context["grid"] ?? null), "filter_form", []), $context["filter_name"], [], "array"), 'widget');
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['filter_name'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                }
                // line 35
                echo "      </td>";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['column'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 37
            echo "  </tr>";
        }
    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Common/Grid/Blocks/Table/filters_row.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  63 => 37,  57 => 35,  50 => 32,  46 => 31,  44 => 30,  42 => 29,  38 => 28,  32 => 27,  30 => 26,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@PrestaShop/Admin/Common/Grid/Blocks/Table/filters_row.html.twig", "/srv/http/presta/src/PrestaShopBundle/Resources/views/Admin/Common/Grid/Blocks/Table/filters_row.html.twig");
    }
}
