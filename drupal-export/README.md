# Drupal Site Export - Complete Package

A complete export of a Drupal 11 CMS website with custom NCI theme, ready for import into any Drupal 11 installation.

---

## What's Included

| Component | Description | Size |
|-----------|-------------|------|
| **Configuration** | 196 YAML files (complete site config) | ~600KB |
| **Database** | Full MySQL dump (users, content, taxonomy) | ~8MB |
| **Theme** | NCI Theme (Tailwind CSS, custom preprocessing) | ~50KB |
| **Files** | CSS, JS, images, assets | ~6MB |
| **Composer** | Drupal 11.3.5 + Drush 13.x | - |

---

## Quick Start

### 1. Create New Drupal Project

```bash
mkdir new-drupal-site && cd new-drupal-site
ddev config --project-type=drupal11 --docroot=web --php-version=8.3
ddev start
ddev composer create-project drupal/recommended-project:^11.3 .
ddev composer require drush/drush
```

### 2. Import Database

```bash
ddev drush sql:drop -y
ddev drush sql:cli < drupal-export/sql/drupal-site-dump.sql
ddev drush config:set system.site uuid 5d5a1de3-f462-43dd-99c4-c92fb55905b2
```

### 3. Install Theme

```bash
cp -r drupal-export/theme/nci web/themes/
ddev drush theme:enable nci
ddev drush config:set system.theme default nci
```

### 4. Copy Files

```bash
cp -r drupal-export/files/* web/sites/default/files/
```

### 5. Import Configuration

```bash
ddev drush config:import --source=drupal-export/config
ddev drush cache:rebuild
```

---

## Documentation

| File | Description |
|------|-------------|
| `README.md` | This file - overview and quick start |
| `SETUP_GUIDE.md` | Complete DDEV + Drush setup instructions |
| `MODULES.md` | Recommended Drupal 11 modules |
| `IMPORT.md` | Detailed import instructions |
| `IMPORT_INSTRUCTIONS.md` | Legacy import guide |

---

## Site Details

- **Drupal Version**: 11.3.5
- **PHP Version**: 8.3+
- **Database**: MySQL/MariaDB
- **Site UUID**: `5d5a1de3-f462-43dd-99c4-c92fb55905b2`

### Content Types
- `article` - Standard articles with comments
- `cancer_page` - Custom cancer information pages
- `page` - Basic pages

### Taxonomy
- `tags` - Tag vocabulary

### User Roles
- `anonymous` - Public access
- `authenticated` - Logged-in users
- `content_editor` - Content management
- `administrator` - Full access

### Enabled Modules (44)
Core modules including: Node, Taxonomy, Search, Path, CKEditor 5, Views, etc.

### Custom Theme: NCI Theme
- Base theme: `stable9` (Drupal Core)
- Libraries: Tailwind CSS CDN
- Fonts: Merriweather, Source Sans 3
- Regions: header_top, header_main, navigation, content, sidebar, footer_top, footer_main, back_to_top

---

## Folder Structure

```
drupal-export/
├── README.md                 # This file
├── SETUP_GUIDE.md           # DDEV + Drush setup guide
├── MODULES.md               # Recommended modules list
├── IMPORT.md                # Detailed import instructions
├── IMPORT_INSTRUCTIONS.md   # Legacy import instructions
│
├── composer.json            # Drupal 11.3.5 + Drush
├── composer.lock            # Locked dependencies
│
├── config/                  # Configuration YAML files (196 files)
│   ├── system.site.yml
│   ├── core.extension.yml
│   ├── node.type.*.yml
│   ├── user.role.*.yml
│   └── ... (190+ more)
│
├── files/                   # Public files
│   ├── assets/
│   ├── css/
│   ├── images/
│   ├── js/
│   ├── styles/
│   └── sync/               # Additional config sync
│
├── sql/
│   └── drupal-site-dump.sql # Full database export
│
└── theme/
    └── nci/                # NCI Theme
        ├── nci.info.yml
        ├── nci.libraries.yml
        ├── nci.theme
        └── templates/
```

---

## Essential Commands

```bash
# Start DDEV
ddev start

# Clear cache
ddev drush cr

# Export config (after making changes)
ddev drush cex -y

# Import config
ddev drush cim -y

# Database operations
ddev drush sql:dump > backup.sql
ddev drush sql:cli < backup.sql

# Get admin login link
ddev drush uli

# Run database updates
ddev drush updb -y
```

---

## Adding Modules

```bash
# Install a new module
ddev composer require drupal/module_name
ddev drush en module_name
ddev drush updb -y

# Export new config
ddev drush cex -y
```

---

## Troubleshooting

### Config Import Fails - UUID Mismatch

```bash
ddev drush config:set system.site uuid 5d5a1de3-f462-43dd-99c4-c92fb55905b2
ddev drush cim -y
```

### Theme Not Showing

```bash
ddev drush cr
ddev drush theme:enable nci
ddev drush config:set system.theme default nci
```

### Missing Modules

```bash
# Check what's missing
ddev drush pml --status=not-installed

# Install missing modules
ddev composer require drupal/missing_module
ddev drush en missing_module
```

---

## Useful Resources

- [Drupal Documentation](https://www.drupal.org/docs)
- [Drush Commands](https://drush.org)
- [DDEV Documentation](https://ddev.readthedocs.io)
- [Drupal 11 Module Compatibility](https://www.drupal.org/docs/getting-started/modules-and-themes-for-drupal-11)

---

## Notes

- `stable9` base theme is included in Drupal Core - no action needed
- Database dump includes all content, users, and taxonomy
- Configuration excludes sensitive data (passwords sanitized during export)
- Files directory includes public assets, CSS, JS, and images
