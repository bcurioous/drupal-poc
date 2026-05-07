# Drupal Site Export - NCI Cancer.gov Theme

## Export Contents

This export package contains a complete Drupal 11 installation with:

- **UUID**: `5d5a1de3-f462-43dd-99c4-c92fb55905b2`
- **Site Name**: Drush Site-Install
- **Content Types**: article, cancer_page, page
- **Taxonomy**: tags (vocabulary)
- **Custom Theme**: NCI Theme (with Tailwind CSS CDN)
- **User Roles**: anonymous, authenticated, content_editor, administrator

## Folder Structure

```
drupal-export/
├── composer.json      # Drupal 11.3.5 with drush
├── composer.lock      # Locked dependencies
├── config/            # Complete configuration sync (196 YAML files)
├── files/             # Public files (CSS, JS, images, assets)
├── sql/
│   └── drupal-site-dump.sql   # Full database export
├── theme/
│   └── nci/           # Custom NCI theme
└── IMPORT_INSTRUCTIONS.md     # This file
```

## Prerequisites

### For New Drupal Installation

1. **PHP 8.3+** (required for Drupal 11)
2. **MySQL/MariaDB** or compatible database
3. **Composer 2.x**
4. **Drush 13.x** (included via composer)

### Database Requirements

- Create an empty database
- Note the database credentials (username, password, database name, host)

---

## Installation Method 1: Fresh Drupal + Import (Recommended)

### Step 1: Create New Drupal Project

```bash
# Create new Drupal project
composer create-project drupal/recommended-project:^11.3 new-drupal-site
cd new-drupal-site

# Install additional dependencies if needed
composer require drush/drush
```

### Step 2: Install Drupal (Skip Initial Configuration)

```bash
# Run Drupal installation with minimal profile
# IMPORTANT: Use the same database credentials you will import into
php drush site:install standard \
  --db-url=mysql://username:password@localhost/database_name \
  --site-name="Imported Drupal Site" \
  --account-name=admin \
  --account-pass=admin \
  --force
```

### Step 3: Import Database

```bash
# Drop all tables first (if database has existing data)
drush sql:drop -y

# Import the exported database
drush sql:cli < /path/to/drupal-export/sql/drupal-site-dump.sql

# Clear all caches
drush cr
```

### Step 4: Copy Theme

**Note**: `stable9` (the base theme) is already included in Drupal Core - no action needed.

```bash
# Copy the NCI theme to your themes directory
cp -r /path/to/drupal-export/theme/nci web/themes/

# Enable the theme (stable9 will be available automatically as base theme)
drush theme:enable nci

# Set as default theme
drush config:set system.theme default nci

# Uninstall default themes if not needed
drush theme:uninstall olivero claro stark
```

### Step 5: Copy Files

```bash
# Copy public files directory
cp -r /path/to/drupal-export/files/* web/sites/default/files/

# Set correct permissions
chmod -R 755 web/sites/default/files
```

### Step 6: Update Site UUID (REQUIRED for Config Import)

The configuration sync requires matching UUID between database and config:

```bash
# Update the site UUID in database to match exported config
drush config:set system.site uuid 5d5a1de3-f462-43dd-99c4-c92fb55905b2
```

### Step 7: Import Configuration

```bash
# Import all configuration from sync directory
drush config:import --source=web/sites/default/files/sync

# OR use the exported config folder
drush config:import --source=/path/to/drupal-export/config
```

### Step 8: Rebuild Cache

```bash
drush cr
drush cache:rebuild
```

---

## Installation Method 2: Complete Replacement

If you want to completely replace a new Drupal install with this export:

### Step 1: Create New Drupal Project

```bash
composer create-project drupal/recommended-project:^11.3 new-drupal-site
cd new-drupal-site
```

### Step 2: Replace composer.json

```bash
# Backup original composer.json
mv composer.json composer.json.original

# Use exported composer.json
cp /path/to/drupal-export/composer.json .
cp /path/to/drupal-export/composer.lock .
```

### Step 3: Install Dependencies

```bash
composer install
```

### Step 4: Setup settings.php with Database

Edit `web/sites/default/settings.php` and add:

```php
$databases['default']['default'] = [
  'database' => 'your_database_name',
  'username' => 'your_username',
  'password' => 'your_password',
  'host' => 'localhost',
  'port' => 3306,
  'driver' => 'mysql',
  'prefix' => '',
  'collation' => 'utf8mb4_general_ci',
];
```

### Step 5: Import Database

```bash
drush sql:drop -y
drush sql:cli < /path/to/drupal-export/sql/drupal-site-dump.sql
```

### Step 6: Copy Theme and Files

```bash
# Copy theme
cp -r /path/to/drupal-export/theme/nci web/themes/

# Copy files
cp -r /path/to/drupal-export/files/* web/sites/default/files/
```

