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

/* @PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/Blocks/url_schema_configuration.html.twig */
class __TwigTemplate_5f35c9ef7e0a5aef347de46a5e0b2b6fb3a765f4246f9cc380248d45a576634e extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'url_schema_configuration' => [$this, 'block_url_schema_configuration'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 28
        $context["urlSchemaForm"] = $this->getAttribute(($context["metaForm"] ?? null), "url_schema", []);
        // line 30
        $this->displayBlock('url_schema_configuration', $context, $blocks);
    }

    public function block_url_schema_configuration($context, array $blocks = [])
    {
        // line 31
        if ( !twig_test_empty($this->getAttribute(($context["urlSchemaForm"] ?? null), "children", []))) {
            // line 32
            echo "    <div class=\"card\">
      <h3 class=\"card-header\">
        <i class=\"material-icons\">settings</i>";
            // line 34
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Schema of URLs", [], "Admin.Shopparameters.Feature"), "html", null, true);
            echo "
      </h3>
      <div class=\"card-block row\">
        <div class=\"card-text\">
          <div class=\"row\">
            <div class=\"col-sm\">
              <div class=\"alert alert-info\" role=\"alert\">
                <div class=\"alert-text\">";
            // line 42
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("This section enables you to change the default pattern of your links. In order to use this functionality, PrestaShop's \"Friendly URL\" option must be enabled, and Apache's URL rewriting module (mod_rewrite) must be activated on your web server.", [], "Admin.Shopparameters.Notification"), "html", null, true);
            echo "<br>";
            // line 43
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("There are several available keywords for each route listed below; note that keywords with * are required!", [], "Admin.Shopparameters.Notification"), "html", null, true);
            echo " <br>";
            // line 44
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("To add a keyword in your URL, use the {keyword} syntax. If the keyword is not empty, you can add text before or after the keyword with syntax {prepend:keyword:append}. For example {-hey-:meta_title} will add \"-hey-my-title\" in the URL if the meta title is set.", [], "Admin.Shopparameters.Notification"), "html", null, true);
            echo "
                </div>
              </div>
            </div>
          </div>

          <div class=\"form-group row\">
            <label class=\"form-control-label\">";
            // line 52
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Route to products", [], "Admin.Shopparameters.Feature"), "html", null, true);
            echo "
            </label>
            <div class=\"col-sm\">";
            // line 55
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["urlSchemaForm"] ?? null), "product_rule", []), 'errors');
            // line 56
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["urlSchemaForm"] ?? null), "product_rule", []), 'widget');
            echo "
              <small class=\"form-text\">";
            // line 58
            echo twig_include($this->env, $context, "@PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/Blocks/keyword.html.twig", ["idRoute" => "product_rule"]);
            echo "
              </small>
            </div>
          </div>

          <div class=\"form-group row\">
            <label class=\"form-control-label\">";
            // line 65
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Route to category", [], "Admin.Shopparameters.Feature"), "html", null, true);
            echo "
            </label>
            <div class=\"col-sm\">";
            // line 68
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["urlSchemaForm"] ?? null), "category_rule", []), 'errors');
            // line 69
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["urlSchemaForm"] ?? null), "category_rule", []), 'widget');
            echo "
              <small class=\"form-text\">";
            // line 71
            echo twig_include($this->env, $context, "@PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/Blocks/keyword.html.twig", ["idRoute" => "category_rule"]);
            echo "
              </small>
            </div>
          </div>

          <div class=\"form-group row\">
            <label class=\"form-control-label\">";
            // line 78
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Route to category which has the \"selected_filter\" attribute for the \"Layered Navigation\" (blocklayered) module", [], "Admin.Shopparameters.Feature"), "html", null, true);
            echo "
            </label>
            <div class=\"col-sm\">";
            // line 81
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["urlSchemaForm"] ?? null), "layered_rule", []), 'errors');
            // line 82
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["urlSchemaForm"] ?? null), "layered_rule", []), 'widget');
            echo "
              <small class=\"form-text\">";
            // line 84
            echo twig_include($this->env, $context, "@PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/Blocks/keyword.html.twig", ["idRoute" => "layered_rule"]);
            echo "
              </small>
            </div>
          </div>

          <div class=\"form-group row\">
            <label class=\"form-control-label\">";
            // line 91
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Route to supplier", [], "Admin.Shopparameters.Feature"), "html", null, true);
            echo "
            </label>
            <div class=\"col-sm\">";
            // line 94
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["urlSchemaForm"] ?? null), "supplier_rule", []), 'errors');
            // line 95
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["urlSchemaForm"] ?? null), "supplier_rule", []), 'widget');
            echo "
              <small class=\"form-text\">";
            // line 97
            echo twig_include($this->env, $context, "@PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/Blocks/keyword.html.twig", ["idRoute" => "supplier_rule"]);
            echo "
              </small>
            </div>
          </div>

          <div class=\"form-group row\">
            <label class=\"form-control-label\">";
            // line 104
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Route to brand", [], "Admin.Shopparameters.Feature"), "html", null, true);
            echo "
            </label>
            <div class=\"col-sm\">";
            // line 107
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["urlSchemaForm"] ?? null), "manufacturer_rule", []), 'errors');
            // line 108
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["urlSchemaForm"] ?? null), "manufacturer_rule", []), 'widget');
            echo "
              <small class=\"form-text\">";
            // line 110
            echo twig_include($this->env, $context, "@PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/Blocks/keyword.html.twig", ["idRoute" => "manufacturer_rule"]);
            echo "
              </small>
            </div>
          </div>

          <div class=\"form-group row\">
            <label class=\"form-control-label\">";
            // line 117
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Route to page", [], "Admin.Shopparameters.Feature"), "html", null, true);
            echo "
            </label>
            <div class=\"col-sm\">";
            // line 120
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["urlSchemaForm"] ?? null), "cms_rule", []), 'errors');
            // line 121
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["urlSchemaForm"] ?? null), "cms_rule", []), 'widget');
            echo "
              <small class=\"form-text\">";
            // line 123
            echo twig_include($this->env, $context, "@PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/Blocks/keyword.html.twig", ["idRoute" => "cms_rule"]);
            echo "
              </small>
            </div>
          </div>

          <div class=\"form-group row\">
            <label class=\"form-control-label\">";
            // line 130
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Route to page category", [], "Admin.Shopparameters.Feature"), "html", null, true);
            echo "
            </label>
            <div class=\"col-sm\">";
            // line 133
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["urlSchemaForm"] ?? null), "cms_category_rule", []), 'errors');
            // line 134
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["urlSchemaForm"] ?? null), "cms_category_rule", []), 'widget');
            echo "
              <small class=\"form-text\">";
            // line 136
            echo twig_include($this->env, $context, "@PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/Blocks/keyword.html.twig", ["idRoute" => "cms_category_rule"]);
            echo "
              </small>
            </div>
          </div>

          <div class=\"form-group row\">
            <label class=\"form-control-label\">";
            // line 143
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Route to modules", [], "Admin.Shopparameters.Feature"), "html", null, true);
            echo "
            </label>
            <div class=\"col-sm\">";
            // line 146
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["urlSchemaForm"] ?? null), "module", []), 'errors');
            // line 147
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["urlSchemaForm"] ?? null), "module", []), 'widget');
            echo "
              <small class=\"form-text\">";
            // line 149
            echo twig_include($this->env, $context, "@PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/Blocks/keyword.html.twig", ["idRoute" => "module"]);
            echo "
              </small>
            </div>
          </div>

        </div>
      </div>
      <div class=\"card-footer\">
        <div class=\"d-flex justify-content-end\">
          <button class=\"btn btn-primary\">";
            // line 158
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Save", [], "Admin.Actions"), "html", null, true);
            echo "</button>
        </div>
      </div>
    </div>";
        } else {
            // line 163
            $this->getAttribute(($context["urlSchemaForm"] ?? null), "setRendered", []);
        }
    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/Blocks/url_schema_configuration.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  241 => 163,  234 => 158,  222 => 149,  218 => 147,  216 => 146,  211 => 143,  202 => 136,  198 => 134,  196 => 133,  191 => 130,  182 => 123,  178 => 121,  176 => 120,  171 => 117,  162 => 110,  158 => 108,  156 => 107,  151 => 104,  142 => 97,  138 => 95,  136 => 94,  131 => 91,  122 => 84,  118 => 82,  116 => 81,  111 => 78,  102 => 71,  98 => 69,  96 => 68,  91 => 65,  82 => 58,  78 => 56,  76 => 55,  71 => 52,  61 => 44,  58 => 43,  55 => 42,  45 => 34,  41 => 32,  39 => 31,  33 => 30,  31 => 28,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@PrestaShop/Admin/Configure/ShopParameters/TrafficSeo/Meta/Blocks/url_schema_configuration.html.twig", "/srv/http/presta/src/PrestaShopBundle/Resources/views/Admin/Configure/ShopParameters/TrafficSeo/Meta/Blocks/url_schema_configuration.html.twig");
    }
}
