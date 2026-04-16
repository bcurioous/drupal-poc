# Drupal POC - Agent Instructions

This document contains project-specific instructions for working with the Drupal POC site.

---

## Setup Scripts (One-Time Run)

The `scripts/setup/` directory contains one-time run PHP scripts that use Drupal's programmatic API to create content and menus. These scripts are designed to be run **once** during initial site setup using Drush.

### Available Scripts

| Script | Purpose | Run Command |
|--------|---------|-------------|
| `create-bladder-menu.php` | Creates Bladder Cancer menu items in main menu | `ddev drush php-script scripts/setup/create-bladder-menu.php` |
| `create-bladder-cancer-node.php` | Creates "What Is Bladder Cancer?" content node | `ddev drush php-script scripts/setup/create-bladder-cancer-node.php` |
| `create-node.php` | Creates "Types of Breast Cancer" content node | `ddev drush php-script scripts/setup/create-node.php` |
| `update-bladder-menus.php` | Updates Bladder Cancer menu items (partial/incomplete) | `ddev drush php-script scripts/setup/update-bladder-menus.php` |

### Running Setup Scripts

```bash
# Ensure DDEV is running
ddev start

# Run a setup script
ddev drush php-script scripts/setup/create-bladder-menu.php

# Run multiple scripts in sequence
ddev drush php-script scripts/setup/create-bladder-cancer-node.php
ddev drush php-script scripts/setup/create-bladder-menu.php
```

### Script Patterns

Each script uses Drupal's entity API:
- **Nodes**: `Drupal\node\Entity\Node::create([...])->save()`
- **Menu Links**: `Drupal\menu_link_content\Entity\MenuLinkContent::create([...])->save()`
- **Path Aliases**: `\Drupal::entityTypeManager()->getStorage('path_alias')->create([...])->save()`

### Creating New Setup Scripts

Follow this pattern for new setup scripts:

```php
<?php
// [Description of what this script does]
use Drupal\node\Entity\Node;
use Drupal\menu_link_content\Entity\MenuLinkContent;

// Create content
$node = Node::create([
  'type' => 'cancer_page',
  'title' => 'Page Title',
  'body' => [
    'value' => '<p>Content HTML here</p>',
    'format' => 'full_html',
  ],
  'status' => 1,
]);
$node->save();

// Create menu item
$menu_item = MenuLinkContent::create([
  'title' => 'Menu Title',
  'link' => ['uri' => 'internal:/path/to/page'],
  'menu_name' => 'main',
  'weight' => 0,
]);
$menu_item->save();

print 'Created: ' . $node->id() . PHP_EOL;
```

---

## Drupal Export/Import

The `drupal-export/` directory contains a complete Drupal 11 site export for deployment to a fresh installation.

### Export Contents

- **UUID**: `5d5a1de3-f462-43dd-99c4-c92fb55905b2`
- **Database**: Full MySQL dump (~8MB)
- **Configuration**: 196 YAML files (complete site config)
- **Theme**: NCI Theme (with Tailwind CSS CDN)
- **Files**: CSS, JS, images, assets (~6MB)

### Quick Import

```bash
# 1. Create new Drupal 11 project
mkdir new-site && cd new-site
ddev config --project-type=drupal11 --docroot=web --php-version=8.3
ddev start
ddev composer create-project drupal/recommended-project:^11.3 .
ddev composer require drush/drush

# 2. Import database
ddev drush sql:drop -y
ddev drush sql:cli < /path/to/drupal-export/sql/drupal-site-dump.sql
ddev drush config-set system.site uuid 5d5a1de3-f462-43dd-99c4-c92fb55905b2

# 3. Copy theme and files
cp -r /path/to/drupal-export/theme/nci web/themes/
cp -r /path/to/drupal-export/files/* web/sites/default/files/

# 4. Enable theme and import config
ddev drush theme:enable nci
ddev drush config-set system.theme default nci
ddev drush config:import --source=/path/to/drupal-export/config
ddev drush cache:rebuild
```

### Exporting After Changes

```bash
# After making content/configuration changes, export:
ddev drush cex -y  # Export configuration
ddev drush sql:dump --gzip --result-file=drupal-export/sql/drupal-site-dump.sql.gz  # Export database
```

### Key Files

| File | Description |
|------|-------------|
| `drupal-export/README.md` | Overview and quick start |
| `drupal-export/SETUP_GUIDE.md` | Complete DDEV + Drush setup |
| `drupal-export/IMPORT.md` | Detailed import instructions |
| `drupal-export/config/` | Complete configuration sync (196 YAML files) |
| `drupal-export/sql/` | Database dump for import |

### Important Notes

1. **UUID is critical**: Config import fails without matching UUID (`5d5a1de3-f462-43dd-99c4-c92fb55905b2`)
2. **stable9 base theme**: Included in Drupal Core - no action needed
3. **Database must be imported BEFORE config import**
4. **Always clear cache after import**: `ddev drush cr`

---

## Playwright CLI Agent Usage

## Overview

This document describes how agents should use the `playwright-cli` skill for browser automation tasks.

## Storage Structure

- **YAML snapshots**: Stored under `.playwright-cli/` directory (gitignored)
- **PNG screenshots**: Stored in `.playwright-cli-screenshots/` directory (gitignored)
- **Session state files**: Stored under `.playwright-cli/` directory (gitignored)

## Temp Folder Setup

Before running any playwright-cli commands, agents MUST create a dummy temp folder in the current working directory:

```bash
mkdir -p .playwright-cli-screenshots
```

This folder is gitignored and used for screenshots that should not be committed.

## Workflow

1. **Create temp folder** (if not exists):
   ```bash
   mkdir -p .playwright-cli-screenshots
   ```

2. **Open browser session**:
   ```bash
   playwright-cli open
   # or
   playwright-cli open https://example.com
   ```

3. **Take screenshots** (to gitignored location):
   ```bash
   # Screenshot saved to .playwright-cli-screenshots/
   playwright-cli screenshot --filename=.playwright-cli-screenshots/my-screenshot.png
   ```

4. **Snapshots saved to .playwright-cli/**:
   ```bash
   # Snapshot saved to .playwright-cli/page-timestamp.yml
   playwright-cli snapshot
   # or with custom filename
   playwright-cli snapshot --filename=my-snapshot.yml
   ```

5. **Close browser**:
   ```bash
   playwright-cli close
   ```

## Example Session

```bash
# 1. Ensure temp folder exists
mkdir -p .playwright-cli-screenshots

# 2. Open browser
playwright-cli open https://example.com

# 3. Take screenshot (saved to .playwright-cli-screenshots/)
playwright-cli screenshot --filename=.playwright-cli-screenshots/homepage.png

# 4. Take snapshot (saved to .playwright-cli/)
playwright-cli snapshot --filename=homepage-state.yml

# 5. Close
playwright-cli close
```

## Key Points

- **Always** create `.playwright-cli-screenshots/` before taking screenshots
- YAML state files go to `.playwright-cli/` (managed by playwright-cli itself)
- PNG screenshots go to `.playwright-cli-screenshots/` (manual management)
- Both directories are gitignored - safe for sensitive/test content
