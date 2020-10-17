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

/* @PrestaShop/Admin/Configure/ShopParameters/Blocks/customer_preferences_general.html.twig */
class __TwigTemplate_80bd8fddc1c08a86d6985b11e9992555e31172575c2a5b9acaf1b116105796b5 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'customer_preferences_general' => [$this, 'block_customer_preferences_general'],
            'customer_general_preferences_form_rest' => [$this, 'block_customer_general_preferences_form_rest'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 27
        $context["ps"] = $this->loadTemplate("@PrestaShop/Admin/macros.html.twig", "@PrestaShop/Admin/Configure/ShopParameters/Blocks/customer_preferences_general.html.twig", 27);
        // line 29
        $this->displayBlock('customer_preferences_general', $context, $blocks);
    }

    public function block_customer_preferences_general($context, array $blocks = [])
    {
        // line 30
        echo "<div class=\"col-xl-10\">
    <div class=\"card\">
        <h3 class=\"card-header\">
            <i class=\"material-icons\">settings</i>";
        // line 33
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("General", [], "Admin.Global"), "html", null, true);
        echo "
        </h3>
        <div class=\"card-block row\">
            <div class=\"card-text\">
                <div class=\"form-group row\">";
        // line 38
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Re-display cart at login", [], "Admin.Shopparameters.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("After a customer logs in, you can recall and display the content of his/her last shopping cart.", [], "Admin.Shopparameters.Help"));
        echo "
                    <div class=\"col-sm\">";
        // line 40
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generalForm"] ?? null), "redisplay_cart_at_login", []), 'errors');
        // line 41
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generalForm"] ?? null), "redisplay_cart_at_login", []), 'widget');
        echo "
                    </div>
                </div>
                <div class=\"form-group row\">";
        // line 45
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Send an email after registration", [], "Admin.Shopparameters.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Send an email with summary of the account information (email, password) after registration.", [], "Admin.Shopparameters.Help"));
        echo "
                    <div class=\"col-sm\">";
        // line 47
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generalForm"] ?? null), "send_email_after_registration", []), 'errors');
        // line 48
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generalForm"] ?? null), "send_email_after_registration", []), 'widget');
        echo "
                    </div>
                </div>
                <div class=\"form-group row\">";
        // line 52
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Password reset delay", [], "Admin.Shopparameters.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Minimum time required between two requests for a password reset.", [], "Admin.Shopparameters.Help"));
        echo "
                    <div class=\"col-sm\">";
        // line 54
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generalForm"] ?? null), "password_reset_delay", []), 'errors');
        // line 55
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generalForm"] ?? null), "password_reset_delay", []), 'widget');
        echo "
                    </div>
                </div>
                <div class=\"form-group row\">";
        // line 59
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Enable B2B mode", [], "Admin.Shopparameters.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Activate or deactivate B2B mode. When this option is enabled, B2B features will be made available.", [], "Admin.Shopparameters.Help"));
        echo "
                    <div class=\"col-sm\">";
        // line 61
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generalForm"] ?? null), "enable_b2b_mode", []), 'errors');
        // line 62
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generalForm"] ?? null), "enable_b2b_mode", []), 'widget');
        echo "
                    </div>
                </div>
                <div class=\"form-group row\">";
        // line 66
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Ask for birth date", [], "Admin.Shopparameters.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Display or not the birth date field.", [], "Admin.Shopparameters.Help"));
        echo "
                    <div class=\"col-sm\">";
        // line 68
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generalForm"] ?? null), "ask_for_birthday", []), 'errors');
        // line 69
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generalForm"] ?? null), "ask_for_birthday", []), 'widget');
        echo "
                    </div>
                </div>
                <div class=\"form-group row\">";
        // line 73
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Enable partner offers", [], "Admin.Shopparameters.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Display or not the partner offers tick box, to receive offers from the store's partners.", [], "Admin.Shopparameters.Help"));
        echo "
                    <div class=\"col-sm\">";
        // line 75
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generalForm"] ?? null), "enable_offers", []), 'errors');
        // line 76
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generalForm"] ?? null), "enable_offers", []), 'widget');
        echo "
                    </div>
                </div>";
        // line 80
        $this->displayBlock('customer_general_preferences_form_rest', $context, $blocks);
        // line 83
        echo "            </div>
        </div>
        <div class=\"card-footer\">
            <div class=\"d-flex justify-content-end\">
                <button class=\"btn btn-primary\">";
        // line 87
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Save", [], "Admin.Actions"), "html", null, true);
        echo "</button>
            </div>
        </div>
    </div>
</div>";
    }

    // line 80
    public function block_customer_general_preferences_form_rest($context, array $blocks = [])
    {
        // line 81
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["generalForm"] ?? null), 'rest');
    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Configure/ShopParameters/Blocks/customer_preferences_general.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  143 => 81,  140 => 80,  131 => 87,  125 => 83,  123 => 80,  118 => 76,  116 => 75,  112 => 73,  106 => 69,  104 => 68,  100 => 66,  94 => 62,  92 => 61,  88 => 59,  82 => 55,  80 => 54,  76 => 52,  70 => 48,  68 => 47,  64 => 45,  58 => 41,  56 => 40,  52 => 38,  45 => 33,  40 => 30,  34 => 29,  32 => 27,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@PrestaShop/Admin/Configure/ShopParameters/Blocks/customer_preferences_general.html.twig", "/srv/http/presta/src/PrestaShopBundle/Resources/views/Admin/Configure/ShopParameters/Blocks/customer_preferences_general.html.twig");
    }
}
