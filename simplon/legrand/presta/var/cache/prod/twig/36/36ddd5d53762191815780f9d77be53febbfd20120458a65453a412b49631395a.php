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

/* @PrestaShop/Admin/Configure/ShopParameters/OrderPreferences/Blocks/order_preferences_gift_options.html.twig */
class __TwigTemplate_5e57b0b5cbd5a33b52a3ba210cd15c87fd0f3e38585361cd79784a563c0cadb9 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'order_preferences_gift_options' => [$this, 'block_order_preferences_gift_options'],
            'order_gift_options_preferences_form_rest' => [$this, 'block_order_gift_options_preferences_form_rest'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 27
        $context["ps"] = $this->loadTemplate("@PrestaShop/Admin/macros.html.twig", "@PrestaShop/Admin/Configure/ShopParameters/OrderPreferences/Blocks/order_preferences_gift_options.html.twig", 27);
        // line 29
        $this->displayBlock('order_preferences_gift_options', $context, $blocks);
    }

    public function block_order_preferences_gift_options($context, array $blocks = [])
    {
        // line 30
        echo "<div class=\"col-xl-10\">
    <div class=\"card\">
        <h3 class=\"card-header\">
            <i class=\"material-icons\">cake</i>";
        // line 33
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Gift options", [], "Admin.Shopparameters.Feature"), "html", null, true);
        echo "
        </h3>
        <div class=\"card-block row\">
            <div class=\"card-text\">
                <div class=\"form-group row\">";
        // line 38
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Offer gift wrapping", [], "Admin.Shopparameters.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Suggest gift-wrapping to customers.", [], "Admin.Shopparameters.Help"));
        echo "
                    <div class=\"col-sm\">";
        // line 40
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["giftOptionsForm"] ?? null), "enable_gift_wrapping", []), 'errors');
        // line 41
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["giftOptionsForm"] ?? null), "enable_gift_wrapping", []), 'widget');
        echo "
                    </div>
                </div>
                <div class=\"form-group row\">";
        // line 45
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Gift-wrapping price", [], "Admin.Shopparameters.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Set a price for gift wrapping.", [], "Admin.Shopparameters.Help"));
        echo "
                    <div class=\"col-sm\">";
        // line 47
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["giftOptionsForm"] ?? null), "gift_wrapping_price", []), 'errors');
        // line 48
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["giftOptionsForm"] ?? null), "gift_wrapping_price", []), 'widget');
        echo "
                    </div>
                </div>";
        // line 52
        if ( !($context["isAtcpShipWrapEnabled"] ?? null)) {
            // line 53
            echo "                    <div class=\"form-group row\">";
            // line 54
            echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Gift-wrapping tax", [], "Admin.Shopparameters.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Set a tax for gift wrapping.", [], "Admin.Shopparameters.Help"));
            echo "
                        <div class=\"col-sm\">";
            // line 56
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["giftOptionsForm"] ?? null), "gift_wrapping_tax_rules_group", []), 'errors');
            // line 57
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["giftOptionsForm"] ?? null), "gift_wrapping_tax_rules_group", []), 'widget');
            echo "
                        </div>
                    </div>";
        }
        // line 61
        echo "
                <div class=\"form-group row\">";
        // line 63
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Offer recycled packaging", [], "Admin.Shopparameters.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Suggest recycled packaging to customer.", [], "Admin.Shopparameters.Help"));
        echo "
                    <div class=\"col-sm\">";
        // line 65
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["giftOptionsForm"] ?? null), "offer_recyclable_pack", []), 'errors');
        // line 66
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["giftOptionsForm"] ?? null), "offer_recyclable_pack", []), 'widget');
        echo "
                    </div>
                </div>";
        // line 70
        $this->displayBlock('order_gift_options_preferences_form_rest', $context, $blocks);
        // line 73
        echo "            </div>
        </div>
        <div class=\"card-footer\">
            <div class=\"d-flex justify-content-end\">
                <button class=\"btn btn-primary\">";
        // line 77
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Save", [], "Admin.Actions"), "html", null, true);
        echo "</button>
            </div>
        </div>
    </div>
</div>";
    }

    // line 70
    public function block_order_gift_options_preferences_form_rest($context, array $blocks = [])
    {
        // line 71
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["giftOptionsForm"] ?? null), 'rest');
    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Configure/ShopParameters/OrderPreferences/Blocks/order_preferences_gift_options.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  125 => 71,  122 => 70,  113 => 77,  107 => 73,  105 => 70,  100 => 66,  98 => 65,  94 => 63,  91 => 61,  85 => 57,  83 => 56,  79 => 54,  77 => 53,  75 => 52,  70 => 48,  68 => 47,  64 => 45,  58 => 41,  56 => 40,  52 => 38,  45 => 33,  40 => 30,  34 => 29,  32 => 27,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@PrestaShop/Admin/Configure/ShopParameters/OrderPreferences/Blocks/order_preferences_gift_options.html.twig", "/srv/http/presta/src/PrestaShopBundle/Resources/views/Admin/Configure/ShopParameters/OrderPreferences/Blocks/order_preferences_gift_options.html.twig");
    }
}
