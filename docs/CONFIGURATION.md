# Configuration

Default settings and customization options for the WordPress site management scripts.

## 🔧 Default Database Settings

All WordPress sites created with `wp.new` use these default database settings:

- **Host**: `127.0.0.1` (Herd's MySQL)
- **User**: `root`
- **Password**: (empty)
- **Charset**: `utf8mb4`
- **Collation**: `utf8mb4_unicode_ci`

### Database Naming Convention

- **Main Database**: `{sitename}_db`
- **Test Database**: `{sitename}_db_test`

Example: For a site named "myblog", databases would be:
- `myblog_db` (main)
- `myblog_db_test` (testing)

## 🌐 Site URLs

Sites are accessible at `https://sitename.test` (with HTTPS enabled via Herd).

### URL Pattern
```
https://{sitename}.test
```

Examples:
- `myblog` → `https://myblog.test`
- `company-site` → `https://company-site.test`

## 👤 Default WordPress Credentials

For quick development setup, all sites use these default credentials:

- **Username**: `admin`
- **Password**: `password`
- **Email**: `admin@example.com`

> ⚠️ **Security Warning**: These are development-only credentials. Change them immediately for any production use!

## 📁 File Structure

```
~/Herd/
├── wp.new              # Site creation script
├── wp.delete           # Site deletion script
├── herd.xdebug         # Xdebug management script
├── herd.php            # PHP settings management script
├── wp.php              # WordPress management script
├── .php-error-template # PHP error template file
├── docs/               # Documentation files
├── README.md           # Main documentation
├── CHANGELOG.md        # Version history
├── CONTRIBUTING.md     # Contribution guidelines
├── LICENSE             # MIT license
├── .gitignore          # Git ignore configuration
├── your-sites-1/         # Created WordPress sites
└── your-sites-3/         # Created WordPress sites
└── ...
```

## 🔧 PHP Configuration Paths

### PHP INI Files
```
~/Library/Application Support/Herd/config/php/{version}/php.ini
```

Examples:
- `~/Library/Application Support/Herd/config/php/8.3/php.ini`
- `~/Library/Application Support/Herd/config/php/8.2/php.ini`

### FPM Configuration Files
```
~/Library/Application Support/Herd/config/fpm/{version}-fpm.conf
```

Examples:
- `~/Library/Application Support/Herd/config/fpm/8.3-fpm.conf`
- `~/Library/Application Support/Herd/config/fmp/8.2-fpm.conf`

## 📊 Log File Locations

### PHP Error Logs
```
~/Library/Application Support/Herd/Log/php-fpm.log
```

### WordPress Debug Logs
```
~/Herd/{sitename}/wp-content/debug.log
```

## ⚙️ Customization

### Changing Default Credentials

Edit the variables in `wp.new`:
```bash
DEFAULT_WP_ADMIN_USER="admin"
DEFAULT_WP_ADMIN_PASSWORD="password"
DEFAULT_WP_ADMIN_EMAIL="admin@example.com"
```

### Changing Database Settings

Modify the defaults in `wp.new`:
```bash
DB_HOST="127.0.0.1"
DB_USER="root"
```

### Adding Custom Plugins

In `wp.new`, add plugins to the installation section:
```bash
# Add your custom plugin
php -d memory_limit=-1 -d max_execution_time=0 $(which wp) plugin install your-plugin --activate --path="$SITE_PATH"
```

## 🔍 Environment Detection

Scripts automatically detect:

- **Herd Installation**: Checks for `herd` command
- **WP-CLI Installation**: Checks for `wp` command  
- **WordPress Sites**: Validates `wp-config.php` and `wp-content/` existence
- **Database Connectivity**: Tests MySQL connection before operations
- **Existing Installations**: Skips completed steps for idempotent operations

## 💡 Best Practices

### Site Naming
- Use lowercase letters and hyphens
- Avoid spaces and special characters
- Keep names short and descriptive

Good examples:
- `myblog`
- `company-site`
- `project-demo`

### Database Management
- Use the auto-generated database names
- Keep test databases for automated testing
- Regular backups before major changes

### Security
- Change default credentials immediately
- Use error templates only in development
- Disable Xdebug when not debugging
