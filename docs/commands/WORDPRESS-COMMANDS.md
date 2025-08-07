# WordPress Site Management

Documentation for creating, deleting, and managing WordPress sites with Herd.

## wp.new - WordPress Site Creation

Creates a new WordPress site with sensible defaults and recommended plugins.

### Usage

```bash
./wp.new                 # Interactive site creation
./wp.new --dry-run       # Preview what would be created
```

### Features

- ✅ **Smart Setup** - Checks for existing installations and skips completed steps
- 🗄️ **Database Management** - Creates both main and test databases
- 🔒 **HTTPS Support** - Automatically enables HTTPS via Herd
- 🔌 **Pre-installed Plugins** - Installs essential development plugins
- 📂 **Herd Integration** - Creates sites in `~/Herd/` directory
- 🔍 **Dry Run Mode** - Preview changes before applying

### What It Does

1. Validates WP-CLI and Herd installation
2. Prompts for site configuration (with smart defaults)
3. Downloads WordPress core
4. Creates `wp-config.php`
5. Creates main database (`sitename_db`) and test database (`sitename_db_test`)
6. Installs WordPress
7. Installs recommended plugins:
   - **WP Mail Logging** - Captures all emails for debugging
   - **Query Monitor** - Debug bar for database queries and performance
   - **WP Crontrol** - Manage WordPress cron jobs
8. Enables HTTPS via Herd

### Default Credentials

- **Username**: `admin`
- **Password**: `password`
- **Email**: `admin@example.com`

> ⚠️ **Security Note**: Change the default password immediately on production sites!

## wp.delete - WordPress Site Deletion

Safely removes WordPress sites and all associated data.

### Usage

```bash
./wp.delete              # Interactive site deletion
./wp.delete --dry-run    # Preview what would be deleted
```

### Features

- 🔍 **Site Validation** - Verifies WordPress installation before deletion
- 🗄️ **Complete Cleanup** - Removes databases, files, and certificates
- ⚠️ **Safety Checks** - Requires explicit confirmation
- 🧹 **No Traces** - Removes both main and test databases
- 🔍 **Dry Run Mode** - Preview deletion before applying

### What It Does

1. Validates the site exists and is a WordPress installation
2. Reads database configuration from `wp-config.php`
3. Shows what will be deleted and asks for confirmation
4. Removes HTTPS certificate
5. Drops main and test databases
6. Removes site directory

## wp.php - WordPress Tools & Templates

Manages WordPress-specific settings and templates across sites.

### Usage

```bash
./wp.php error-template on mysite     # Add error template to specific site
./wp.php error-template off mysite    # Remove error template from site
./wp.php error-template on all        # Add to all WordPress sites
./wp.php error-template on all --dry-run  # Preview adding templates
```

### Features

- 🎨 **Beautiful Error Pages** - Custom styled error templates
- 📊 **Stack Trace Formatting** - Formatted and readable error output
- 🔍 **Smart Detection** - Only applies to WordPress sites
- 🔍 **Dry Run Mode** - Preview changes before applying

## Error Templates

### What Are Error Templates?

Custom PHP error templates provide beautiful, readable error pages during development instead of the default white screen of death.

### Features

- **Beautiful Design** - Modern, responsive error page layout
- **Stack Trace Parsing** - Formatted and color-coded stack traces
- **Detailed Information** - Error type, file, line number, and message
- **Development Focused** - Optimized for debugging workflow

### How It Works

The script copies `.php-error-template` to `wp-content/php-error.php` in WordPress sites. WordPress automatically uses this file when fatal PHP errors occur.

### Template Features

The error template includes:

- **Error Details**: Type, message, file, and line number
- **Stack Trace**: Parsed and formatted for readability
- **Responsive Design**: Works on desktop and mobile
- **Timestamp**: When the error occurred
- **Helpful Actions**: Suggestions for debugging

### Example Error Display

When a fatal error occurs, instead of a blank white page, you'll see:

- 💥 Clear error icon and title
- 📋 Formatted error message
- 📊 Color-coded stack trace
- 📁 File and line information
- 🕐 Timestamp of when error occurred

## 🎯 Use Cases

### During Development
```bash
# Add error templates to all sites for better debugging
./wp.php error-template on all
```

### For Specific Sites
```bash
# Add to a specific site
./wp.php error-template on mysite

# Remove from a specific site  
./wp.php error-template off mysite
```

### Safe Preview
```bash
# Preview what would be added/removed
./wp.php error-template on all --dry-run
./wp.php error-template off mysite --dry-run
```

## 🔍 Smart Detection

The script automatically:

- ✅ **Detects WordPress Sites**: Only applies to directories with `wp-config.php` and `wp-content/`
- ✅ **Skips Non-WordPress**: Ignores non-WordPress directories
- ✅ **Checks Existing**: Skips if template already exists
- ✅ **Validates Template**: Ensures source template file exists

## 🔄 Re-running Scripts

The `wp.new` script is **idempotent** - it can be run multiple times safely:

- ✅ Skips WordPress download if already exists
- ✅ Skips database creation if already exists
- ✅ Skips WordPress installation if already installed
- ✅ Skips plugin installation if already installed

This makes it safe to re-run if something fails partway through.

## 🔌 Included WordPress Development Plugins

The `wp.new` script automatically installs and activates these essential development plugins:

### WP Mail Logging
- **Purpose**: Captures all outgoing emails for debugging
- **Use Case**: Test email functionality without actually sending emails
- **Features**: View email content, headers, and attachments in WordPress admin

### Query Monitor
- **Purpose**: Debug bar for database queries and performance monitoring
- **Use Case**: Identify slow queries, PHP errors, and performance bottlenecks
- **Features**: Database queries, PHP errors, hooks & actions, HTTP API calls, and more

### WP Crontrol
- **Purpose**: Manage WordPress cron jobs and scheduled events
- **Use Case**: Debug and manage WordPress scheduled tasks
- **Features**: View, edit, delete, and run cron events manually

These plugins are automatically installed and activated during site creation to provide a complete development environment out of the box.

## 📁 File Locations

### Source Template
```
~/Herd/.php-error-template
```

### Deployed Templates
```
~/Herd/[site-name]/wp-content/php-error.php
```

## 💡 Best Practices

1. **Add to All Sites**: Use `./wp.php error-template on all` for consistent debugging experience
2. **Use Dry Run**: Preview changes with `--dry-run` before applying
3. **Remove for Production**: Remove error templates before deploying to production
4. **Combine with Logging**: Use alongside `./herd.php log on` for comprehensive debugging

## 🚨 Security Note

Error templates show detailed error information and should **never** be used on production sites. They're designed specifically for development environments.
