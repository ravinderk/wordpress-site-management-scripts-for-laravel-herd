# WordPress Site Management Scripts for Laravel Herd

A collection of bash scripts to easily create and delete WordPress sites using [Laravel Herd](https://herd.laravel.com/) and [WP-CLI](https://wp-cli.org/) for local development.

## 📋 Prerequisites

Before using these scripts, ensure you have the following installed:

- **[Laravel Herd](https://herd.laravel.com/)** - Local PHP development environment
- **[WP-CLI](https://wp-cli.org/)** - Command line interface for WordPress
- **[DBngin](https://dbngin.com/)** - Free database management tool with intuitive GUI for viewing database tables and data
- **[TablePlus](https://tableplus.com/)** (optional) - Modern database management tool with intuitive GUI for viewing database tables and data

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

#### What it does

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

#### Default Credentials

- **Username**: `admin`
- **Password**: `password`
- **Email**: `admin@example.com`

### wp.delete - WordPress Site Deletion

Safely removes WordPress sites and all associated data.

#### Features

- 🔍 **Site Validation** - Verifies WordPress installation before deletion
- 🗄️ **Complete Cleanup** - Removes databases, files, and certificates
- ⚠️ **Safety Checks** - Requires explicit confirmation
- 🧹 **No Traces** - Removes both main and test databases

#### Usage

```bash
./wp.delete
```

#### What it does

1. Validates the site exists and is a WordPress installation
2. Reads database configuration from `wp-config.php`
3. Shows what will be deleted and asks for confirmation
4. Removes HTTPS certificate
5. Drops main and test databases
6. Removes site directory

## 📁 File Structure

```
~/Herd/
├── wp.new          # Site creation script
├── wp.delete       # Site deletion script
├── README.md       # This file
├── .gitignore      # Git ignore rules
└── your-sites/     # Created WordPress sites
    ├── site1/
    ├── site2/
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
chmod +x wp.new wp.delete
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

## 🤝 Contributing

Feel free to submit issues and enhancement requests!

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

**Happy WordPress Development!** 🎉