### Step 7: Update UUID and Import Config

```bash
drush config-set system.site uuid 5d5a1de3-f462-43dd-99c4-c92fb55905b2
drush config:import --source=/path/to/drupal-export/config
drush cr
```

---

## Configuration Sync Contents (196 files)

### Core Configuration
- `system.site.yml` - Site name, UUID, front page
- `system.theme.yml` - Default/admin themes
- `user.role.*.yml` - User roles and permissions
- `core.extension.yml` - Enabled modules

### Content Types
- `node.type.article.yml` - Article content type
- `node.type.cancer_page.yml` - Cancer page content type
- `node.type.page.yml` - Basic page content type

### Taxonomy
- `taxonomy.vocabulary.tags.yml` - Tags vocabulary

### Blocks and Layouts
- Various block configurations for NCI theme regions:
  - Header, footer, navigation, breadcrumbs, sidebar

### Fields
- Field configurations for all content types

### Other
- Filter formats
- Text formats
- Image styles
- Date formats
- Menu configurations

---

## Custom Theme: NCI Theme

### Theme Details

- **Name**: NCI Theme
- **Base Theme**: `stable9` (Drupal Core - included automatically)
- **Core Requirement**: ^10 || ^11
- **Libraries**:
  - nci/global
  - nci/tailwind (Tailwind CSS CDN)
- **Regions**:
  - header_top, header_main, navigation
  - content, sidebar
  - footer_top, footer_main
  - back_to_top

### Theme Files

- `nci.info.yml` - Theme definition
- `nci.libraries.yml` - Asset libraries
- `nci.theme` - Theme preprocess functions
- `templates/` - Twig templates

### About stable9 Base Theme

The `stable9` theme is a **Drupal Core theme** (part of `drupal/core`). It is automatically installed when you run `composer create-project drupal/recommended-project:^11.3` - no separate export/import needed.

When Composer installs Drupal 11, stable9 is located at:
```
web/core/themes/stable9/
```

The NCI theme inherits from stable9 via `base theme: stable9` in its `.info.yml` file. This is handled automatically during theme installation.

### Preprocess Functions

The theme includes custom preprocessing for:
- HTML body classes
- Google Fonts (Merriweather, Source Sans 3)
- Region-specific styling
- Block styling for main navigation

---

## Content Types

### Article
Standard Drupal article type with comments, tags, promote functionality.

### Cancer Page
Custom content type for cancer-related pages.

### Page
Basic page type for static content.

---

## User Roles

| Role | Permissions |
|------|-------------|
| anonymous | Access content, comments, restricted HTML format |
| authenticated | All anonymous permissions + post comments, basic HTML |
| content_editor | Full content management, taxonomy, url aliases |
| administrator | All permissions |

---

## Troubleshooting

### Config Import Fails - UUID Mismatch

```
The import failed because it does not appear to be a valid
configuration file. Site UUID mismatch.
```

**Solution**: Update site UUID before import:
```bash
drush config-set system.site uuid 5d5a1de3-f462-43dd-99c4-c92fb55905b2
```

### Database Import Fails - Foreign Key Constraints

```bash
# Disable foreign key checks before import
drush sql:cli --database=<db> -e "SET FOREIGN_KEY_CHECKS=0;"
drush sql:cli < /path/to/dump.sql
drush sql:cli --database=<db> -e "SET FOREIGN_KEY_CHECKS=1;"
```

### Theme Not Showing

```bash
drush cr
drush theme:enable nci
drush config:set system.theme default nci
```

### Missing Modules After Import

```bash
# Reinstall all modules
composer install
drush updb
drush cr
```

---

## Post-Import Checklist

- [ ] Clear all caches (`drush cr`)
- [ ] Verify site name at `/admin/config/system/site-information`
- [ ] Check content types at `/admin/structure/types`
- [ ] Verify taxonomy at `/admin/structure/taxonomy`
- [ ] Check user roles at `/admin/people/roles`
- [ ] Verify blocks at `/admin/structure/block`
- [ ] Test node creation
- [ ] Check theme appearance at `/admin/appearance`
- [ ] Verify files are accessible

---

## Notes

### Database Size
The SQL dump is approximately 8MB (compressed with table data).

### Configuration Sync
The config/sync folder contains 196 YAML files representing the complete active configuration.

### Files
The files directory contains:
- `assets/` - Static assets
- `css/` - Compiled styles
- `images/` - Site images
- `js/` - JavaScript files
- `styles/` - Style files
- `sync/` - Additional configuration

### Content Synchronization Module
This site uses Drupal's core Configuration Manager for configuration deployment. For content (nodes, taxonomy, media), use the Content Synchronization module or manual export.

---

## Support

For Drupal documentation: https://www.drupal.org/docs
For Drush commands: https://drush.org
