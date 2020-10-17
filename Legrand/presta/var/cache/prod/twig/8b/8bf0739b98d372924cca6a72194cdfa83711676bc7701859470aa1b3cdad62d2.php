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

/* @PrestaShop/Admin/Common/Grid/grid_panel.html.twig */
class __TwigTemplate_ac03fdb155bc8f1375ae0bbad444d977aee367f39699c159efef38237f50997b extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'grid_panel_header' => [$this, 'block_grid_panel_header'],
            'grid_actions_block' => [$this, 'block_grid_actions_block'],
            'grid_panel_body' => [$this, 'block_grid_panel_body'],
            'grid_view_block' => [$this, 'block_grid_view_block'],
            'grid_panel_footer' => [$this, 'block_grid_panel_footer'],
            'grid_panel_extra_content' => [$this, 'block_grid_panel_extra_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 25
        echo "
<div class=\"card js-grid-panel\" id=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->getAttribute(($context["grid"] ?? null), "id", []), "html", null, true);
        echo "_grid_panel\">";
        // line 27
        $this->displayBlock('grid_panel_header', $context, $blocks);
        // line 40
        $this->displayBlock('grid_panel_body', $context, $blocks);
        // line 48
        $this->displayBlock('grid_panel_footer', $context, $blocks);
        // line 49
        echo "</div>";
        // line 51
        $this->displayBlock('grid_panel_extra_content', $context, $blocks);
    }

    // line 27
    public function block_grid_panel_header($context, array $blocks = [])
    {
        // line 28
        echo "    <div class=\"card-header js-grid-header\">
      <h3 class=\"d-inline-block card-header-title\">";
        // line 30
        echo twig_escape_filter($this->env, $this->getAttribute(($context["grid"] ?? null), "name", []), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["grid"] ?? null), "data", []), "records_total", []), "html", null, true);
        echo ")
      </h3>";
        // line 32
        $this->displayBlock('grid_actions_block', $context, $blocks);
        // line 37
        echo "    </div>";
    }

    // line 32
    public function block_grid_actions_block($context, array $blocks = [])
    {
        // line 33
        echo "        <div class=\"d-inline-block float-right\">";
        // line 34
        echo twig_include($this->env, $context, "@PrestaShop/Admin/Common/Grid/Blocks/grid_actions.html.twig", ["grid" => ($context["grid"] ?? null)]);
        echo "
        </div>";
    }

    // line 40
    public function block_grid_panel_body($context, array $blocks = [])
    {
        // line 41
        echo "    <div class=\"card-body\">";
        // line 42
        $this->displayBlock('grid_view_block', $context, $blocks);
        // line 45
        echo "    </div>";
    }

    // line 42
    public function block_grid_view_block($context, array $blocks = [])
    {
        // line 43
        echo twig_include($this->env, $context, "@PrestaShop/Admin/Common/Grid/grid.html.twig", ["grid" => ($context["grid"] ?? null)]);
    }

    // line 48
    public function block_grid_panel_footer($context, array $blocks = [])
    {
    }

    // line 51
    public function block_grid_panel_extra_content($context, array $blocks = [])
    {
    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Common/Grid/grid_panel.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  106 => 51,  101 => 48,  97 => 43,  94 => 42,  90 => 45,  88 => 42,  86 => 41,  83 => 40,  77 => 34,  75 => 33,  72 => 32,  68 => 37,  66 => 32,  60 => 30,  57 => 28,  54 => 27,  50 => 51,  48 => 49,  46 => 48,  44 => 40,  42 => 27,  39 => 26,  36 => 25,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@PrestaShop/Admin/Common/Grid/grid_panel.html.twig", "/srv/http/presta/src/PrestaShopBundle/Resources/views/Admin/Common/Grid/grid_panel.html.twig");
    }
}
