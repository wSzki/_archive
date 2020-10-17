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

/* @PrestaShop/Admin/Common/Grid/Columns/Content/action.html.twig */
class __TwigTemplate_0c3607f56e0c80ab3a3fb3aa73d293ee4ff05970bbf386af10abb32c8f00fd8e extends \Twig\Template
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
        $context["actions"] = $this->getAttribute($this->getAttribute(($context["column"] ?? null), "options", []), "actions", []);
        // line 28
        if ( !twig_test_empty(($context["actions"] ?? null))) {
            // line 29
            echo "  <div class=\"btn-group-action text-right\">
    <div class=\"btn-group\">";
            // line 31
            list($context["skippedActions"], $context["isFirstRendered"]) =             [0, false];
            // line 34
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["actions"] ?? null));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["action"]) {
                // line 35
                if ( !($context["isFirstRendered"] ?? null)) {
                    // line 36
                    $context["skippedActions"] = (($context["skippedActions"] ?? null) + 1);
                }
                // line 39
                if (($this->getAttribute($context["action"], "isApplicable", [0 => ($context["record"] ?? null)], "method") &&  !($context["isFirstRendered"] ?? null))) {
                    // line 40
                    echo twig_include($this->env, $context, (("@PrestaShop/Admin/Common/Grid/Actions/Row/" . $this->getAttribute($context["action"], "type", [])) . ".html.twig"), ["grid" =>                     // line 41
($context["grid"] ?? null), "column" =>                     // line 42
($context["column"] ?? null), "attributes" => ["class" => "dropdown-item", "tooltip_name" => true], "record" =>                     // line 44
($context["record"] ?? null), "action" =>                     // line 45
$context["action"]]);
                    // line 48
                    $context["isFirstRendered"] = true;
                }
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['action'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 53
            if ((twig_length_filter($this->env, ($context["actions"] ?? null)) > ($context["skippedActions"] ?? null))) {
                // line 54
                echo "        <a class=\"btn btn-link dropdown-toggle dropdown-toggle-dots dropdown-toggle-split\"
           data-toggle=\"dropdown\"
           aria-haspopup=\"true\"
           aria-expanded=\"false\"
        >
        </a>

        <div class=\"dropdown-menu dropdown-menu-right\">";
                // line 62
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_slice($this->env, ($context["actions"] ?? null), ($context["skippedActions"] ?? null)));
                $context['loop'] = [
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                ];
                foreach ($context['_seq'] as $context["_key"] => $context["action"]) {
                    if ($this->getAttribute($context["action"], "isApplicable", [0 => ($context["record"] ?? null)], "method")) {
                        // line 63
                        echo twig_include($this->env, $context, (("@PrestaShop/Admin/Common/Grid/Actions/Row/" . $this->getAttribute($context["action"], "type", [])) . ".html.twig"), ["grid" =>                         // line 64
($context["grid"] ?? null), "column" =>                         // line 65
($context["column"] ?? null), "attributes" => ["class" => "dropdown-item", "tooltip_name" => false], "record" =>                         // line 67
($context["record"] ?? null), "action" =>                         // line 68
$context["action"]]);
                        ++$context['loop']['index0'];
                        ++$context['loop']['index'];
                        $context['loop']['first'] = false;
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['action'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 71
                echo "        </div>";
            }
            // line 73
            echo "    </div>
  </div>";
        }
    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Common/Grid/Columns/Content/action.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  123 => 73,  120 => 71,  110 => 68,  109 => 67,  108 => 65,  107 => 64,  106 => 63,  95 => 62,  86 => 54,  84 => 53,  69 => 48,  67 => 45,  66 => 44,  65 => 42,  64 => 41,  63 => 40,  61 => 39,  58 => 36,  56 => 35,  39 => 34,  37 => 31,  34 => 29,  32 => 28,  30 => 26,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@PrestaShop/Admin/Common/Grid/Columns/Content/action.html.twig", "/srv/http/presta/src/PrestaShopBundle/Resources/views/Admin/Common/Grid/Columns/Content/action.html.twig");
    }
}
