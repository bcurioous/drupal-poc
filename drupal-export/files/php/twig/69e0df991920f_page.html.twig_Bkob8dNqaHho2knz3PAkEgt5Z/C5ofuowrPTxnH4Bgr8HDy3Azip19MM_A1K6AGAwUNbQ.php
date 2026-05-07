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

/* themes/nci/templates/layout/page.html.twig */
class __TwigTemplate_91aca24fa4d325c593df7b84e14c81eb extends Template
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
        yield "
";
        // line 11
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header_top", [], "any", false, false, true, 11), "html", null, true);
        yield "

<header>
  ";
        // line 15
        yield "  ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "navigation", [], "any", false, false, true, 15)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 16
            yield "    <nav class=\"bg-[#1b1b1b]\">
      <div class=\"mx-auto max-w-[1200px] px-4\">
        ";
            // line 18
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "navigation", [], "any", false, false, true, 18), "html", null, true);
            yield "
      </div>
    </nav>
  ";
        }
        // line 22
        yield "</header>

";
        // line 25
        yield "<main class=\"mx-auto max-w-[1200px] px-4 py-6\">
  <div class=\"flex gap-8\">
    ";
        // line 28
        yield "    ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "sidebar", [], "any", false, false, true, 28)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 29
            yield "      <aside class=\"w-[250px] shrink-0\">
        ";
            // line 30
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "sidebar", [], "any", false, false, true, 30), "html", null, true);
            yield "
      </aside>
    ";
        }
        // line 33
        yield "
    ";
        // line 35
        yield "    <section class=\"min-w-0 flex-1 text-[16px] leading-[1.6]\">
      ";
        // line 36
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 36)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 37
            yield "        ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 37), "html", null, true);
            yield "
      ";
        }
        // line 39
        yield "    </section>
  </div>
</main>

";
        // line 44
        yield "<footer>
  ";
        // line 45
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer_top", [], "any", false, false, true, 45)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 46
            yield "    <div class=\"mx-auto max-w-[1200px] border-t border-[#dfe1e2] px-4 py-4\">
      ";
            // line 47
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer_top", [], "any", false, false, true, 47), "html", null, true);
            yield "
    </div>
  ";
        }
        // line 50
        yield "
  ";
        // line 51
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer_main", [], "any", false, false, true, 51)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 52
            yield "    <div class=\"bg-[#1b1b1b] text-white\">
      <div class=\"mx-auto max-w-[1200px] px-4 py-10\">
        ";
            // line 54
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer_main", [], "any", false, false, true, 54), "html", null, true);
            yield "
      </div>
    </div>
  ";
        }
        // line 58
        yield "</footer>

";
        // line 61
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "back_to_top", [], "any", false, false, true, 61)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 62
            yield "  ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "back_to_top", [], "any", false, false, true, 62), "html", null, true);
            yield "
";
        } else {
            // line 64
            yield "  <button
    onclick=\"window.scrollTo({ top: 0, behavior: 'smooth' })\"
    class=\"fixed bottom-4 right-4 z-50 cursor-pointer bg-[#005ea2] px-3 py-2 text-[12px] font-bold text-white hover:bg-[#1a4480]\"
  >
    BACK TO TOP
  </button>
";
        }
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["page"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/nci/templates/layout/page.html.twig";
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
        return array (  149 => 64,  143 => 62,  141 => 61,  137 => 58,  130 => 54,  126 => 52,  124 => 51,  121 => 50,  115 => 47,  112 => 46,  110 => 45,  107 => 44,  101 => 39,  95 => 37,  93 => 36,  90 => 35,  87 => 33,  81 => 30,  78 => 29,  75 => 28,  71 => 25,  67 => 22,  60 => 18,  56 => 16,  53 => 15,  47 => 11,  44 => 9,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/nci/templates/layout/page.html.twig", "/var/www/html/web/themes/nci/templates/layout/page.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["if" => 15];
        static $filters = ["escape" => 11];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape'],
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
