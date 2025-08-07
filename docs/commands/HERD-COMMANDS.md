# PHP & Debugging

Documentation for managing PHP settings and debugging tools in Herd.

## herd.xdebug - Xdebug Management

Unified script to enable or disable Xdebug across all PHP versions in Herd.

### Usage

```bash
./herd.xdebug on         # Enable Xdebug for debugging
./herd.xdebug off        # Disable Xdebug for better performance
./herd.xdebug on --dry-run   # Preview enabling Xdebug
```

### Features

- 🔧 **Multi-Version Support** - Configures all PHP versions in Herd
- ⚡ **Auto Restart** - Automatically restarts Herd after configuration
- 🎯 **Smart Detection** - Only configures PHP versions with Xdebug installed
- 🔍 **Dry Run Mode** - Preview changes before applying

### IDE Setup Resources

For detailed IDE setup, follow these guides:

1. **[Official Herd Xdebug Documentation](https://herd.laravel.com/docs/macos/debugging/xdebug)** - Complete setup guide for enabling Xdebug in Herd
2. **[VS Code + Herd Xdebug Setup](https://thomashysselinckx.medium.com/activating-xdebug-on-visual-studio-code-laravel-herd-cfd0553d26e0)** - Detailed guide for configuring Xdebug with Visual Studio Code

## herd.php - PHP Settings Management

Manages PHP settings in Herd's FPM configuration files.

### Usage

```bash
./herd.php log on        # Enable PHP error logging
./herd.php log off       # Disable PHP error logging
./herd.php log on --dry-run  # Preview enabling logging
```

### Features

- 📊 **Logging Control** - Enable/disable PHP error logging across all versions
- 🔧 **Multi-Version Support** - Configures all PHP FPM configurations
- ⚡ **Auto Restart** - Automatically restarts Herd after configuration
- 🎯 **Smart Detection** - Skips changes if already in desired state
- 🔍 **Dry Run Mode** - Preview changes before applying

### PHP Error Log Location

When enabled, PHP errors are logged to:
```
~/Library/Application Support/Herd/Log/php-fmp.log
```

You can tail the log with:
```bash
tail -f "~/Library/Application Support/Herd/Log/php-fpm.log"
```

## 🔧 How It Works

### Xdebug Configuration

The script modifies PHP ini files located at:
```
~/Library/Application Support/Herd/config/php/*/php.ini
```

It sets `xdebug.mode=debug` for enabling or `xdebug.mode=off` for disabling.

### PHP Logging Configuration

The script modifies FPM configuration files located at:
```
~/Library/Application Support/Herd/config/fpm/*-fpm.conf
```

It manages these directives:
- `php_admin_value[error_log]`
- `php_admin_flag[log_errors]`

## 🚀 Performance Impact

### Xdebug
- **When Enabled**: Significant performance impact, use only for debugging
- **When Disabled**: No performance impact, recommended for regular development

### PHP Logging
- **When Enabled**: Minimal performance impact, useful for development
- **When Disabled**: No performance impact, cleaner for production-like testing

## 💡 Best Practices

1. **Use Dry Run First**: Always preview changes with `--dry-run`
2. **Toggle as Needed**: Enable Xdebug only when debugging, disable for performance
3. **Monitor Logs**: Use PHP logging to catch errors during development
4. **Check WordPress Logs**: Even with PHP logging disabled, WordPress debug logs are still available at `~/Herd/[site-name]/wp-content/debug.log`
