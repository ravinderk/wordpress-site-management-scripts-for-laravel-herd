# WordPress Site Management Scripts for Laravel Herd

A collection of bash scripts to easily create and delete WordPress sites using [Laravel Herd](https://herd.laravel.com/) and [WP-CLI](https://wp-cli.org/) for local development.

> **⚠️ Disclaimer**: These scripts have been tested on macOS Sonoma (14.x) running on a MacBook Pro 2019. While they should work on other macOS versions and hardware, your mileage may vary.

## 🚀 Quick Start

1. **Install Prerequisites**: [Laravel Herd](https://herd.laravel.com/), [WP-CLI](https://wp-cli.org/) and [DBngin](https://dbngin.com/)
2. **Enable MySQL Service**: Open [DBngin](https://dbngin.com/) and start a MySQL server instance.
3. **Create a WordPress site**: `./wp.new`

## 📚 Documentation

- **[Commands Overview](docs/COMMANDS.md)** - Complete list of all available commands
- **[WordPress Management](docs/WORDPRESS-COMMANDS.md)** - wp.new, wp.delete, and wp.php commands
- **[PHP & Debugging](docs/HERD-COMMANDS.md)** - herd.xdebug and herd.php commands  
- **[Configuration](docs/CONFIGURATION.md)** - Default settings and customization
- **[Troubleshooting](docs/TROUBLESHOOTING.md)** - Common issues and solutions

## 📋 Prerequisites

- **[Laravel Herd](https://herd.laravel.com/)** - Local PHP development environment
- **[WP-CLI](https://wp-cli.org/)** - Command line interface for WordPress

### Recommended Tools

- **[DBngin](https://dbngin.com/)** - Database management with GUI
- **[TablePlus](https://tableplus.com/)** - Modern database tool

## 🆘 Need Help?

```bash
./help                     # Show all available commands
```
> 💡 **Tip**: All scripts support `--dry-run` for previewing changes

## 🤝 Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md) for guidelines.

## 📈 Changelog

See [CHANGELOG.md](CHANGELOG.md) for version history.

## 📄 License

MIT License - see [LICENSE](LICENSE) file for details.

---

**Happy WordPress Development!** 🎉
