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

/* @PrestaShop/Admin/Configure/ShopParameters/customer_preferences.html.twig */
class __TwigTemplate_e51fcd12d7f66b590e1d9576ca93452c80a113572c3dbf4c4bbee9b921df215c extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        // line 25
        $this->parent = $this->loadTemplate("@PrestaShop/Admin/layout.html.twig", "@PrestaShop/Admin/Configure/ShopParameters/customer_preferences.html.twig", 25);
        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        return "@PrestaShop/Admin/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 28
        $context["generalForm"] = $this->getAttribute(($context["form"] ?? null), "general", []);
        // line 25
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 30
    public function block_content($context, array $blocks = [])
    {
        // line 31
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["form"] ?? null), 'form_start', ["attr" => ["class" => "form", "id" => "configuration_form"]]);
        echo "
    <div class=\"row justify-content-center\">";
        // line 33
        $this->loadTemplate("@PrestaShop/Admin/Configure/ShopParameters/Blocks/customer_preferences_general.html.twig", "@PrestaShop/Admin/Configure/ShopParameters/customer_preferences.html.twig", 33)->display($context);
        // line 34
        echo "    </div>";
        // line 35
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["form"] ?? null), 'form_end');
    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Configure/ShopParameters/customer_preferences.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 35,  51 => 34,  49 => 33,  45 => 31,  42 => 30,  38 => 25,  36 => 28,  22 => 25,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@PrestaShop/Admin/Configure/ShopParameters/customer_preferences.html.twig", "/srv/http/presta/src/PrestaShopBundle/Resources/views/Admin/Configure/ShopParameters/customer_preferences.html.twig");
    }
}
