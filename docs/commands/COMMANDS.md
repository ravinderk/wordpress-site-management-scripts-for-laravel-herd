# Commands Reference

Complete reference for all WordPress site management scripts.

## 📋 Command Overview

| Command | Description | Dry Run | Documentation |
|---------|-------------|---------|---------------|
| `wp.new` | Create WordPress sites | ✅ | [WordPress Management](docs/commands/WORDPRESS-COMMANDS.md#wpnew---wordpress-site-creation) |
| `wp.delete` | Delete WordPress sites | ✅ | [WordPress Management](docs/commands/WORDPRESS-COMMANDS.md#wpdelete---wordpress-site-deletion) |
| `wp.php` | WordPress tools & templates | ✅ | [WordPress Management](docs/commands/WORDPRESS-COMMANDS.md#wpphp---wordpress-tools--templates) |
| `herd.xdebug` | Enable/disable Xdebug | ✅ | [PHP & Debugging](docs/commands/HERD-COMMANDS.md#herdxdebug---xdebug-management) |
| `herd.php` | Manage PHP settings | ✅ | [PHP & Debugging](docs/commands/HERD-COMMANDS.md#herdphp---php-settings-management) |

> 💡 **Tip**: All scripts support `--dry-run` for previewing changes

## 🆘 Available Commands

```bash
./help
```

## 🚀 WordPress Management

### wp.new - Create Sites
```bash
./wp.new                 # Interactive site creation
./wp.new --dry-run       # Preview creation
```

### wp.delete - Remove Sites  
```bash
./wp.delete              # Interactive site deletion
./wp.delete --dry-run    # Preview deletion
```

### wp.php - WordPress Tools
```bash
./wp.php error-template on mysite      # Add error template
./wp.php error-template off mysite     # Remove error template
./wp.php error-template on all         # Add to all sites
./wp.php error-template on all --dry-run   # Preview changes
```

## 🐛 PHP & Debugging

### herd.xdebug - Xdebug Control
```bash
./herd.xdebug on         # Enable Xdebug
./herd.xdebug off        # Disable Xdebug
./herd.xdebug on --dry-run   # Preview changes
```

### herd.php - PHP Settings
```bash
./herd.php log on        # Enable PHP logging
./herd.php log off       # Disable PHP logging
./herd.php log on --dry-run  # Preview changes
```

## 🔍 Common Patterns

### Safe Operations (Dry Run First)
```bash
# Always preview first
./command --dry-run
# Then apply if satisfied
./command
```

### Batch Operations
```bash
# Apply to all WordPress sites
./wp.php error-template on all
```

### Development Workflow
```bash
# 1. Create site
./wp.new

# 2. Enable debugging
./herd.xdebug on
./herd.php log on

# 3. Add error templates
./wp.php error-template on all
```

## ⚠️ Safety Features

- **Dry Run Mode**: Preview all changes before applying
- **Idempotent Operations**: Safe to run multiple times
- **Smart Detection**: Skip unnecessary changes
- **Explicit Confirmations**: Required for destructive operations
- **Smart Detection**: Skip unnecessary changes
- **Explicit Confirmations**: Required for destructive operations
