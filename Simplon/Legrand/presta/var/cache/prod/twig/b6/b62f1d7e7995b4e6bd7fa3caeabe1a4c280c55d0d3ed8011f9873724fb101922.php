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

/* @PrestaShop/Admin/Module/Includes/menu_top.html.twig */
class __TwigTemplate_1e9e58469ae155ad462069d7c750929a6d3243c41a9f95efdf888d3a3a796c95 extends \Twig\Template
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
        // line 25
        echo "<div class=\"module-top-menu\">
  <div class=\"row\">
    <div class=\"col-md-8\">
      <div class=\"input-group\" id=\"search-input-group\">
        <input type=\"text\" id=\"module-search-bar\" class=\"form-control\">
        <div class=\"input-group-append\">
          <button class=\"btn btn-primary float-right search-button\" id=\"module-search-button\">
            <i class=\"material-icons\">search</i>
          </button>
        </div>
      </div>
    </div>
    <div class=\"col-md-4 module-menu-item\">
    </div>
  </div>

  <div class=\"row\">";
        // line 42
        if ((isset($context["topMenuData"]) || array_key_exists("topMenuData", $context))) {
            // line 43
            echo "      <div class=\"col-md-4 module-top-menu-item\">
        <h3>";
            // line 44
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Category", [], "Admin.Catalog.Feature"), "html", null, true);
            echo "</h3>";
            // line 45
            $this->loadTemplate("@PrestaShop/Admin/Module/Includes/dropdown_categories.html.twig", "@PrestaShop/Admin/Module/Includes/menu_top.html.twig", 45)->display(twig_array_merge($context, ["topMenuData" => ($context["topMenuData"] ?? null)]));
            // line 46
            echo "      </div>";
        }
        // line 49
        if (((isset($context["requireFilterStatus"]) || array_key_exists("requireFilterStatus", $context)) && (($context["requireFilterStatus"] ?? null) == true))) {
            // line 50
            echo "      <div class=\"col-md-4 module-top-menu-item\">
        <h3>";
            // line 51
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Status", [], "Admin.Global"), "html", null, true);
            echo "</h3>";
            // line 52
            $this->loadTemplate("@PrestaShop/Admin/Module/Includes/dropdown_status.html.twig", "@PrestaShop/Admin/Module/Includes/menu_top.html.twig", 52)->display($context);
            // line 53
            echo "      </div>";
        }
        // line 56
        if (((($context["level"] ?? null) > twig_constant("PrestaShopBundle\\Security\\Voter\\PageVoter::LEVEL_UPDATE")) && (isset($context["bulkActions"]) || array_key_exists("bulkActions", $context)))) {
            // line 57
            echo "      <div class=\"col-md-4 module-top-menu-item disabled\">
        <h3>";
            // line 58
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Bulk Actions", [], "Admin.Global"), "html", null, true);
            echo "</h3>";
            // line 59
            $this->loadTemplate("@PrestaShop/Admin/Module/Includes/dropdown_bulk.html.twig", "@PrestaShop/Admin/Module/Includes/menu_top.html.twig", 59)->display($context);
            // line 60
            echo "      </div>";
        }
        // line 62
        echo "  </div>
</div>

<hr class=\"top-menu-separator\"/>";
        // line 67
        $context["js_translatable"] = twig_array_merge(["Search - placeholder" => $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Search modules: keyword, name, author...", [], "Admin.Modules.Help")],         // line 69
($context["js_translatable"] ?? null));
    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Module/Includes/menu_top.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 69,  92 => 67,  87 => 62,  84 => 60,  82 => 59,  79 => 58,  76 => 57,  74 => 56,  71 => 53,  69 => 52,  66 => 51,  63 => 50,  61 => 49,  58 => 46,  56 => 45,  53 => 44,  50 => 43,  48 => 42,  30 => 25,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@PrestaShop/Admin/Module/Includes/menu_top.html.twig", "/srv/http/presta/src/PrestaShopBundle/Resources/views/Admin/Module/Includes/menu_top.html.twig");
    }
}
