# Troubleshooting

Common issues and solutions for WordPress site management scripts.

## 🛠️ Memory Issues

### Problem
WP-CLI operations fail with memory exhaustion errors.

### Solution
The scripts automatically set unlimited memory for WP-CLI operations:
```bash
php -d memory_limit=-1 -d max_execution_time=0 $(which wp) ...
```

If you still encounter issues:
1. Restart Herd: `herd restart`
2. Check available system memory
3. Close other memory-intensive applications

## 🗄️ Database Connection Issues

### Problem
Database creation or connection fails.

### Solutions

1. **Ensure Herd's MySQL is running**:
   - Open DBngin and start the MySQL service
   - Or restart Herd: `herd restart`

2. **Check default credentials**:
   - Host: `127.0.0.1`
   - User: `root`
   - Password: (empty)

3. **Verify database host**:
   - Usually `127.0.0.1` for Herd
   - Some setups might use `localhost`

4. **Test connection manually**:
   ```bash
   mysql -h127.0.0.1 -uroot -e "SHOW DATABASES;"
   ```

## 🔑 Permission Issues

### Problem
Scripts fail with permission denied errors.

### Solution
Ensure scripts are executable:
```bash
chmod +x wp.new wp.delete herd.xdebug herd.php wp.php
```

## 🌐 Site Access Issues

### Problem
Created sites don't load in browser.

### Solutions

1. **Check Herd is running**: `herd status`
2. **Verify site is linked**: `herd links`
3. **Clear browser cache**
4. **Try HTTP instead of HTTPS**: `http://sitename.test`
5. **Check /etc/hosts** for conflicts

## 🐛 Xdebug Issues

### Problem
Xdebug not working after enabling.

### Solutions

1. **Restart Herd**: `herd restart`
2. **Check PHP version**: Ensure Xdebug is installed for your PHP version
3. **Verify configuration**:
   ```bash
   php -m | grep xdebug
   ```
4. **Check IDE configuration**: Follow the setup guides in [PHP & Debugging](php-debugging.md)

## 📊 Logging Issues

### Problem
PHP error logging not working.

### Solutions

1. **Check FPM configuration**:
   ```bash
   ./herd.php log on --dry-run
   ```
2. **Verify log file permissions**:
   ```bash
   ls -la "~/Library/Application Support/Herd/Log/php-fpm.log"
   ```
3. **Restart Herd**: `herd restart`

## 🎨 Error Template Issues

### Problem
Error templates not displaying.

### Solutions

1. **Verify template exists**:
   ```bash
   ls -la ~/Herd/.php-error-template
   ```
2. **Check WordPress site structure**:
   - Ensure `wp-config.php` exists
   - Ensure `wp-content/` directory exists
3. **Test with intentional error**:
   Add `<?php trigger_error('Test error');` to a theme file

## 📝 WP-CLI Issues

### Problem
WP-CLI commands fail or hang.

### Solutions

1. **Check WP-CLI installation**:
   ```bash
   wp --version
   ```
2. **Update WP-CLI**:
   ```bash
   wp cli update
   ```
3. **Clear WP-CLI cache**:
   ```bash
   wp cli cache clear
   ```

## 🔄 Script Hanging Issues

### Problem
Scripts appear to hang or take too long.

### Solutions

1. **Check internet connection** (for WordPress downloads)
2. **Use dry-run mode** to identify the problematic step:
   ```bash
   ./script-name --dry-run
   ```
3. **Check system resources** (CPU, memory, disk space)
4. **Restart Herd and try again**

## 🚫 Command Not Found

### Problem
`./script-name: command not found`

### Solutions

1. **Check you're in the right directory**:
   ```bash
   cd ~/Herd
   ls -la *.new *.delete
   ```
2. **Make scripts executable**:
   ```bash
   chmod +x wp.new wp.delete herd.xdebug herd.php wp.php
   ```

## 🗂️ Directory Issues

### Problem
Scripts can't create directories or files.

### Solutions

1. **Check permissions on ~/Herd directory**:
   ```bash
   ls -la ~/Herd
   ```
2. **Ensure you own the directory**:
   ```bash
   sudo chown -R $(whoami) ~/Herd
   ```
3. **Check available disk space**:
   ```bash
   df -h
   ```

## 🔍 Debugging Tips

### Enable Verbose Output
Most scripts provide detailed output. If you need more information:

1. **Use dry-run mode**: `--dry-run` shows what would happen
2. **Check log files**: Monitor relevant log files during operations
3. **Run commands manually**: Break down script operations and run them step by step

### Common Debug Commands
```bash
# Check Herd status
herd status

# Check WP-CLI
wp --info

# Check MySQL connection
mysql -h127.0.0.1 -uroot -e "SELECT VERSION();"

# Check PHP versions
php --version
herd php --version

# List Herd sites
herd links
```

## 🆘 Getting Help

If you continue experiencing issues:

1. **Check existing issues**: Look at the project's issue tracker
2. **Provide details**: Include error messages, system info, and steps to reproduce
3. **Use dry-run**: Show the output of `--dry-run` mode
4. **Include environment**: OS version, Herd version, PHP version, etc.

## 📋 System Requirements

Ensure your system meets these requirements:

- **macOS**: 10.15+ (tested on Sonoma 14.x)
- **Laravel Herd**: Latest version
- **WP-CLI**: Latest version
- **Available RAM**: 4GB+ recommended
- **Disk Space**: 1GB+ free space
- **Internet**: Required for WordPress downloads
