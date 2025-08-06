# WordPress Site Management Scripts for Laravel Herd

A collection of bash scripts to easily create and delete WordPress sites using [Laravel Herd](https://herd.laravel.com/) and [WP-CLI](https://wp-cli.org/) for local development.

> **⚠️ Disclaimer**: These scripts have been tested on macOS Sonoma (14.x) running on a MacBook Pro 2019. While they should work on other macOS versions and hardware, your mileage may vary.

## 📚 Table of Contents

- [Prerequisites](#-prerequisites)
- [Scripts](#-scripts)
  - [wp.new - WordPress Site Creation](#wpnew---wordpress-site-creation)
  - [wp.delete - WordPress Site Deletion](#wpdelete---wordpress-site-deletion)
  - [herd.xdebug - Xdebug Management](#herdxdebug---xdebug-management)
  - [php-error.manage - PHP Error Template Management](#php-errormanage---php-error-template-management)
- [File Structure](#-file-structure)
- [Configuration](#-configuration)
- [Troubleshooting](#️-troubleshooting)
- [Re-running Scripts](#-re-running-scripts)
- [Included WordPress Development Plugins](#-included-wordpress-development-plugins)
- [Debugging Setup](#-debugging-setup)
- [Contributing](#-contributing)
- [Changelog](#-changelog)
- [License](#-license)

## 📋 Prerequisites

Before using these scripts, ensure you have the following installed:

- **[Laravel Herd](https://herd.laravel.com/)** - Local PHP development environment
- **[WP-CLI](https://wp-cli.org/)** - Command line interface for WordPress

### Recommended Database Management Tools

For viewing and managing your WordPress databases, we recommend:

- **[DBngin](https://dbngin.com/)** - Free database management tool with intuitive GUI for viewing database tables and data
- **[TablePlus](https://tableplus.com/)** - Modern database management tool with intuitive GUI for viewing database tables and data

## 🚀 Scripts

### wp.new - WordPress Site Creation

Creates a new WordPress site with sensible defaults and recommended plugins.

#### Features

- ✅ **Smart Setup** - Checks for existing installations and skips completed steps
- 🗄️ **Database Management** - Creates both main and test databases
- 🔒 **HTTPS Support** - Automatically enables HTTPS via Herd
- 🔌 **Pre-installed Plugins** - Installs essential development plugins
- 📂 **Herd Integration** - Creates sites in `~/Herd/` directory

#### Usage

```bash
./wp.new
```

#### Default Credentials

- **Username**: `admin`
- **Password**: `password`
- **Email**: `admin@example.com`

### wp.delete - WordPress Site Deletion

Safely removes WordPress sites and all associated data.

#### Usage

```bash
./wp.delete
```

### herd.xdebug - Xdebug Management

Unified script to enable or disable Xdebug across all PHP versions in Herd.

#### Usage

```bash
./herd.xdebug on   # Enable Xdebug for debugging
./herd.xdebug off  # Disable Xdebug for better performance
```

#### Features

- 🔧 **Multi-Version Support** - Configures all PHP versions in Herd
- ⚡ **Auto Restart** - Automatically restarts Herd after configuration
- 🎯 **Smart Detection** - Only configures PHP versions with Xdebug installed

### php-error.manage - PHP Error Template Management

Manages custom PHP error templates across WordPress sites.

#### Usage

```bash
./php-error.manage add mysite     # Add error template to specific site
./php-error.manage remove mysite  # Remove error template from specific site
./php-error.manage add all        # Add to all WordPress sites
./php-error.manage remove all     # Remove from all WordPress sites
```

#### Features

- 🎨 **Beautiful Error Pages** - Custom styled error templates
- 📊 **Stack Trace Formatting** - Formatted and readable error output
- 🔍 **Smart Detection** - Only applies to WordPress sites

## 📁 File Structure

```
~/Herd/
├── wp.new           # Site creation script
├── wp.delete        # Site deletion script
├── herd.xdebug      # Xdebug management script
├── php-error.manage # PHP error template management script
├── README.md        # This file
├── .gitignore       # Git ignore rules
├── your-sites-1/    # Created WordPress site
├── your-sites-2/    # Created WordPress site
└── ...
```

## 🔧 Configuration

### Default Database Settings

- **Host**: `127.0.0.1` (Herd's MySQL)
- **User**: `root`
- **Password**: (empty)
- **Charset**: `utf8mb4`
- **Collation**: `utf8mb4_unicode_ci`

### Site URLs

Sites are accessible at `https://sitename.test` (with HTTPS enabled via Herd).

## 🛠️ Troubleshooting

### Memory Issues

The scripts automatically set unlimited memory for WP-CLI operations:
```bash
php -d memory_limit=-1 -d max_execution_time=0 $(which wp) ...
```

### Database Connection Issues

1. Ensure Herd's MySQL service is running in DBgin
2. Check you are using default database credentials
3. Verify database host (usually `127.0.0.1` for Herd)

### Permission Issues

Ensure the scripts are executable:
```bash
chmod +x wp.new wp.delete herd.xdebug php-error.manage
```

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

## 🐛 Debugging Setup

### Xdebug Configuration

Use the included `herd.xdebug` script to quickly enable/disable Xdebug:

```bash
./herd.xdebug on   # Enable debugging
./herd.xdebug off  # Disable for performance
```

For detailed IDE setup, follow these guides:

1. **[Official Herd Xdebug Documentation](https://herd.laravel.com/docs/macos/debugging/xdebug)** - Complete setup guide for enabling Xdebug in Herd
2. **[VS Code + Herd Xdebug Setup](https://thomashysselinckx.medium.com/activating-xdebug-on-visual-studio-code-laravel-herd-cfd0553d26e0)** - Detailed guide for configuring Xdebug with Visual Studio Code

### PHP Error Templates

Custom error templates provide beautiful, readable error pages during development. Use the `php-error.manage` script to add them to your sites.

## 🤝 Contributing

Feel free to submit issues and enhancement requests! See [CONTRIBUTING.md](CONTRIBUTING.md) for detailed guidelines.

## 📈 Changelog

See [CHANGELOG.md](CHANGELOG.md) for a detailed history of changes and updates.

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

**Happy WordPress Development!** 🎉
