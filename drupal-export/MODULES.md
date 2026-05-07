# Drupal 11 Essential Modules Guide

A curated list of recommended modules for professional Drupal 11 CMS websites.

---

## Essential Modules (Every Site)

| Module | Purpose | Install Command |
|--------|---------|----------------|
| **Drush** | CLI for Drupal | `composer require drush/drush` |
| **Token** | Placeholder tokens for fields/settings | `composer require drupal/token` |
| **Pathauto** | Auto-generate clean URLs | `composer require drupal/pathauto` |
| **Admin Toolbar** | Improved admin navigation | `composer require drupal/admin_toolbar` |
| **Devel** | Developer utilities | `composer require --dev drupal/devel` |

---

## Content Management & Workflow

### Content Moderation Stack

```bash
composer require drupal/content_moderation
composer require drupal/scheduler
composer require drupal/moderation_sidebar
```

| Module | Purpose |
|--------|---------|
| **Content Moderation** (core) | Editorial workflows (Draft → Review → Published) |
| **Scheduler** | Schedule publishing/unpublishing |
| **Moderation Sidebar** | Quick moderation from sidebar |

### Content Editing

| Module | Purpose |
|--------|---------|
| **CKEditor 5** (core) | Rich text editor - improved in D11 |
| **Media** (core) | Centralized media management |
| **Layout Builder** (core) | Drag-and-drop page layouts |

---

## Security & Hardening

```bash
composer require drupal/securitykit
composer require drupal/honeypot
composer require drupal/tfa
```

| Module | Purpose | Notes |
|--------|---------|-------|
| **Security Kit** | HTTP security headers | XSS, clickjacking, MIME protection |
| **Honeypot** | Anti-spam via hidden fields | Lightweight |
| **reCAPTCHA** | Google spam protection | Requires API keys |
| **Password Policy** | Enforce strong passwords | |
| **Flood Control** | Login attempt limits | |
| **TFA** | Two-factor authentication | |

**⚠️ Always use modules with security advisory coverage (shield icon on Drupal.org)**

---

## SEO Optimization

```bash
composer require drupal/metatag
composer require drupal/simple_xml_sitemap
composer require drupal/redirect
```

| Module | Purpose |
|--------|---------|
| **Metatag** | Meta tags, Open Graph, Twitter Cards |
| **Simple XML Sitemap** | Auto-generate sitemaps |
| **Pathauto** | Clean, SEO-friendly URLs |
| **Redirect** | Manage 301/302 redirects |
| **Schema.org Blueprints** | Structured data markup |

**Recommended Stack**: Metatag + Simple XML Sitemap + Pathauto + Redirect

---

## Performance & Caching

```bash
composer require drupal/redis
composer require drupal/advagg
composer require drupal/blazy
```

| Module | Purpose | Impact |
|--------|---------|--------|
| **Redis** | Object caching (RAM) | Massive DB load reduction |
| **AdvAgg** | Advanced CSS/JS aggregation | Better compression |
| **Blazy** | Lazy loading images | Faster initial load |
| **CDN** | CDN integration | Global static asset delivery |
| **Purge** | Cache invalidation for Varnish/CDN | |

**Recommended Stack**: Redis + AdvAgg + Blazy + CDN

---

## Media Management

```bash
composer require drupal/imce
composer require drupal/image_widget_crop
composer require drupal/svg_image
```

| Module | Purpose |
|--------|---------|
| **Media Library** (core) | Centralized media management |
| **IMCE** | File manager with personal directories |
| **Image Widget Crop** | Crop images on upload |
| **SVG Image** | SVG file support |
| **Video Embed Field** | YouTube/Vimeo embedding |

---

## Forms

| Module | Purpose |
|--------|---------|
| **Webform** | Enterprise form builder - #1 choice |
| **Contact** (core) | Basic contact forms |
| **Clientside Validation** | jQuery form validation |

```bash
composer require drupal/webform
composer require drupal/clientside_validation
```

---

## Backup & Migration

```bash
composer require drupal/backup_migrate
composer require drupal/config_split
composer require drupal/upgrade_status
```

| Module | Purpose |
|--------|---------|
| **Backup and Migrate** | Database/file backup/restore |
| **Config Split** | Environment-specific config |
| **Upgrade Status** | Pre-upgrade compatibility check |
| **Migrate Tools** | Migration Drush commands |

---

## Development & Debugging

```bash
composer require --dev drupal/devel
composer require --dev drupal/kint
composer require drupal/webprofiler
```

| Module | Purpose |
|--------|---------|
| **Devel** | Variable dumping, code generation |
| **Kint** | Better var_dump() debugging |
| **Webprofiler** | Performance profiling |
| **Environment Indicator** | Color-coded environment labels |
| **Twig Tweak** | Twig debugging extensions |

**⚠️ Never install Devel on production!**

---

## Deprecated in Drupal 11

These modules were removed from core or are deprecated:

| Former Core | Replacement |
|------------|-------------|
| CKEditor 4 | CKEditor 5 (core) |
| Book | Contributed Book module |
| Forum | Contributed Forum module |
| Statistics | Contributed Statistics module |
| Tour | Contributed Tour module |
| Migrate Drupal UI | Use Drush for migrations |

### Deprecated in D11.3+/11.4+ (will be removed in D12):

| Module | Replacement |
|--------|-------------|
| Ban | Contributed Ban module |
| Field Layout | Use Layout Builder |
| History | No direct replacement |
| Color | Contributed Color module |

---

## Module Installation Quick Reference

```bash
# Install module via Composer
ddev composer require drupal/module_name

# Enable module
ddev drush en module_name

# Run database updates
ddev drush updb

# Export config
ddev drush cex -y

# Clear cache
ddev drush cr
```

---

## Recommended Module Stacks by Use Case

### Basic CMS Site
```
token, pathauto, metatag, simple_xml_sitemap, admin_toolbar, webform
```

### Enterprise/Editorial
```
content_moderation, scheduler, moderation_sidebar, security_kit, backup_migrate, redis
```

### High-Traffic/Performance
```
redis, advagg, blazy, cdn, purge
```

### Developer Machine
```
devel, kint, webprofiler, upgrade_status, environment_indicator
```

---

## Before Installing Modules

1. **Check Drupal 11 compatibility** - Look for "Drupal 11" badge on Drupal.org
2. **Check security coverage** - Shield icon means security advisory coverage
3. **Check maintenance status** - Active maintenance recommended
4. **Test in dev first** - Never install directly on production

---

## Security Best Practices

1. Keep modules updated: `ddev composer update "drupal/*" --with-all-dependencies`
2. Run security updates immediately: `ddev drush updatedb`
3. Use only modules with security coverage
4. Disable Devel on production
5. Regular backups with `ddev drush sql:dump`
