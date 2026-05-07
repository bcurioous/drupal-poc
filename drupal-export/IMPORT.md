# Drupal Site Import Guide

This guide covers importing the exported Drupal site into a fresh Drupal 11 installation.

---

## Prerequisites

- PHP 8.3+
- MySQL/MariaDB 10.11+
- Composer 2.x
- Drush 13.x
- DDEV (optional, for local development)

---

## Quick Import (30 minutes)

### Step 1: Create New Drupal Project

```bash
# Create project directory
mkdir new-drupal-site && cd new-drupal-site

# Initialize DDEV
ddev config --project-type=drupal11 --docroot=web --php-version=8.3
ddev start

# Create Drupal project
ddev composer create-project drupal/recommended-project:^11.3 .

# Install Drush (REQUIRED!)
ddev composer require drush/drush
```

### Step 2: Setup Database

```bash
# Create database (using DDEV)
ddev mysql -e "CREATE DATABASE drupal DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;"

# Or via Drush with existing database
# Edit settings.php with your database credentials first
```

### Step 3: Import Database

```bash
# Drop existing tables (if any)
ddev drush sql:drop -y

# Import the SQL dump
ddev drush sql:cli < /path/to/drupal-export/sql/drupal-site-dump.sql

# Or for gzipped dump
gunzip < /path/to/drupal-export/sql/drupal-site-dump.sql.gz | ddev drush sql:cli
```

### Step 4: Update Site UUID

**CRITICAL**: Config import will fail without this step.

```bash
# Update UUID to match exported config
ddev drush config:set system.site uuid 5d5a1de3-f462-43dd-99c4-c92fb55905b2
```

### Step 5: Copy Theme

```bash
# Copy the NCI theme
cp -r /path/to/drupal-export/theme/nci web/themes/

# Enable the theme
ddev drush theme:enable nci

# Set as default theme
ddev drush config:set system.theme default nci
```

### Step 6: Copy Files

```bash
# Copy public files
cp -r /path/to/drupal-export/files/* web/sites/default/files/

# Set permissions
ddev exec chmod -R 755 web/sites/default/files
```

### Step 7: Import Configuration

```bash
# Import from config directory
ddev drush config:import --source=/path/to/drupal-export/config

# Or from files/sync if using that location
ddev drush config:import --source=web/sites/default/files/sync
```

### Step 8: Clear Cache

```bash
ddev drush cache:rebuild
```

---

## Detailed Step-by-Step

### Database Configuration

Edit `web/sites/default/settings.php`:

```php
$databases['default']['default'] = [
  'database' => 'drupal',
  'username' => 'db',
  'password' => 'db',
  'host' => 'db',
  'port' => 3306,
  'driver' => 'mysql',
  'prefix' => '',
  'collation' => 'utf8mb4_general_ci',
];
```

### UUID Explained

The site UUID is stored in `system.site.yml` and must match between:
1. Database (in `config` table)
2. Exported config files

**If UUID mismatch error occurs:**
```
The import failed because it does not appear to be a valid
configuration file. Site UUID mismatch.
```

**Solution:**
```bash
# Force match UUID
ddev drush config-set system.site uuid 5d5a1de3-f462-43dd-99c4-c92fb55905b2
```

### Module Installation

After import, you may need to install modules that were enabled in the original site:

```bash
# List modules that need installation
ddev drush pml --status=not-installed | grep -E "(token|pathauto|...)"

# Install required modules
ddev composer require drupal/token drupal/pathauto
ddev drush en token pathauto
```

### Verify Import

```bash
# Check site status
ddev drush status

# Verify content types exist
ddev drush php:eval "print_r(array_keys(\Drupal\node\Entity\NodeType::loadMultiple()));"

# Verify taxonomy
ddev drush php:eval "print_r(array_keys(\Drupal\taxonomy\Entity\Vocabulary::loadMultiple()));"

# Verify theme
ddev drush theme:list
```

---

## Troubleshooting

### Config Import Fails - UUID Mismatch

```bash
# Step 1: Get current UUID in database
ddev drush config-get system.site uuid

# Step 2: Set to exported UUID
ddev drush config-set system.site uuid 5d5a1de3-f462-43dd-99c4-c92fb55905b2

# Step 3: Import config
ddev drush config:import
```

### Config Import Fails - Missing Dependencies

```bash
# Install missing modules first
ddev composer require drupal/module_name
ddev drush en module_name

# Then retry import
ddev drush config:import --partial
```

### Database Import Fails - Foreign Key Errors

```bash
# Disable foreign key checks
ddev drush sql:cli -e "SET FOREIGN_KEY_CHECKS=0;"

# Import dump
ddev drush sql:cli < dump.sql

# Re-enable checks
ddev drush sql:cli -e "SET FOREIGN_KEY_CHECKS=1;"
```

### Theme Not Showing

```bash
# Clear cache
ddev drush cr

# Enable theme explicitly
ddev drush theme:enable nci
ddev drush config-set system.theme default nci

# Clear theme registry
ddev drush cache:clear theme_registry
```

### Missing Modules Error

```bash
# Check for missing modules
ddev drush pml --status=not-installed

# Install required modules
ddev composer require drupal/missing_module
ddev drush en missing_module

# Run updates
ddev drush updb
```

### Content Not Displaying

```bash
# Rebuild node access
ddev drush php:eval "node_access_rebuild();"

# Clear all caches
ddev drush cr
```

---

## Post-Import Checklist

- [ ] Site loads without errors
- [ ] Admin login works (`ddev drush uli`)
- [ ] All content types accessible at `/admin/structure/types`
- [ ] Taxonomy vocabulary at `/admin/structure/taxonomy`
- [ ] Theme properly styled at homepage
- [ ] Menu links working
- [ ] Blocks placed correctly at `/admin/structure/block`
- [ ] User roles at `/admin/people/roles`
- [ ] CKEditor works on content编辑
- [ ] Files/media accessible

---

## Import Without DDEV

If not using DDEV, use these commands without the `ddev` prefix:

```bash
# Standard Drush commands
drush sql:cli < dump.sql
drush config:set system.site uuid 5d5a1de3-f462-43dd-99c4-c92fb55905b2
drush config:import --source=./config
drush cr
```

---

## Database Sanitization (For Development)

Before using a production database in development, sanitize it:

```bash
# Sanitize user data
ddev drush sql:sanitize

# Then dump sanitized database
ddev drush sql:dump --gzip --result-file=sanitized.sql.gz
```

This will:
- Reset all passwords
- Anonymize email addresses
- Remove user data marked for sanitization

---

## Configuration Split Setup (Recommended)

To have different settings per environment:

```bash
# Install config split
ddev composer require drupal/config_split
ddev drush en config_split

# Create environment directories
mkdir -p config/dev config/staging config/prod

# Create development split config
cat > config/sync/config_split.config_split.development.yml << EOF
langcode: en
status: true
dependencies: []
id: development
label: Development
description: 'Development environment settings'
storage: directory
folder: ../config/dev
items:
  - system.performance
EOF
```

Add to `settings.php`:

```php
$environment = getenv('DDEV_ENV') ?: 'production';

if ($environment === 'development') {
  $config['config_split.config_split.development']['status'] = TRUE;
  $config['system.performance']['css']['preprocess'] = FALSE;
  $config['system.performance']['js']['preprocess'] = FALSE;
}
```
