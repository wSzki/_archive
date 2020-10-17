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

/* @PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/index.html.twig */
class __TwigTemplate_d34b3b5036b4f460678bd7584a13a77f082b60d4f4f323a9274c95a87854a141 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        // line 26
        $this->parent = $this->loadTemplate("@PrestaShop/Admin/layout.html.twig", "@PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/index.html.twig", 26);
        $this->blocks = [
            'content' => [$this, 'block_content'],
            'meta_form_rest' => [$this, 'block_meta_form_rest'],
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doGetParent(array $context)
    {
        return "@PrestaShop/Admin/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 29
    public function block_content($context, array $blocks = [])
    {
        // line 30
        echo "  <div class=\"row\">
    <div class=\"col-sm\">";
        // line 32
        $this->loadTemplate("@PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/Blocks/meta_showcase_card.html.twig", "@PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/index.html.twig", 32)->display($context);
        // line 33
        echo "    </div>
  </div>";
        // line 35
        if ( !($context["isGridDisplayed"] ?? null)) {
            // line 36
            echo "      <div class=\"row\">
        <div class=\"col-sm\">
          <div class=\"alert alert-info\" role=\"alert\">
            <div class=\"alert-text\">";
            // line 40
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("You can only display the page list in a shop context.", [], "Admin.Shopparameters.Notification"), "html", null, true);
            echo "
            </div>
          </div>
        </div>
      </div>";
        } else {
            // line 46
            echo "      <div class=\"row\">
        <div class=\"col\">";
            // line 48
            $this->loadTemplate("@PrestaShop/Admin/Common/Grid/grid_panel.html.twig", "@PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/index.html.twig", 48)->display(twig_array_merge($context, ["grid" => ($context["grid"] ?? null)]));
            // line 49
            echo "        </div>
      </div>";
        }
        // line 52
        echo "
  <div class=\"row justify-content-center\">
      <div class=\"col\">";
        // line 55
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["metaForm"] ?? null), 'form_start', ["action" => $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("admin_metas_save_options")]);
        // line 56
        $this->loadTemplate("@PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/Blocks/set_up_urls_configuration.html.twig", "@PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/index.html.twig", 56)->display($context);
        // line 57
        $this->loadTemplate("@PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/Blocks/shop_urls_configuration.html.twig", "@PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/index.html.twig", 57)->display($context);
        // line 58
        $this->loadTemplate("@PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/Blocks/domain_name_management.html.twig", "@PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/index.html.twig", 58)->display($context);
        // line 59
        $this->loadTemplate("@PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/Blocks/url_schema_configuration.html.twig", "@PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/index.html.twig", 59)->display($context);
        // line 60
        $this->loadTemplate("@PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/Blocks/seo_options_configuration.html.twig", "@PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/index.html.twig", 60)->display($context);
        // line 62
        $this->displayBlock('meta_form_rest', $context, $blocks);
        // line 66
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["metaForm"] ?? null), 'form_end');
        // line 68
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["robotsForm"] ?? null), 'form_start', ["action" => $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("admin_metas_generate_robots_text_file")]);
        // line 69
        $this->loadTemplate("@PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/Blocks/robots_file_generation.html.twig", "@PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/index.html.twig", 69)->display($context);
        // line 70
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["robotsForm"] ?? null), 'rest');
        // line 71
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["robotsForm"] ?? null), 'form_end');
        echo "
      </div>
  </div>";
    }

    // line 62
    public function block_meta_form_rest($context, array $blocks = [])
    {
        // line 63
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["metaForm"] ?? null), 'rest');
    }

    // line 77
    public function block_javascripts($context, array $blocks = [])
    {
        // line 78
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
  <script src=\"";
        // line 79
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("themes/new-theme/public/meta.bundle.js"), "html", null, true);
        echo "\"></script>
  <script src=\"";
        // line 80
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("themes/default/js/bundle/pagination.js"), "html", null, true);
        echo "\"></script>";
    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  127 => 80,  123 => 79,  119 => 78,  116 => 77,  112 => 63,  109 => 62,  102 => 71,  100 => 70,  98 => 69,  96 => 68,  94 => 66,  92 => 62,  90 => 60,  88 => 59,  86 => 58,  84 => 57,  82 => 56,  80 => 55,  76 => 52,  72 => 49,  70 => 48,  67 => 46,  59 => 40,  54 => 36,  52 => 35,  49 => 33,  47 => 32,  44 => 30,  41 => 29,  22 => 26,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/index.html.twig", "/srv/http/presta/src/PrestaShopBundle/Resources/views/Admin/Configure/ShopParameters/TrafficSeo/Meta/index.html.twig");
    }
}
