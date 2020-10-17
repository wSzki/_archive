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

/* @PrestaShop/Admin/Helpers/bootstrap_popup.html.twig */
class __TwigTemplate_274af60329033d2357326776b13eca698e5cf180b5e88501b710a77127460492 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'header' => [$this, 'block_header'],
            'content' => [$this, 'block_content'],
            'footer' => [$this, 'block_footer'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 25
        echo "<div class=\"modal fade\" id=\"";
        echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
        echo "\" tabindex=\"-1\">
    <div class=\"modal-dialog";
        // line 26
        if ((isset($context["class"]) || array_key_exists("class", $context))) {
            echo twig_escape_filter($this->env, ($context["class"] ?? null), "html", null, true);
        }
        echo "\">
        <div class=\"modal-content\">";
        // line 28
        $this->displayBlock('header', $context, $blocks);
        // line 37
        $this->displayBlock('content', $context, $blocks);
        // line 40
        if ((isset($context["progressbar"]) || array_key_exists("progressbar", $context))) {
            // line 41
            echo "                <div class=\"modal-body\" id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["progressbar"] ?? null), "id", []), "html", null, true);
            echo "\">
                    <div class=\"float-right progress-details-text\" default-value=\"";
            // line 42
            echo twig_escape_filter($this->env, (($this->getAttribute(($context["progressbar"] ?? null), "label", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["progressbar"] ?? null), "label", []), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Processing...", [], "Admin.Global"))) : ($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Processing...", [], "Admin.Global"))), "html", null, true);
            echo "\">";
            // line 43
            echo twig_escape_filter($this->env, (($this->getAttribute(($context["progressbar"] ?? null), "label", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["progressbar"] ?? null), "label", []), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Processing...", [], "Admin.Global"))) : ($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Processing...", [], "Admin.Global"))), "html", null, true);
            echo "
                    </div>
                    <div class=\"progress active progress-striped\" style=\"display: block; width: 100%\">
                        <div class=\"progress-bar progress-bar-success\" role=\"progressbar\" style=\"width: 0%\">
                            <span>0 %</span>
                        </div>
                    </div>
                </div>";
        }
        // line 53
        $this->displayBlock('footer', $context, $blocks);
        // line 71
        echo "        </div>
    </div>
</div>
<script>
    \$(document).ready(function() {
        var closable =";
        // line 76
        if (((isset($context["closable"]) || array_key_exists("closable", $context)) && (($context["closable"] ?? null) == true))) {
            echo "true";
        } else {
            echo "false";
        }
        echo ";
        \$('#";
        // line 77
        echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
        echo "').modal({
            backdrop: (closable ? true : 'static'),
            keyboard: closable,
            closable: closable,
            show: false
        });
    });
</script>
";
    }

    // line 28
    public function block_header($context, array $blocks = [])
    {
        // line 29
        if ((isset($context["title"]) || array_key_exists("title", $context))) {
            // line 30
            echo "                    <div class=\"modal-header\">
                        <h4 class=\"modal-title\">";
            // line 31
            echo twig_escape_filter($this->env, ($context["title"] ?? null), "html", null, true);
            echo "</h4>";
            // line 32
            if (((isset($context["closable"]) || array_key_exists("closable", $context)) && (($context["closable"] ?? null) == true))) {
                echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>";
            }
            // line 33
            echo "                    </div>";
        }
    }

    // line 37
    public function block_content($context, array $blocks = [])
    {
    }

    // line 53
    public function block_footer($context, array $blocks = [])
    {
        // line 54
        if ((isset($context["actions"]) || array_key_exists("actions", $context))) {
            // line 55
            echo "                    <div class=\"modal-footer\">";
            // line 56
            if (((isset($context["closable"]) || array_key_exists("closable", $context)) && (($context["closable"] ?? null) == true))) {
                // line 57
                echo "                            <button type=\"button\" class=\"btn btn-outline-secondary btn-lg\" data-dismiss=\"modal\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Close", [], "Admin.Actions"), "html", null, true);
                echo "</button>";
            }
            // line 59
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["actions"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["action"]) {
                // line 60
                if (($this->getAttribute($context["action"], "type", [], "any", true, true) && ($this->getAttribute($context["action"], "type", []) == "link"))) {
                    // line 61
                    echo "                                <a href=\"";
                    echo twig_escape_filter($this->env, (($this->getAttribute($context["action"], "href", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["action"], "href", []), "#")) : ("#")), "html", null, true);
                    echo "\" class=\"";
                    echo twig_escape_filter($this->env, (($this->getAttribute($context["action"], "class", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["action"], "class", []), "btn")) : ("btn")), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, (($this->getAttribute($context["action"], "label", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["action"], "label", []), "Label is missing")) : ("Label is missing")), "html", null, true);
                    echo "</a>";
                } elseif (($this->getAttribute(                // line 62
$context["action"], "type", [], "any", true, true) && ($this->getAttribute($context["action"], "type", []) == "button"))) {
                    // line 63
                    echo "                                <button type=\"button\" value=\"";
                    echo twig_escape_filter($this->env, (($this->getAttribute($context["action"], "value", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["action"], "value", []), "")) : ("")), "html", null, true);
                    echo "\" class=\"";
                    echo twig_escape_filter($this->env, (($this->getAttribute($context["action"], "class", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["action"], "class", []), "btn")) : ("btn")), "html", null, true);
                    echo "\">";
                    // line 64
                    echo twig_escape_filter($this->env, (($this->getAttribute($context["action"], "label", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["action"], "label", []), "Label is missing")) : ("Label is missing")), "html", null, true);
                    echo "
                                </button>";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['action'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 68
            echo "                    </div>";
        }
    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Helpers/bootstrap_popup.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  169 => 68,  160 => 64,  154 => 63,  152 => 62,  144 => 61,  142 => 60,  138 => 59,  133 => 57,  131 => 56,  129 => 55,  127 => 54,  124 => 53,  119 => 37,  114 => 33,  110 => 32,  107 => 31,  104 => 30,  102 => 29,  99 => 28,  86 => 77,  78 => 76,  71 => 71,  69 => 53,  58 => 43,  55 => 42,  50 => 41,  48 => 40,  46 => 37,  44 => 28,  38 => 26,  33 => 25,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@PrestaShop/Admin/Helpers/bootstrap_popup.html.twig", "/srv/http/presta/src/PrestaShopBundle/Resources/views/Admin/Helpers/bootstrap_popup.html.twig");
    }
}
