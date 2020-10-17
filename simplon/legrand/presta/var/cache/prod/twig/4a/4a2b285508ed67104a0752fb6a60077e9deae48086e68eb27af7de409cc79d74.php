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

/* @PrestaShop/Admin/Module/Includes/card_manage_installed.html.twig */
class __TwigTemplate_747f889d5dbcf5628ee4c3e13e1bdaeaa6e653e283f53822e59aed1566191cfe extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        // line 25
        $this->parent = $this->loadTemplate("@PrestaShop/Admin/Module/Includes/card_list.html.twig", "@PrestaShop/Admin/Module/Includes/card_manage_installed.html.twig", 25);
        $this->blocks = [
            'addon_version' => [$this, 'block_addon_version'],
        ];
    }

    protected function doGetParent(array $context)
    {
        return "@PrestaShop/Admin/Module/Includes/card_list.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 30
    public function block_addon_version($context, array $blocks = [])
    {
        // line 31
        if (($this->getAttribute($this->getAttribute(($context["module"] ?? null), "attributes", []), "productType", []) == "service")) {
            // line 32
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Service by %author%", ["%author%" => (("<b>" . $this->getAttribute($this->getAttribute(($context["module"] ?? null), "attributes", []), "author", [])) . "</b>")], "Admin.Modules.Feature");
        } else {
            // line 34
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("v%version% - by %author%", ["%version%" => $this->getAttribute($this->getAttribute(($context["module"] ?? null), "attributes", []), "version", []), "%author%" => (("<b>" . $this->getAttribute($this->getAttribute(($context["module"] ?? null), "attributes", []), "author", [])) . "</b>")], "Admin.Modules.Feature");
        }
    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Module/Includes/card_manage_installed.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  47 => 34,  44 => 32,  42 => 31,  39 => 30,  22 => 25,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@PrestaShop/Admin/Module/Includes/card_manage_installed.html.twig", "/srv/http/presta/src/PrestaShopBundle/Resources/views/Admin/Module/Includes/card_manage_installed.html.twig");
    }
}
