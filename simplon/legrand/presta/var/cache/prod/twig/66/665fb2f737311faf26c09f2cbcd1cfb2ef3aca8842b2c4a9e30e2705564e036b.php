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

/* PrestaShopBundle:Admin/TwigTemplateForm:bootstrap_4_horizontal_layout.html.twig */
class __TwigTemplate_6a4022f720f64ab47bd3f91abaa75148841c1885c4f6d3ab78aff84fcda010ff extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $_trait_0 = $this->loadTemplate("@PrestaShop/Admin/TwigTemplateForm/bootstrap_4_layout.html.twig", "PrestaShopBundle:Admin/TwigTemplateForm:bootstrap_4_horizontal_layout.html.twig", 25);
        // line 25
        if (!$_trait_0->isTraitable()) {
            throw new RuntimeError('Template "'."@PrestaShop/Admin/TwigTemplateForm/bootstrap_4_layout.html.twig".'" cannot be used as a trait.');
        }
        $_trait_0_blocks = $_trait_0->getBlocks();

        $this->traits = $_trait_0_blocks;

        $this->blocks = array_merge(
            $this->traits,
            [
                'form_start' => [$this, 'block_form_start'],
                'form_label' => [$this, 'block_form_label'],
                'form_label_class' => [$this, 'block_form_label_class'],
                'form_row' => [$this, 'block_form_row'],
                'checkbox_row' => [$this, 'block_checkbox_row'],
                'radio_row' => [$this, 'block_radio_row'],
                'checkbox_radio_row' => [$this, 'block_checkbox_radio_row'],
                'submit_row' => [$this, 'block_submit_row'],
                'form_group_class' => [$this, 'block_form_group_class'],
                'form_row_class' => [$this, 'block_form_row_class'],
                'text_with_unit_widget' => [$this, 'block_text_with_unit_widget'],
                'ip_address_text_widget' => [$this, 'block_ip_address_text_widget'],
                'switch_widget' => [$this, 'block_switch_widget'],
                'text_with_length_counter_widget' => [$this, 'block_text_with_length_counter_widget'],
            ]
        );
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 26
        $this->displayBlock('form_start', $context, $blocks);
        // line 33
        $this->displayBlock('form_label', $context, $blocks);
        // line 44
        $this->displayBlock('form_label_class', $context, $blocks);
        // line 50
        $this->displayBlock('form_row', $context, $blocks);
        // line 62
        $this->displayBlock('checkbox_row', $context, $blocks);
        // line 66
        $this->displayBlock('radio_row', $context, $blocks);
        // line 70
        $this->displayBlock('checkbox_radio_row', $context, $blocks);
        // line 82
        $this->displayBlock('submit_row', $context, $blocks);
        // line 93
        $this->displayBlock('form_group_class', $context, $blocks);
        // line 97
        $this->displayBlock('form_row_class', $context, $blocks);
        // line 101
        $this->displayBlock('text_with_unit_widget', $context, $blocks);
        // line 112
        $this->displayBlock('ip_address_text_widget', $context, $blocks);
        // line 121
        $this->displayBlock('switch_widget', $context, $blocks);
        // line 127
        $this->displayBlock('text_with_length_counter_widget', $context, $blocks);
    }

    // line 26
    public function block_form_start($context, array $blocks = [])
    {
        // line 27
        $context["attr"] = twig_array_merge(($context["attr"] ?? null), ["class" => twig_trim_filter(((($this->getAttribute(($context["attr"] ?? null), "class", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["attr"] ?? null), "class", []), "")) : ("")) . " form-horizontal"))]);
        // line 28
        $this->displayParentBlock("form_start", $context, $blocks);
    }

    // line 33
    public function block_form_label($context, array $blocks = [])
    {
        // line 34
        ob_start();
        // line 35
        if ((($context["label"] ?? null) === false)) {
            // line 36
            echo "            <div class=\"";
            $this->displayBlock("form_label_class", $context, $blocks);
            echo "\"></div>";
        } else {
            // line 38
            $context["label_attr"] = twig_array_merge(($context["label_attr"] ?? null), ["class" => twig_trim_filter((((($this->getAttribute(($context["label_attr"] ?? null), "class", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["label_attr"] ?? null), "class", []), "")) : ("")) . " ") .             $this->renderBlock("form_label_class", $context, $blocks)))]);
            // line 39
            $this->displayParentBlock("form_label", $context, $blocks);
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 44
    public function block_form_label_class($context, array $blocks = [])
    {
        // line 45
        echo "col-sm-2";
    }

    // line 50
    public function block_form_row($context, array $blocks = [])
    {
        // line 51
        ob_start();
        // line 52
        echo "        <div class=\"";
        $this->displayBlock("form_row_class", $context, $blocks);
        if ((( !($context["compound"] ?? null) || (((isset($context["force_error"]) || array_key_exists("force_error", $context))) ? (_twig_default_filter(($context["force_error"] ?? null), false)) : (false))) &&  !($context["valid"] ?? null))) {
            echo " has-error";
        }
        echo "\">";
        // line 53
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'label');
        echo "
            <div class=\"";
        // line 54
        $this->displayBlock("form_group_class", $context, $blocks);
        echo "\">";
        // line 55
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'widget');
        // line 56
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'errors');
        echo "
            </div>
        </div>";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 62
    public function block_checkbox_row($context, array $blocks = [])
    {
        // line 63
        $this->displayBlock("checkbox_radio_row", $context, $blocks);
    }

    // line 66
    public function block_radio_row($context, array $blocks = [])
    {
        // line 67
        $this->displayBlock("checkbox_radio_row", $context, $blocks);
    }

    // line 70
    public function block_checkbox_radio_row($context, array $blocks = [])
    {
        // line 71
        ob_start();
        // line 72
        echo "        <div class=\"form-group";
        if ( !($context["valid"] ?? null)) {
            echo " has-error";
        }
        echo "\">
            <div class=\"";
        // line 73
        $this->displayBlock("form_label_class", $context, $blocks);
        echo "\"></div>
            <div class=\"";
        // line 74
        $this->displayBlock("form_group_class", $context, $blocks);
        echo "\">";
        // line 75
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'widget');
        // line 76
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'errors');
        echo "
            </div>
        </div>";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 82
    public function block_submit_row($context, array $blocks = [])
    {
        // line 83
        ob_start();
        // line 84
        echo "        <div class=\"form-group\">
            <div class=\"";
        // line 85
        $this->displayBlock("form_label_class", $context, $blocks);
        echo "\"></div>
            <div class=\"";
        // line 86
        $this->displayBlock("form_group_class", $context, $blocks);
        echo "\">";
        // line 87
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'widget');
        echo "
            </div>
        </div>";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 93
    public function block_form_group_class($context, array $blocks = [])
    {
        // line 94
        echo "col-sm-10";
    }

    // line 97
    public function block_form_row_class($context, array $blocks = [])
    {
        // line 98
        echo "form-group";
    }

    // line 101
    public function block_text_with_unit_widget($context, array $blocks = [])
    {
        // line 102
        echo "<div class=\"input-group\">";
        // line 103
        $this->displayBlock("form_widget_simple", $context, $blocks);
        // line 104
        if ($this->getAttribute($this->getAttribute(($context["form"] ?? null), "vars", [], "any", false, true), "unit", [], "any", true, true)) {
            // line 105
            echo "        <div class=\"input-group-append\">
            <span class=\"input-group-text\">";
            // line 106
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "vars", []), "unit", []), "html", null, true);
            echo "</span>
        </div>";
        }
        // line 109
        echo "</div>";
    }

    // line 112
    public function block_ip_address_text_widget($context, array $blocks = [])
    {
        // line 113
        echo "<div class=\"input-group\">";
        // line 114
        $this->displayBlock("form_widget_simple", $context, $blocks);
        // line 115
        echo "<button type=\"button\" class=\"btn btn-outline-primary add_ip_button\" data-ip=\"";
        echo twig_escape_filter($this->env, ($context["currentIp"] ?? null), "html", null, true);
        echo "\">
        <i class=\"material-icons\">add_circle</i>";
        // line 116
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Add my IP", [], "Admin.Actions"), "html", null, true);
        echo "
    </button>
</div>";
    }

    // line 121
    public function block_switch_widget($context, array $blocks = [])
    {
        // line 122
        echo "<div class=\"input-group\">";
        // line 123
        $this->displayParentBlock("switch_widget", $context, $blocks);
        // line 124
        echo "</div>";
    }

    // line 127
    public function block_text_with_length_counter_widget($context, array $blocks = [])
    {
        // line 128
        echo "  <div class=\"input-group js-text-with-length-counter\">";
        // line 129
        $context["current_length"] = ($this->getAttribute($this->getAttribute(($context["form"] ?? null), "vars", []), "max_length", []) - twig_length_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "vars", []), "value", [])));
        // line 131
        if (($this->getAttribute($this->getAttribute(($context["form"] ?? null), "vars", []), "position", []) == "before")) {
            // line 132
            echo "      <div class=\"input-group-prepend\">
        <span class=\"input-group-text js-countable-text\">";
            // line 133
            echo twig_escape_filter($this->env, ($context["current_length"] ?? null), "html", null, true);
            echo "</span>
      </div>";
        }
        // line 137
        $context["attr"] = twig_array_merge(($context["attr"] ?? null), ["data-max-length" => $this->getAttribute($this->getAttribute(($context["form"] ?? null), "vars", []), "max_length", []), "maxlength" => $this->getAttribute($this->getAttribute(($context["form"] ?? null), "vars", []), "max_length", []), "class" => "js-countable-input"]);
        // line 139
        if (($this->getAttribute($this->getAttribute(($context["form"] ?? null), "vars", []), "input", []) == "textarea")) {
            // line 140
            $this->displayBlock("textarea_widget", $context, $blocks);
        } else {
            // line 142
            $this->displayBlock("form_widget_simple", $context, $blocks);
        }
        // line 145
        if (($this->getAttribute($this->getAttribute(($context["form"] ?? null), "vars", []), "position", []) == "after")) {
            // line 146
            echo "      <div class=\"input-group-append\">
        <span class=\"input-group-text js-countable-text\">";
            // line 147
            echo twig_escape_filter($this->env, ($context["current_length"] ?? null), "html", null, true);
            echo "</span>
      </div>";
        }
        // line 150
        echo "  </div>";
    }

    public function getTemplateName()
    {
        return "PrestaShopBundle:Admin/TwigTemplateForm:bootstrap_4_horizontal_layout.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  319 => 150,  314 => 147,  311 => 146,  309 => 145,  306 => 142,  303 => 140,  301 => 139,  299 => 137,  294 => 133,  291 => 132,  289 => 131,  287 => 129,  285 => 128,  282 => 127,  278 => 124,  276 => 123,  274 => 122,  271 => 121,  264 => 116,  259 => 115,  257 => 114,  255 => 113,  252 => 112,  248 => 109,  243 => 106,  240 => 105,  238 => 104,  236 => 103,  234 => 102,  231 => 101,  227 => 98,  224 => 97,  220 => 94,  217 => 93,  209 => 87,  206 => 86,  202 => 85,  199 => 84,  197 => 83,  194 => 82,  186 => 76,  184 => 75,  181 => 74,  177 => 73,  170 => 72,  168 => 71,  165 => 70,  161 => 67,  158 => 66,  154 => 63,  151 => 62,  143 => 56,  141 => 55,  138 => 54,  134 => 53,  127 => 52,  125 => 51,  122 => 50,  118 => 45,  115 => 44,  109 => 39,  107 => 38,  102 => 36,  100 => 35,  98 => 34,  95 => 33,  91 => 28,  89 => 27,  86 => 26,  82 => 127,  80 => 121,  78 => 112,  76 => 101,  74 => 97,  72 => 93,  70 => 82,  68 => 70,  66 => 66,  64 => 62,  62 => 50,  60 => 44,  58 => 33,  56 => 26,  25 => 25,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "PrestaShopBundle:Admin/TwigTemplateForm:bootstrap_4_horizontal_layout.html.twig", "/srv/http/presta/src/PrestaShopBundle/Resources/views/Admin/TwigTemplateForm/bootstrap_4_horizontal_layout.html.twig");
    }
}
