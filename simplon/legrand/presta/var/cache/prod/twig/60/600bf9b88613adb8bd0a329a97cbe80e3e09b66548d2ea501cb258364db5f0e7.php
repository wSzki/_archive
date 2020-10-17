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

/* @PrestaShop/Admin/Common/Grid/Blocks/bulk_actions_select_all.html.twig */
class __TwigTemplate_73c386b54fe6f954966f984f4c3942314c5503a9f13518421f8c3d4c02595165 extends \Twig\Template
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
        if (((twig_length_filter($this->env, $this->getAttribute($this->getAttribute(($context["grid"] ?? null), "actions", []), "bulk", [])) > 0) && ($this->getAttribute($this->getAttribute(($context["grid"] ?? null), "data", []), "records_total", []) > 0))) {
            // line 27
            echo "  <div class=\"md-checkbox mt-3\">
    <label>
      <input type=\"checkbox\"
             class=\"js-bulk-action-select-all\"
             id=\"";
            // line 31
            echo twig_escape_filter($this->env, $this->getAttribute(($context["grid"] ?? null), "id", []), "html", null, true);
            echo "_grid_bulk_action_select_all\"
      >
      <i class=\"md-checkbox-control\"></i>";
            // line 34
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Select all", [], "Admin.Actions"), "html", null, true);
            echo "
    </label>
  </div>";
        }
    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Common/Grid/Blocks/bulk_actions_select_all.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 34,  38 => 31,  32 => 27,  30 => 26,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@PrestaShop/Admin/Common/Grid/Blocks/bulk_actions_select_all.html.twig", "/srv/http/presta/src/PrestaShopBundle/Resources/views/Admin/Common/Grid/Blocks/bulk_actions_select_all.html.twig");
    }
}
