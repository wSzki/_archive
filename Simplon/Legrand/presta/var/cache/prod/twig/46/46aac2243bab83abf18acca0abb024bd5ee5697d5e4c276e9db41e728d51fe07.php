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

/* @Twig/form_max_length.html.twig */
class __TwigTemplate_df3d5206e27b074714d8586f67c27c8f9e4dec8b0b62fb109546e64abe4c3fe1 extends \Twig\Template
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
        if ($this->getAttribute(($context["attr"] ?? null), "counter", [], "any", true, true)) {
            // line 26
            $context["isRecommandedType"] = ($this->getAttribute(($context["attr"] ?? null), "counter_type", [], "any", true, true) && ($this->getAttribute(($context["attr"] ?? null), "counter_type", []) == "recommended"));
            // line 27
            echo "  <small class=\"form-text text-muted text-right maxLength";
            echo (( !($context["isRecommandedType"] ?? null)) ? ("maxType") : (""));
            echo "\">
      <em>";
            // line 29
            if (($context["isRecommandedType"] ?? null)) {
                // line 30
                echo twig_replace_filter($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("[1][/1] of [2][/2] characters used (recommended)", [], "Admin.Catalog.Feature"), ["[1]" => "<span class=\"currentLength\">", "[/1]" => "</span>", "[2]" => ("<span class=\"currentTotalMax\">" . $this->getAttribute(                // line 33
($context["attr"] ?? null), "counter", [])), "[/2]" => "</span>"]);
            } else {
                // line 37
                echo twig_replace_filter($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("[1][/1] of [2][/2] characters allowed", [], "Admin.Catalog.Feature"), ["[1]" => "<span class=\"currentLength\">", "[/1]" => "</span>", "[2]" => ("<span class=\"currentTotalMax\">" . $this->getAttribute(                // line 40
($context["attr"] ?? null), "counter", [])), "[/2]" => "</span>"]);
            }
            // line 44
            echo "      </em>
  </small>";
        }
    }

    public function getTemplateName()
    {
        return "@Twig/form_max_length.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 44,  46 => 40,  45 => 37,  42 => 33,  41 => 30,  39 => 29,  34 => 27,  32 => 26,  30 => 25,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@Twig/form_max_length.html.twig", "/srv/http/presta/src/PrestaShopBundle/Resources/views/Admin/TwigTemplateForm/form_max_length.html.twig");
    }
}
