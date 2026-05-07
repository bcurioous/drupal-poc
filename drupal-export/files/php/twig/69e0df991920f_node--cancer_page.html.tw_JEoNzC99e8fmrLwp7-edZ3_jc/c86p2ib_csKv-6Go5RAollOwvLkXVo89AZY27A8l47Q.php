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

/* themes/nci/templates/content/node--cancer_page.html.twig */
class __TwigTemplate_20f270ccd21a62cfc29c9aa8846eb61a extends Template
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
        // line 12
        yield "<article";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", ["node", "node--type-cancer_page", "node--view-mode-full"], "method", false, false, true, 12), "html", null, true);
        yield ">

  ";
        // line 15
        yield "  ";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["title_prefix"] ?? null), "html", null, true);
        yield "

  <div";
        // line 17
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content_attributes"] ?? null), "addClass", ["node__content"], "method", false, false, true, 17), "html", null, true);
        yield ">

    ";
        // line 20
        yield "    ";
        if ((($tmp = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_featured_image", [], "any", false, false, true, 20))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 21
            yield "      <div class=\"float-right mb-4 ml-6 w-[280px]\">
        ";
            // line 22
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_featured_image", [], "any", false, false, true, 22), "html", null, true);
            yield "
        ";
            // line 23
            if ((($tmp = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_image_caption", [], "any", false, false, true, 23))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 24
                yield "          <p class=\"mt-2 text-[14px] leading-[1.4] text-[#565c65]\">
            ";
                // line 25
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["node"] ?? null), "field_image_caption", [], "any", false, false, true, 25), "value", [], "any", false, false, true, 25), "html", null, true);
                yield "
          </p>
        ";
            }
            // line 28
            yield "        <p class=\"mt-1 text-[12px] text-[#565c65]\">Credit: iStock</p>
      </div>
    ";
        }
        // line 31
        yield "
    ";
        // line 33
        yield "    ";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "body", [], "any", false, false, true, 33), "html", null, true);
        yield "

    ";
        // line 36
        yield "    ";
        if ((($tmp = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_posted_date", [], "any", false, false, true, 36))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 37
            yield "      <p class=\"mb-2 mt-6\">
        <strong>Posted:</strong> ";
            // line 38
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["node"] ?? null), "field_posted_date", [], "any", false, false, true, 38), "value", [], "any", false, false, true, 38), "F j, Y"), "html", null, true);
            yield "
      </p>
    ";
        }
        // line 41
        yield "
  </div>

  ";
        // line 44
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["title_suffix"] ?? null), "html", null, true);
        yield "
</article>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["attributes", "title_prefix", "content_attributes", "content", "node", "title_suffix"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/nci/templates/content/node--cancer_page.html.twig";
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
        return array (  113 => 44,  108 => 41,  102 => 38,  99 => 37,  96 => 36,  90 => 33,  87 => 31,  82 => 28,  76 => 25,  73 => 24,  71 => 23,  67 => 22,  64 => 21,  61 => 20,  56 => 17,  50 => 15,  44 => 12,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/nci/templates/content/node--cancer_page.html.twig", "/var/www/html/web/themes/nci/templates/content/node--cancer_page.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["if" => 20];
        static $filters = ["escape" => 12, "render" => 20, "date" => 38];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape', 'render', 'date'],
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
