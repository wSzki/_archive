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

/* @PrestaShop/Admin/Configure/AdvancedParameters/performance.html.twig */
class __TwigTemplate_a6452b3b7fa341d04b076f4f53500c966fbbcb1846f105e091e5fb4a9f6b01ca extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        // line 25
        $this->parent = $this->loadTemplate("@PrestaShop/Admin/layout.html.twig", "@PrestaShop/Admin/Configure/AdvancedParameters/performance.html.twig", 25);
        $this->blocks = [
            'content' => [$this, 'block_content'],
            'perfs_form_smarty_cache' => [$this, 'block_perfs_form_smarty_cache'],
            'perfs_form_debug_mode' => [$this, 'block_perfs_form_debug_mode'],
            'perfs_form_optional_features' => [$this, 'block_perfs_form_optional_features'],
            'perfs_form_ccc' => [$this, 'block_perfs_form_ccc'],
            'perfs_form_media_servers' => [$this, 'block_perfs_form_media_servers'],
            'perfs_form_caching' => [$this, 'block_perfs_form_caching'],
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doGetParent(array $context)
    {
        return "@PrestaShop/Admin/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 27
        $context["ps"] = $this->loadTemplate("@PrestaShop/Admin/macros.html.twig", "@PrestaShop/Admin/Configure/AdvancedParameters/performance.html.twig", 27);
        // line 30
        list($context["smartyForm"], $context["debugModeForm"], $context["optionalFeaturesForm"], $context["combineCompressCacheForm"], $context["mediaServersForm"], $context["cachingForm"], $context["memcacheForm"]) =         [$this->getAttribute(        // line 31
($context["form"] ?? null), "smarty", []), $this->getAttribute(($context["form"] ?? null), "debug_mode", []), $this->getAttribute(($context["form"] ?? null), "optional_features", []), $this->getAttribute(($context["form"] ?? null), "ccc", []), $this->getAttribute(($context["form"] ?? null), "media_servers", []), $this->getAttribute(($context["form"] ?? null), "caching", []), $this->getAttribute(($context["form"] ?? null), "add_memcache_server", [])];
        // line 25
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 34
    public function block_content($context, array $blocks = [])
    {
        // line 35
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["form"] ?? null), 'form_start', ["attr" => ["class" => "form"]]);
        echo "
  <div class=\"row justify-content-center\">";
        // line 37
        $this->displayBlock('perfs_form_smarty_cache', $context, $blocks);
        // line 92
        $this->displayBlock('perfs_form_debug_mode', $context, $blocks);
        // line 133
        $this->displayBlock('perfs_form_optional_features', $context, $blocks);
        // line 190
        $this->displayBlock('perfs_form_ccc', $context, $blocks);
        // line 236
        $this->displayBlock('perfs_form_media_servers', $context, $blocks);
        // line 282
        $this->displayBlock('perfs_form_caching', $context, $blocks);
        // line 316
        echo "  </div>";
        // line 317
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["form"] ?? null), 'form_end');
    }

    // line 37
    public function block_perfs_form_smarty_cache($context, array $blocks = [])
    {
        // line 38
        echo "      <div class=\"col-xl-10\">
        <div class=\"card\">
          <h3 class=\"card-header\">
            <i class=\"material-icons\">business_center</i>";
        // line 41
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Smarty", [], "Admin.Advparameters.Feature"), "html", null, true);
        echo "
          </h3>
          <div class=\"card-block row\">
            <div class=\"card-text\">
              <div class=\"form-group row\">
                <label class=\"form-control-label\">";
        // line 46
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Template compilation", [], "Admin.Advparameters.Feature"), "html", null, true);
        echo "</label>
                <div class=\"col-sm\">";
        // line 48
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["smartyForm"] ?? null), "template_compilation", []), 'errors');
        // line 49
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["smartyForm"] ?? null), "template_compilation", []), 'widget');
        echo "
                </div>
              </div>
              <div class=\"form-group row\">";
        // line 53
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Cache", [], "Admin.Advparameters.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Should be enabled except for debugging.", [], "Admin.Advparameters.Feature"));
        echo "
                <div class=\"col-sm\">";
        // line 55
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["smartyForm"] ?? null), "cache", []), 'errors');
        // line 56
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["smartyForm"] ?? null), "cache", []), 'widget');
        echo "
                </div>
              </div>
              <div class=\"form-group row smarty-cache-option\">";
        // line 60
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Multi-front optimizations", [], "Admin.Advparameters.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Should be enabled if you want to avoid to store the smarty cache on NFS.", [], "Admin.Advparameters.Help"));
        echo "
                <div class=\"col-sm\">";
        // line 62
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["smartyForm"] ?? null), "multi_front_optimization", []), 'errors');
        // line 63
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["smartyForm"] ?? null), "multi_front_optimization", []), 'widget');
        echo "
                </div>
              </div>
              <div class=\"form-group row smarty-cache-option\">
                <label class=\"form-control-label\">";
        // line 67
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Caching type", [], "Admin.Advparameters.Feature"), "html", null, true);
        echo "</label>
                <div class=\"col-sm\">";
        // line 69
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["smartyForm"] ?? null), "caching_type", []), 'errors');
        // line 70
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["smartyForm"] ?? null), "caching_type", []), 'widget');
        echo "
                </div>
              </div>
              <div class=\"form-group row smarty-cache-option\">
                <label class=\"form-control-label\">";
        // line 74
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Clear cache", [], "Admin.Advparameters.Feature"), "html", null, true);
        echo "</label>
                <div class=\"col-sm\">";
        // line 76
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["smartyForm"] ?? null), "clear_cache", []), 'errors');
        // line 77
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["smartyForm"] ?? null), "clear_cache", []), 'widget');
        echo "
                </div>
              </div>";
        // line 80
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["smartyForm"] ?? null), 'rest');
        echo "
            </div>
          </div>
          <div class=\"card-footer\">
            <div class=\"d-flex justify-content-end\">
              <button class=\"btn btn-primary\">";
        // line 85
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Save", [], "Admin.Actions"), "html", null, true);
        echo "</button>
            </div>
          </div>
        </div>
      </div>";
    }

    // line 92
    public function block_perfs_form_debug_mode($context, array $blocks = [])
    {
        // line 93
        echo "      <div class=\"col-xl-10\">
        <div class=\"card\">
          <h3 class=\"card-header\">
            <i class=\"material-icons\">bug_report</i>";
        // line 96
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Debug mode", [], "Admin.Advparameters.Feature"), "html", null, true);
        echo "
          </h3>
          <div class=\"card-block row\">
            <div class=\"card-text\">
              <div class=\"form-group row\">";
        // line 101
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Disable non PrestaShop modules", [], "Admin.Advparameters.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Enable or disable non PrestaShop Modules.", [], "Admin.Advparameters.Feature"));
        echo "
                <div class=\"col-sm\">";
        // line 103
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["debugModeForm"] ?? null), "disable_non_native_modules", []), 'errors');
        // line 104
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["debugModeForm"] ?? null), "disable_non_native_modules", []), 'widget');
        echo "
                </div>
              </div>
              <div class=\"form-group row\">";
        // line 108
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Disable all overrides", [], "Admin.Advparameters.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Enable or disable all classes and controllers overrides.", [], "Admin.Advparameters.Feature"));
        echo "
                <div class=\"col-sm\">";
        // line 110
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["debugModeForm"] ?? null), "disable_overrides", []), 'errors');
        // line 111
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["debugModeForm"] ?? null), "disable_overrides", []), 'widget');
        echo "
                </div>
              </div>
              <div class=\"form-group row\">";
        // line 115
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Debug mode", [], "Admin.Advparameters.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Enable or disable debug mode.", [], "Admin.Advparameters.Help"));
        echo "
                <div class=\"col-sm\">";
        // line 117
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["debugModeForm"] ?? null), "debug_mode", []), 'errors');
        // line 118
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["debugModeForm"] ?? null), "debug_mode", []), 'widget');
        echo "
                </div>
              </div>";
        // line 121
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["debugModeForm"] ?? null), 'rest');
        echo "
            </div>
          </div>
          <div class=\"card-footer\">
            <div class=\"d-flex justify-content-end\">
              <button class=\"btn btn-primary\">";
        // line 126
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Save", [], "Admin.Actions"), "html", null, true);
        echo "</button>
            </div>
          </div>
        </div>
      </div>";
    }

    // line 133
    public function block_perfs_form_optional_features($context, array $blocks = [])
    {
        // line 134
        echo "      <div class=\"col-xl-10\">
        <div class=\"card\">
          <h3 class=\"card-header\">
            <i class=\"material-icons\">extension</i>";
        // line 137
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Optional features", [], "Admin.Advparameters.Feature"), "html", null, true);
        echo "
          </h3>
          <div class=\"card-block row\">
            <div class=\"card-text\">

              <div class=\"row\">
                <div class=\"col\">";
        // line 144
        echo $context["ps"]->getinfotip($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Some features can be disabled in order to improve performance.", [], "Admin.Advparameters.Help"));
        echo "
                </div>
              </div>

              <div class=\"form-group row\">";
        // line 149
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Combinations", [], "Admin.Global"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Choose \"No\" to disable Product Combinations.", [], "Admin.Advparameters.Help"));
        echo "
                <div class=\"col-sm\">";
        // line 151
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["optionalFeaturesForm"] ?? null), "combinations", []), 'errors');
        // line 152
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["optionalFeaturesForm"] ?? null), "combinations", []), 'widget');
        echo "
                </div>
              </div>

              <div class=\"row\">
                <div class=\"col\">";
        // line 158
        if ($this->getAttribute($this->getAttribute($this->getAttribute(($context["optionalFeaturesForm"] ?? null), "combinations", []), "vars", []), "disabled", [])) {
            // line 159
            echo $context["ps"]->getwarningtip($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("You cannot set this parameter to No when combinations are already used by some of your products", [], "Admin.Advparameters.Help"));
        }
        // line 161
        echo "                </div>
              </div>

              <div class=\"form-group row\">";
        // line 165
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Features", [], "Admin.Global"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Choose \"No\" to disable Product Features.", [], "Admin.Advparameters.Help"));
        echo "
                <div class=\"col-sm\">";
        // line 167
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["optionalFeaturesForm"] ?? null), "features", []), 'errors');
        // line 168
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["optionalFeaturesForm"] ?? null), "features", []), 'widget');
        echo "
                </div>
              </div>
              <div class=\"form-group row\">";
        // line 172
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Customer groups", [], "Admin.Advparameters.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Choose \"No\" to disable Customer Groups.", [], "Admin.Advparameters.Help"));
        echo "
                <div class=\"col-sm\">";
        // line 174
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["optionalFeaturesForm"] ?? null), "customer_groups", []), 'errors');
        // line 175
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["optionalFeaturesForm"] ?? null), "customer_groups", []), 'widget');
        echo "
                </div>
              </div>";
        // line 178
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["optionalFeaturesForm"] ?? null), 'rest');
        echo "
            </div>
          </div>
          <div class=\"card-footer\">
            <div class=\"d-flex justify-content-end\">
              <button class=\"btn btn-primary\">";
        // line 183
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Save", [], "Admin.Actions"), "html", null, true);
        echo "</button>
            </div>
          </div>
        </div>
      </div>";
    }

    // line 190
    public function block_perfs_form_ccc($context, array $blocks = [])
    {
        // line 191
        echo "      <div class=\"col-xl-10\">
        <div class=\"card\">
          <h3 class=\"card-header\">
            <i class=\"material-icons\">zoom_out_map</i>";
        // line 194
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("CCC (Combine, Compress and Cache)", [], "Admin.Advparameters.Feature"), "html", null, true);
        echo "
          </h3>
          <div class=\"card-block row\">
            <div class=\"card-text\">
              <div class=\"row\">
                <div class=\"col\">";
        // line 200
        echo $context["ps"]->getinfotip($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("CCC allows you to reduce the loading time of your page. With these settings you will gain performance without even touching the code of your theme. Make sure, however, that your theme is compatible with PrestaShop 1.4+. Otherwise, CCC will cause problems.", [], "Admin.Advparameters.Help"));
        echo "
                </div>
              </div>
              <div class=\"form-group row\">
                <label class=\"form-control-label\">";
        // line 204
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Smart cache for CSS", [], "Admin.Advparameters.Feature"), "html", null, true);
        echo "</label>
                <div class=\"col-sm\">";
        // line 206
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["combineCompressCacheForm"] ?? null), "smart_cache_css", []), 'errors');
        // line 207
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["combineCompressCacheForm"] ?? null), "smart_cache_css", []), 'widget');
        echo "
                </div>
              </div>
              <div class=\"form-group row\">
                <label class=\"form-control-label\">";
        // line 211
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Smart cache for JavaScript", [], "Admin.Advparameters.Feature"), "html", null, true);
        echo "</label>
                <div class=\"col-sm\">";
        // line 213
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["combineCompressCacheForm"] ?? null), "smart_cache_js", []), 'errors');
        // line 214
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["combineCompressCacheForm"] ?? null), "smart_cache_js", []), 'widget');
        echo "
                </div>
              </div>
              <div class=\"form-group row\">";
        // line 218
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Apache optimization", [], "Admin.Advparameters.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("This will add directives to your .htaccess file, which should improve caching and compression.", [], "Admin.Advparameters.Help"));
        echo "
                <div class=\"col-sm\">";
        // line 220
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["combineCompressCacheForm"] ?? null), "apache_optimization", []), 'errors');
        // line 221
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["combineCompressCacheForm"] ?? null), "apache_optimization", []), 'widget');
        echo "
                </div>
              </div>";
        // line 224
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["combineCompressCacheForm"] ?? null), 'rest');
        echo "
            </div>
          </div>
          <div class=\"card-footer\">
            <div class=\"d-flex justify-content-end\">
              <button class=\"btn btn-primary\">";
        // line 229
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Save", [], "Admin.Actions"), "html", null, true);
        echo "</button>
            </div>
          </div>
        </div>
      </div>";
    }

    // line 236
    public function block_perfs_form_media_servers($context, array $blocks = [])
    {
        // line 237
        echo "      <div class=\"col-xl-10\">
        <div class=\"card\">
          <h3 class=\"card-header\">
            <i class=\"material-icons\">link</i>";
        // line 240
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Media servers (use only with CCC)", [], "Admin.Advparameters.Feature"), "html", null, true);
        echo "
          </h3>
          <div class=\"card-block row\">
            <div class=\"card-text\">
              <div class=\"row\">
                <div class=\"col\">";
        // line 246
        echo $context["ps"]->getinfotip($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("You must enter another domain, or subdomain, in order to use cookieless static content.", [], "Admin.Advparameters.Feature"));
        echo "
                </div>
              </div>
              <div class=\"form-group row\">";
        // line 250
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Media server #1", [], "Admin.Advparameters.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Name of the second domain of your shop, (e.g. myshop-media-server-1.com). If you do not have another domain, leave this field blank.", [], "Admin.Advparameters.Help"));
        echo "
                <div class=\"col-sm\">";
        // line 252
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["mediaServersForm"] ?? null), "media_server_one", []), 'errors');
        // line 253
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["mediaServersForm"] ?? null), "media_server_one", []), 'widget');
        echo "
                </div>
              </div>
              <div class=\"form-group row\">";
        // line 257
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Media server #2", [], "Admin.Advparameters.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Name of the third domain of your shop, (e.g. myshop-media-server-2.com). If you do not have another domain, leave this field blank.", [], "Admin.Advparameters.Help"));
        echo "
                <div class=\"col-sm\">";
        // line 259
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["mediaServersForm"] ?? null), "media_server_two", []), 'errors');
        // line 260
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["mediaServersForm"] ?? null), "media_server_two", []), 'widget');
        echo "
                </div>
              </div>
              <div class=\"form-group row\">";
        // line 264
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Media server #3", [], "Admin.Advparameters.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Name of the fourth domain of your shop, (e.g. myshop-media-server-3.com). If you do not have another domain, leave this field blank.", [], "Admin.Advparameters.Help"));
        echo "
                <div class=\"col-sm\">";
        // line 266
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["mediaServersForm"] ?? null), "media_server_three", []), 'errors');
        // line 267
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["mediaServersForm"] ?? null), "media_server_three", []), 'widget');
        echo "
                </div>
              </div>";
        // line 270
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["mediaServersForm"] ?? null), 'rest');
        echo "
            </div>
          </div>
          <div class=\"card-footer\">
            <div class=\"d-flex justify-content-end\">
              <button class=\"btn btn-primary\">";
        // line 275
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Save", [], "Admin.Actions"), "html", null, true);
        echo "</button>
            </div>
          </div>
        </div>
      </div>";
    }

    // line 282
    public function block_perfs_form_caching($context, array $blocks = [])
    {
        // line 283
        echo "      <div class=\"col-xl-10\">
        <div class=\"card\">
          <h3 class=\"card-header\">
            <i class=\"material-icons\">link</i>";
        // line 286
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Caching", [], "Admin.Advparameters.Feature"), "html", null, true);
        echo "
          </h3>
          <div class=\"card-block row\">
            <div class=\"card-text\">
              <div class=\"form-group row\">
                <label class=\"form-control-label\">";
        // line 291
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Use cache", [], "Admin.Advparameters.Feature"), "html", null, true);
        echo "</label>
                <div class=\"col-sm\">";
        // line 293
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["cachingForm"] ?? null), "use_cache", []), 'errors');
        // line 294
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["cachingForm"] ?? null), "use_cache", []), 'widget');
        echo "
                </div>
              </div>
              <div class=\"form-group row memcache\" id=\"caching_systems\">
                <label class=\"form-control-label\">";
        // line 298
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Caching system", [], "Admin.Advparameters.Feature"), "html", null, true);
        echo "</label>
                <div class=\"col-sm\">";
        // line 300
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["cachingForm"] ?? null), "caching_system", []), 'errors');
        // line 301
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["cachingForm"] ?? null), "caching_system", []), 'widget');
        echo "
                </div>
              </div>";
        // line 304
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["cachingForm"] ?? null), 'rest');
        // line 305
        echo twig_include($this->env, $context, "@AdvancedParameters/memcache_servers.html.twig", ["form" => ($context["memcacheForm"] ?? null)]);
        echo "
            </div>
          </div>
          <div class=\"card-footer\">
            <div class=\"d-flex justify-content-end\">
              <button class=\"btn btn-primary\">";
        // line 310
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Save", [], "Admin.Actions"), "html", null, true);
        echo "</button>
            </div>
          </div>
        </div>
      </div>";
    }

    // line 320
    public function block_javascripts($context, array $blocks = [])
    {
        // line 321
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
  <script src=\"";
        // line 322
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("themes/default/js/bundle/admin_parameters/performancePage.js"), "html", null, true);
        echo "\"></script>
  <script>
    var configuration = {
      'addServerUrl': '";
        // line 325
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getUrl("admin_servers_add"), "js"), "html", null, true);
        echo "',
      'removeServerUrl': '";
        // line 326
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getUrl("admin_servers_delete"), "js"), "html", null, true);
        echo "',
      'testServerUrl': '";
        // line 327
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getUrl("admin_servers_test"), "js"), "html", null, true);
        echo "'
    };
    var app = new PerformancePage(
      configuration.addServerUrl,
      configuration.removeServerUrl,
      configuration.testServerUrl
    );

    window.addEventListener('load', function() {
      var addServerBtn = document.getElementById('add-server-btn');
      var testServerBtn = document.getElementById('test-server-btn');

      addServerBtn.addEventListener('click', function(event) {
        event.preventDefault();
        app.addServer();
      });

      testServerBtn.addEventListener('click', function(event) {
        event.preventDefault();
        app.testServer();
      });
    });
  </script>

  <script src=\"";
        // line 351
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("themes/default/js/bundle/admin_parameters/performancePageUI.js"), "html", null, true);
        echo "\"></script>";
    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Configure/AdvancedParameters/performance.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  583 => 351,  556 => 327,  552 => 326,  548 => 325,  542 => 322,  538 => 321,  535 => 320,  526 => 310,  518 => 305,  516 => 304,  511 => 301,  509 => 300,  505 => 298,  498 => 294,  496 => 293,  492 => 291,  484 => 286,  479 => 283,  476 => 282,  467 => 275,  459 => 270,  454 => 267,  452 => 266,  448 => 264,  442 => 260,  440 => 259,  436 => 257,  430 => 253,  428 => 252,  424 => 250,  418 => 246,  410 => 240,  405 => 237,  402 => 236,  393 => 229,  385 => 224,  380 => 221,  378 => 220,  374 => 218,  368 => 214,  366 => 213,  362 => 211,  355 => 207,  353 => 206,  349 => 204,  342 => 200,  334 => 194,  329 => 191,  326 => 190,  317 => 183,  309 => 178,  304 => 175,  302 => 174,  298 => 172,  292 => 168,  290 => 167,  286 => 165,  281 => 161,  278 => 159,  276 => 158,  268 => 152,  266 => 151,  262 => 149,  255 => 144,  246 => 137,  241 => 134,  238 => 133,  229 => 126,  221 => 121,  216 => 118,  214 => 117,  210 => 115,  204 => 111,  202 => 110,  198 => 108,  192 => 104,  190 => 103,  186 => 101,  179 => 96,  174 => 93,  171 => 92,  162 => 85,  154 => 80,  149 => 77,  147 => 76,  143 => 74,  136 => 70,  134 => 69,  130 => 67,  123 => 63,  121 => 62,  117 => 60,  111 => 56,  109 => 55,  105 => 53,  99 => 49,  97 => 48,  93 => 46,  85 => 41,  80 => 38,  77 => 37,  73 => 317,  71 => 316,  69 => 282,  67 => 236,  65 => 190,  63 => 133,  61 => 92,  59 => 37,  55 => 35,  52 => 34,  48 => 25,  46 => 31,  45 => 30,  43 => 27,  22 => 25,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@PrestaShop/Admin/Configure/AdvancedParameters/performance.html.twig", "/srv/http/presta/src/PrestaShopBundle/Resources/views/Admin/Configure/AdvancedParameters/performance.html.twig");
    }
}
