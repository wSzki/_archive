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

/* @PrestaShop/Admin/Configure/ShopParameters/Blocks/product_preferences_general.html.twig */
class __TwigTemplate_aeff2914e24e186a903925014996b456fb41bd951f03df246df80b394f64f15f extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'product_preferences_general' => [$this, 'block_product_preferences_general'],
            'product_general_preferences_form_rest' => [$this, 'block_product_general_preferences_form_rest'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 27
        $context["ps"] = $this->loadTemplate("@PrestaShop/Admin/macros.html.twig", "@PrestaShop/Admin/Configure/ShopParameters/Blocks/product_preferences_general.html.twig", 27);
        // line 29
        $this->displayBlock('product_preferences_general', $context, $blocks);
    }

    public function block_product_preferences_general($context, array $blocks = [])
    {
        // line 30
        echo "<div class=\"col-xl-10\">
  <div class=\"card\" id=\"configuration_fieldset_products\">
    <h3 class=\"card-header\">
      <i class=\"material-icons\">settings</i>";
        // line 33
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Products (general)", [], "Admin.Shopparameters.Feature"), "html", null, true);
        echo "
    </h3>
    <div class=\"card-block row\">
      <div class=\"card-text\">
        <div class=\"form-group row\">";
        // line 38
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Catalog mode", [], "Admin.Shopparameters.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Catalog mode disables the shopping cart on your store. Visitors will be able to browse your products catalog, but not buy them.", [], "Admin.Shopparameters.Help"));
        echo "
          <div class=\"col-sm\">";
        // line 40
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generalForm"] ?? null), "catalog_mode", []), 'errors');
        // line 41
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generalForm"] ?? null), "catalog_mode", []), 'widget');
        echo "
            <small class=\"form-text\">";
        // line 42
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Have specific needs? Edit particular groups to let them see prices or not.", [], "Admin.Shopparameters.Help"), "html", null, true);
        echo "</small>
          </div>
        </div>
        <div class=\"form-group row catalog-mode-option\">";
        // line 46
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Show prices", [], "Admin.Shopparameters.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Display product prices when in catalog mode.", [], "Admin.Shopparameters.Help"));
        echo "
          <div class=\"col-sm\">";
        // line 48
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generalForm"] ?? null), "catalog_mode_with_prices", []), 'errors');
        // line 49
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generalForm"] ?? null), "catalog_mode_with_prices", []), 'widget');
        echo "
          </div>
        </div>
        <div class=\"form-group row\">
          <label class=\"form-control-label\">";
        // line 54
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Number of days for which the product is considered 'new'", [], "Admin.Shopparameters.Feature"), "html", null, true);
        echo "
          </label>
          <div class=\"col-sm\">";
        // line 57
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generalForm"] ?? null), "new_days_number", []), 'errors');
        // line 58
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generalForm"] ?? null), "new_days_number", []), 'widget');
        echo "
          </div>
        </div>
        <div class=\"form-group row\">";
        // line 62
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Max size of product summary", [], "Admin.Shopparameters.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Set the maximum size of the summary of your product description (in characters).", [], "Admin.Shopparameters.Help"));
        echo "
          <div class=\"col-sm\">";
        // line 64
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generalForm"] ?? null), "short_description_limit", []), 'errors');
        // line 65
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generalForm"] ?? null), "short_description_limit", []), 'widget');
        echo "
          </div>
        </div>
        <div class=\"form-group row\">";
        // line 69
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Quantity discounts based on", [], "Admin.Shopparameters.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("How to calculate quantity discounts.", [], "Admin.Shopparameters.Help"));
        echo "
          <div class=\"col-sm\">";
        // line 71
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generalForm"] ?? null), "quantity_discount", []), 'errors');
        // line 72
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generalForm"] ?? null), "quantity_discount", []), 'widget');
        echo "
          </div>
        </div>
        <div class=\"form-group row\">";
        // line 76
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Force update of friendly URL", [], "Admin.Shopparameters.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("When active, friendly URL will be updated on every save.", [], "Admin.Shopparameters.Help"));
        echo "
          <div class=\"col-sm\">";
        // line 78
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generalForm"] ?? null), "force_friendly_url", []), 'errors');
        // line 79
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generalForm"] ?? null), "force_friendly_url", []), 'widget');
        echo "
          </div>
        </div>
        <div class=\"form-group row\">";
        // line 83
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Default activation status", [], "Admin.Shopparameters.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("When active, new products will be activated by default during creation.", [], "Admin.Shopparameters.Help"));
        echo "
          <div class=\"col-sm\">";
        // line 85
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generalForm"] ?? null), "default_status", []), 'errors');
        // line 86
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generalForm"] ?? null), "default_status", []), 'widget');
        echo "
          </div>
        </div>";
        // line 90
        $this->displayBlock('product_general_preferences_form_rest', $context, $blocks);
        // line 93
        echo "      </div>
    </div>
    <div class=\"card-footer\">
      <div class=\"d-flex justify-content-end\">
        <button class=\"btn btn-primary\">";
        // line 97
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Save", [], "Admin.Actions"), "html", null, true);
        echo "</button>
      </div>
    </div>
  </div>
</div>";
    }

    // line 90
    public function block_product_general_preferences_form_rest($context, array $blocks = [])
    {
        // line 91
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["generalForm"] ?? null), 'rest');
    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Configure/ShopParameters/Blocks/product_preferences_general.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  161 => 91,  158 => 90,  149 => 97,  143 => 93,  141 => 90,  136 => 86,  134 => 85,  130 => 83,  124 => 79,  122 => 78,  118 => 76,  112 => 72,  110 => 71,  106 => 69,  100 => 65,  98 => 64,  94 => 62,  88 => 58,  86 => 57,  81 => 54,  74 => 49,  72 => 48,  68 => 46,  62 => 42,  58 => 41,  56 => 40,  52 => 38,  45 => 33,  40 => 30,  34 => 29,  32 => 27,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@PrestaShop/Admin/Configure/ShopParameters/Blocks/product_preferences_general.html.twig", "/srv/http/presta/src/PrestaShopBundle/Resources/views/Admin/Configure/ShopParameters/Blocks/product_preferences_general.html.twig");
    }
}
