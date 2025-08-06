# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [2.0.0] - 2025-07-06

### ✨ Added
- **🐛 herd.xdebug** - Unified Xdebug management script replacing separate on/off scripts
- **🛠️ php-error.manage** - Script to manage custom PHP error templates across sites
- **💥 Custom PHP Error Templates** - Beautiful, styled error pages with stack trace formatting
- **📄 Template System** - `.php-error-template` file for consistent error page deployment
- **🔧 Multi-PHP Version Support** - Xdebug configuration across all Herd PHP versions
- **🔄 Auto-restart Functionality** - Herd automatically restarts after Xdebug configuration changes

### 🔄 Changed
- **📚 Improved Documentation** - Updated README with comprehensive script documentation
- **⚠️ Enhanced Error Handling** - Better error messages and validation across all scripts
- **🎯 Unified Script Interface** - Consistent command-line arguments across scripts

### 🐛 Fixed
- **💾 Memory Issues** - Resolved WP-CLI memory exhaustion during WordPress downloads
- **🔑 Database Password Handling** - Fixed empty password handling in MySQL commands
- **📁 Template File Paths** - Corrected relative path handling in management scripts

### 🗑️ Removed
- **❌ herd.xdebug.on** - Merged into unified herd.xdebug script
- **❌ herd.xdebug.off** - Merged into unified herd.xdebug script

## [1.0.0] - 2025-07-01

### ✨ Added
- **🆕 wp.new** - WordPress site creation script with smart setup
- **🗑️ wp.delete** - Safe WordPress site deletion script
- **🐛 herd.xdebug.on** - Enable Xdebug for debugging
- **🚫 herd.xdebug.off** - Disable Xdebug for performance
- **🗄️ Database Management** - Automatic creation of main and test databases
- **🔒 HTTPS Support** - Automatic SSL certificate generation via Herd
- **🔌 Plugin Installation** - Pre-installed development plugins (WP Mail Logging, Query Monitor, WP Crontrol)
- **🔄 Idempotent Operations** - Safe re-running of scripts without conflicts
- **✅ Smart Validation** - Comprehensive checks for prerequisites and existing installations

### 🔌 WordPress Plugins Included
- **📧 WP Mail Logging** - Email debugging and capture
- **🔍 Query Monitor** - Performance and database query debugging
- **⏰ WP Crontrol** - WordPress cron job management

### 📚 Documentation
- **📖 README.md** - Comprehensive setup and usage guide
- **🤝 CONTRIBUTING.md** - Contribution guidelines and project philosophy
- **📄 LICENSE** - MIT license for open source usage
- **🙈 .gitignore** - Proper git ignore configuration for development files

### ⚙️ Configuration
- **👤 Default Credentials** - Admin/password for quick development setup
- **🦌 Herd Integration** - Sites created in ~/Herd/ directory
- **🗄️ Database Defaults** - UTF8MB4 charset and collation
- **⚡ Memory Optimization** - Unlimited memory for WP-CLI operations

### 🧪 Testing Environment
- **🖥️ Platform Support** - Tested on macOS Sonoma (14.x)
- **💻 Hardware Compatibility** - Verified on MacBook Pro 2019
- **🔗 Tool Integration** - DBngin and TablePlus recommendations

## [0.1.0] - Initial Development

### ✨ Added
- **🌱 Basic WordPress installation automation**
- **🗄️ Simple database creation**
- **🦌 Initial Herd integration concepts**

---

## 📖 Legend

- **✨ Added** for new features
- **🔄 Changed** for changes in existing functionality  
- **⚠️ Deprecated** for soon-to-be removed features
- **🗑️ Removed** for now removed features
- **🐛 Fixed** for any bug fixes
- **🔒 Security** for vulnerability fixes
