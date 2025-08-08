# Installation & Setup Guide

Choose the installation method that best fits your needs and workflow.

## 🎯 Choose Your Installation Method

### Option 1: Complete Repository (Recommended)
Best for users who want all features.

Copy all content of this repository to Herd root directory.
```bash
git clone https://github.com/your-username/herd-wordpress-scripts.git ~/Herd
```

After installation, your structure will look like:

```
~/Herd/                    # Repository root
├── wp.new                 # Site creation script
├── wp.delete              # Site deletion script  
├── herd.xdebug           # Xdebug management
├── herd.php              # PHP settings
├── wp.php                # WordPress tools
├── help                  # Command reference
├── docs/                 # Documentation
├── .php-error-template   # Error template
├── your-site-1/          # Your WordPress sites
├── your-site-2/          # (created by wp.new)
└── your-site-3/
```

Keeping Scripts Updated, on latest release take latest pull.

```bash
cd ~/Herd
git pull origin main
```

### Option 2: Individual Scripts
Best for users who only need specific functionality.

Check our [Commands Overview](commands/COMMANDS.md) to see all available scripts and their purposes.

After installation, your structure will look like:
```
~/Herd/                    # Your existing Herd directory
├── wp.new                 # Downloaded scripts
├── your-existing-sites/  # Your existing projects
└── your-new-wp-sites/    # New WordPress sites
```

Keeping Scripts Updated, re-download updated scripts as needed using the download links.

### Getting Help

- Check [Troubleshooting Guide](TROUBLESHOOTING.md)
- Use `./help` to see available commands
- [Open an issue](https://github.com/ravinderk/laravel-herd-wp/issues/new) for installation problems

## 💡 Which Method Should I Choose?

### Choose Complete Repository If:
- ✅ You want all features and future updates
- ✅ You're starting fresh with WordPress development on Herd
- ✅ You want the easiest setup and maintenance
- ✅ You like having documentation available locally

### Choose Individual Scripts If:
- ✅ You only need specific functionality
- ✅ You have an existing Herd setup you want to preserve
- ✅ You want minimal footprint
- ✅ You prefer manual control over updates

---

**Ready to start?** Follow your chosen installation method above, then check out the [Commands Overview](commands/COMMANDS.md) to see what you can do!
