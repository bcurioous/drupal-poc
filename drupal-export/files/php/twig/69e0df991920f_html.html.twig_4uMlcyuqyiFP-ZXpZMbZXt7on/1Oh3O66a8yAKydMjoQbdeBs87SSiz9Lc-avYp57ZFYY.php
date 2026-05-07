<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* themes/nci/templates/layout/html.html.twig */
class __TwigTemplate_935b47c471aaa06213ffac69123185d2 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 9
        yield "<!DOCTYPE html>
<html";
        // line 10
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["html_attributes"] ?? null), "html", null, true);
        yield ">
  <head>
    <meta charset=\"UTF-8\" />
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
    <title>";
        // line 14
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->safeJoin($this->env, ($context["head_title"] ?? null), " | "));
        yield "</title>
    <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Source+Sans+3:ital,wght@0,400;0,700;1,400&display=swap\" />
    <script src=\"https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4\"></script>
    <style type=\"text/tailwindcss\">
      @theme {
        --color-nci-primary: #005ea2;
        --color-nci-secondary: #565c65;
        --color-nci-dark: #1b1b1b;
        --color-nci-danger: #d83933;
        --color-nci-warning: #e5a000;
        --color-nci-alert: #b51d09;
        --color-nci-light: #f0f0f0;
        --color-nci-border: #dfe1e2;
      }
      /* NCI Navigation Menu Styling */
      #block-nci-main-menu > ul {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
      }
      #block-nci-main-menu ul li {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.75rem 1rem;
      }
      #block-nci-main-menu ul li a {
        color: white;
        text-decoration: none;
      }
      /* Chevron icon for menu items */
      #block-nci-main-menu ul li a::after {
        content: '';
        display: inline-block;
        width: 0.75rem;
        height: 0.75rem;
        margin-left: 0.25rem;
        background-image: url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M3 4.5L6 7.5L9 4.5'/%3E%3C/svg%3E\");
        background-size: contain;
        background-repeat: no-repeat;
      }
      /* Make Cancer Types bold */
      #block-nci-main-menu ul li:nth-child(2) a {
        font-weight: 700;
      }
    </style>
    <head-placeholder token=\"";
        // line 61
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["placeholder_token"] ?? null), "html", null, true);
        yield "\">
    <css-placeholder token=\"";
        // line 62
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["placeholder_token"] ?? null), "html", null, true);
        yield "\">
    <js-placeholder token=\"";
        // line 63
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["placeholder_token"] ?? null), "html", null, true);
        yield "\">
  </head>
  <body";
        // line 65
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", ["min-h-screen", "bg-white", "font-[Source_Sans_3]", "text-[#1b1b1b]"], "method", false, false, true, 65), "html", null, true);
        yield ">
    <a href=\"#main-content\" class=\"visually-hidden focusable skip-link\">
      ";
        // line 67
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Skip to main content"));
        yield "
    </a>
    ";
        // line 69
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["page_top"] ?? null), "html", null, true);
        yield "
    ";
        // line 70
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["page"] ?? null), "html", null, true);
        yield "
    ";
        // line 71
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["page_bottom"] ?? null), "html", null, true);
        yield "
    <js-bottom-placeholder token=\"";
        // line 72
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["placeholder_token"] ?? null), "html", null, true);
        yield "\">
  </body>
</html>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["html_attributes", "head_title", "placeholder_token", "attributes", "page_top", "page", "page_bottom"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/nci/templates/layout/html.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  139 => 72,  135 => 71,  131 => 70,  127 => 69,  122 => 67,  117 => 65,  112 => 63,  108 => 62,  104 => 61,  54 => 14,  47 => 10,  44 => 9,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/nci/templates/layout/html.html.twig", "/var/www/html/web/themes/nci/templates/layout/html.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = [];
        static $filters = ["escape" => 10, "safe_join" => 14, "t" => 67];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                [],
                ['escape', 'safe_join', 't'],
                [],
                $this->source
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
