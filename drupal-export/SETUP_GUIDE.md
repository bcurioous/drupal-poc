# Drupal 11 + DDEV + Drush Setup Guide

## Prerequisites

- **Docker Desktop** (macOS/Windows) or Docker Engine (Linux)
- **DDEV** v1.25+ installed
- **Composer** 2.x

### Install DDEV

```bash
# macOS via Homebrew
brew install ddev

# Linux (see https://ddev.readthedocs.io/en/stable/#installation)
curl -fsSL https://pkg.ddev.com/apt/gpg | gpg --dearmor | sudo tee /etc/apt/trusted.gpg.d/ddev.gpg > /dev/null
echo "deb https://pkg.ddev.com/apt/ all main" | sudo tee /etc/apt/sources.list.d/ddev.list > /dev/null
sudo apt update && sudo apt install -y ddev
```

---

## Method 1: Fresh Drupal Installation with DDEV

### Step 1: Create Project Directory

```bash
# Create empty project directory
mkdir my-drupal-site && cd my-drupal-site

# IMPORTANT: Directory must be empty for composer create-project
# If you have existing files, create subdirectory
mkdir new-drupal && cd new-drupal
```

### Step 2: Initialize DDEV

```bash
# Configure for Drupal 11
ddev config --project-type=drupal11 --docroot=web --php-version=8.3

# Start containers
ddev start
```

### Step 3: Create Drupal Project

```bash
# Create Drupal project (in current directory, use . for empty dir)
ddev composer create-project drupal/recommended-project:^11.3 .

# Alternative: Create in subdirectory named 'web'
# ddev composer create-project drupal/recommended-project:^11.3 web
```

### Step 4: Install Drush (REQUIRED!)

Drush is NOT included by default in Drupal 11's recommended-project.

```bash
ddev composer require drush/drush
```

### Step 5: Install Drupal

```bash
# Option A: Interactive installation
ddev drush site:install

# Option B: Non-interactive with parameters
ddev drush site:install standard \
  --site-name="My Drupal Site" \
  --account-name=admin \
  --account-pass=admin123 \
  --account-mail=admin@example.com \
  -y

# Option C: Install from existing config
ddev drush site:install config_installer \
  --config-installer-dir=./config/sync \
  -y
```

### Step 6: Launch Site

```bash
# Open in browser
ddev launch

# Or get URL
ddev describe
```

---

## Method 2: Using DDEV with Existing Project

### Clone/Copy Project Files

```bash
# If cloning from git
git clone git@github.com:org/drupal-project.git my-site
cd my-site

# If importing from export
cp -r /path/to/drupal-export/* .
```

### Setup DDEV

```bash
# Initialize DDEV (skip if .ddev already exists)
ddev config --project-type=drupal11 --docroot=web --php-version=8.3

# Start
ddev start

# Install dependencies
ddev composer install
```

### Import Database

```bash
# Option A: Using drush sql:cli
ddev drush sql:cli < sql/dump.sql

# Option B: Import gzipped dump
gunzip < sql/dump.sql.gz | ddev drush sql:cli

# Option C: Using DDEV's import-db command
ddev import-db --file=sql/dump.sql.gz
```

### Update Site UUID (REQUIRED for Config Import)

```bash
# Get the UUID from the exported config
ddev drush config-set system.site uuid 5d5a1de3-f462-43dd-99c4-c92fb55905b2
```

### Import Configuration

```bash
# Import from config/sync directory
ddev drush config:import --source=config/sync

# Or if using files/sync
ddev drush config:import --source=web/sites/default/files/sync
```

### Clear Cache

```bash
ddev drush cache:rebuild
```

---

## DDEV Configuration Options

### config.yaml Options

```yaml
# .ddev/config.yaml
name: my-drupal-project
type: drupal11
docroot: web
php_version: "8.3"
webserver_type: nginx-fpm

database:
  type: mariadb
  version: "10.11"

# Additional hostname
additional_hostnames:
  - api.my-project.ddev.site

# Use mutagen for macOS performance
mutagen_enabled: true

# Timezone
timezone: America/New_York

# Node.js version
nodejs_version: "20"
```

### PHP Performance Settings

Create `.ddev/php/performance.ini`:

