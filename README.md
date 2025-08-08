# WordPress Site Management Scripts for Laravel Herd

A collection of bash scripts to easily create and delete WordPress sites using [Laravel Herd](https://herd.laravel.com/) and [WP-CLI](https://wp-cli.org/) for local development.

> **⚠️ Disclaimer**: These scripts have been tested on macOS Sonoma (14.x) running on a MacBook Pro 2019. While they should work on other macOS versions and hardware, your mileage may vary.

## 💡 Motivation

[Laravel Herd](https://herd.laravel.com/) is an excellent local development environment primarily designed for Laravel applications. While Herd does support other PHP frameworks and applications, it comes with certain limitations when working with WordPress:

- **Manual Setup Process** - Creating WordPress sites requires multiple manual steps
- **Database Management** - No built-in WordPress database creation and management
- **Development Tools** - Missing WordPress-specific debugging and error handling
- **Plugin Installation** - No automated setup for essential development plugins
- **Configuration** - Manual wp-config.php setup for each site

These scripts were created to bridge that gap and provide WordPress developers with the same smooth, automated experience that Laravel developers enjoy with Herd. By automating the entire WordPress setup process, managing databases, and providing powerful debugging tools, we make WordPress development on Herd as productive and enjoyable as possible.

**The goal**: Make WordPress development with Laravel Herd feel as native and seamless as Laravel development itself! 🎯

## 🚀 Quick Start

1. **Install Prerequisites**: [Laravel Herd](https://herd.laravel.com/), [WP-CLI](https://wp-cli.org/) and [DBngin](https://dbngin.com/)
2. **Enable MySQL Service**: Open [DBngin](https://dbngin.com/) and start a MySQL server instance.
3. **Create a WordPress site**: `./wp.new`

> 💡 **Tip**: We recommend cloning this repository directly as your Herd root directory for the best experience.

## 📚 Documentation

- **[Commands Overview](docs/commands/COMMANDS.md)** - Complete list of all available commands
- **[WordPress Management](docs/commands/WORDPRESS-COMMANDS.md)** - wp.new, wp.delete, and wp.php commands
- **[PHP & Debugging](docs/commands/HERD-COMMANDS.md)** - herd.xdebug and herd.php commands  
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
./help
```
> 💡 **Tip**: Above command will help to list available commands and all scripts support `--dry-run` for previewing changes.

## 🔧 Active Development

We are actively adding new commands and features to make WordPress development with Laravel Herd more productive and enjoyable! 

### 🌟 What's Coming Next?
- More automation scripts for common WordPress tasks
- Enhanced debugging and profiling tools
- Better integration with popular WordPress development workflows
- Additional template management features

### 🔍 Check the Development Branch
If you don't find something you're looking for, check our `develop` branch for upcoming features and experimental commands:

```bash
git checkout develop
```

### 💬 We Love Your Feedback!
Missing a feature or have an idea for improvement? We'd love to hear from you!

- **[Open an Issue](../../issues)** - Request features, report bugs, or suggest improvements
- **[Join Discussions](../../discussions)** - Share your WordPress development workflows
- **[Contribute](CONTRIBUTING.md)** - Help us build better tools for the community

Your feedback helps us prioritize which commands and features to build next. Every suggestion is valuable to us! 🙏

## 🤝 Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md) for guidelines.

## 📈 Changelog

See [CHANGELOG.md](CHANGELOG.md) for version history.

## 📄 License

MIT License - see [LICENSE](LICENSE) file for details.

---

**Happy WordPress Development!** 🎉

*Built with ❤️ for the WordPress community using Laravel Herd*