```ini
memory_limit = 512M
upload_max_filesize = 64M
post_max_size = 64M
max_execution_time = 300
max_input_time = 300
```

Apply with: `ddev restart`

### Custom Nginx Configuration

Create `.ddev/nginx_full/nginx-site.conf`:

```nginx
client_max_body_size 64M;
client_body_timeout 300s;

location / {
    try_files $uri /index.php?$query_string;
}
```

---

## Daily Development Workflow

### Morning Start

```bash
# Start DDEV
ddev start

# Get admin login link
ddev drush uli

# Pull latest config (if using Git)
git pull
ddev drush config:import
```

### During Development

```bash
# Clear cache (after code changes)
ddev drush cr

# Export config (after UI changes)
ddev drush cex -y

# Add new module
ddev composer require drupal/module_name
ddev drush en module_name
ddev drush updb

# Run database updates
ddev drush updb -y
```

### Database Operations

```bash
# Create snapshot (before risky changes)
ddev snapshot

# Export database
ddev drush sql:dump --gzip --result-file=backup.sql.gz

# Import database
ddev drush sql:cli < backup.sql

# Sanitize database (for safe sharing)
ddev drush sql:sanitize -y
```

### End of Day

```bash
# Commit config changes
git add config/sync/
git commit -m "Update configuration"

# Push changes
git push

# Stop DDEV
ddev stop
```

---

## Custom DDEV Commands

Create `.ddev/commands/web/refresh`:

```bash
#!/bin/bash
## Description: Full site refresh
## Usage: refresh

set -e

echo "Clearing cache..."
drush cr

echo "Running database updates..."
drush updb -y

echo "Importing configuration..."
drush cim -y

echo "Done!"
```

Make executable: `chmod +x .ddev/commands/web/refresh`

Usage: `ddev refresh`

---

## Troubleshooting

### "composer create-project fails - directory not empty"

```bash
# Move existing files temporarily
mv .ddev /tmp/
mv .git /tmp/
mv other-files /tmp/

# Run create-project
ddev composer create-project drupal/recommended-project:^11.3 .

# Move files back
mv /tmp/.ddev .
mv /tmp/.git .
mv /tmp/other-files .
```

### "Drush not found"

```bash
# Install Drush explicitly
ddev composer require drush/drush

# Verify
ddev drush status
```

### "Database connection refused"

```bash
# Check DDEV is running
ddev start

# Get connection info
ddev describe

# Verify database container
ddev status
```

### "Port already in use"

```bash
# Check what's using the port
sudo lsof -i :80

# Or stop all DDEV projects
ddev poweroff

# Then start just your project
ddev start
```

### "Permission denied on files"

```bash
ddev exec chown -R $(id -u):$(id -g) web/sites/default/files
ddev exec chmod -R 755 web/sites/default/files
```

---

## Essential Drush Commands Reference

```bash
# Cache
ddev drush cr                    # Clear cache
ddev drush cache:rebuild         # Full rebuild

# Config
ddev drush cex -y                 # Export config
ddev drush cim -y                 # Import config
ddev drush cget system.site       # Get config
ddev drush cset system.site name "X"  # Set config

# Database
ddev drush sql:dump > dump.sql   # Export DB
ddev drush sql:cli < dump.sql    # Import DB
ddev drush sql:sanitize          # Sanitize for sharing

# Modules
ddev drush en module_name         # Install module
ddev drush pmu module_name        # Uninstall module
ddev drush pml                    # List modules

# Users
ddev drush uli                    # One-time login link
ddev drush user:password admin "x" # Change password

# Updates
ddev drush updb -y               # Run updates
ddev drush deploy                 # Deploy (updb + cim + cr)
```

---

## Performance Tips

### Enable Mutagen (macOS)

```bash
ddev config global --mutagen-enabled
# OR per-project in config.yaml
mutagen_enabled: true
```

### Disable Xdebug When Not Debugging

```bash
ddev xdebug off        # Faster performance
ddev xdebug on         # Enable for debugging
```

### Use Redis for Caching

```bash
ddev composer require drupal/redis
```

Add to `settings.php`:
```php
$settings['redis.connection']['host'] = 'redis';
$settings['cache']['default'] = 'cache.backend.redis';
```
