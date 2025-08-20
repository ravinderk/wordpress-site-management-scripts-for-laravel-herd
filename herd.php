#!/bin/bash

# --- PHP Management Script for Laravel Herd ---
# This script manages various PHP settings in Herd
#
# Date: January 2025

# Function to show usage
show_usage() {
    echo "🐘 --- PHP Management for Laravel Herd --- 🐘"
    echo "This script manages PHP settings in Herd."
    echo "----------------------------------------------------"
    echo ""
    echo "Usage: $0 <command> [options] [--dry-run]"
    echo ""
    echo "Commands:"
    echo "  log [on|off]    - Enable/disable PHP error logging"
    echo ""
    echo "Options:"
    echo "  --dry-run       - Show what would be changed without applying"
    echo ""
    echo "Examples:"
    echo "  $0 log on         # Enable PHP logging"
    echo "  $0 log off        # Disable PHP logging"
    echo "  $0 log on --dry-run   # Preview enabling PHP logging"
}

# --- Function to check if a command exists ---
command_exists () {
  type "$1" &> /dev/null ;
}

# Function to configure PHP logging
configure_php_logging() {
    local action="$1"
    local action_desc="$2"
    local emoji="$3"
    local dry_run="$4"
    
    if [ "$dry_run" = "true" ]; then
        echo "🔍 --- DRY RUN: $action_desc PHP Logging for Laravel Herd --- 🔍"
        echo "This is a preview of changes that would be made."
    else
        echo "$emoji --- $action_desc PHP Logging for Laravel Herd --- $emoji"
    fi
    echo "This script will $action_desc PHP error logging in FPM configs."
    echo "----------------------------------------------------"
    
    # --- Check for Herd ---
    echo "🔍 Checking for Herd..."
    if ! command_exists herd ; then
      echo "❌ Error: Herd is not found. Please install Herd (https://herd.laravel.com/) and ensure it's in your system's PATH."
      exit 1
    fi
    echo "✅ Herd found."
    
    # --- Configure PHP Logging ---
    if [ "$dry_run" = "true" ]; then
        echo "🔍 [DRY RUN] Would be ${action_desc}ing PHP logging..."
    else
        echo "🔧 ${action_desc}ing PHP logging..."
    fi
    
    # Define Herd FPM config directory
    HERD_FPM_CONFIG_DIR="$HOME/Library/Application Support/Herd/config/fpm"
    
    if [ ! -d "$HERD_FPM_CONFIG_DIR" ]; then
        echo "❌ Error: Herd FPM config directory not found at $HERD_FPM_CONFIG_DIR"
        exit 1
    fi
    
    echo "📁 Found Herd FPM config directory: $HERD_FPM_CONFIG_DIR"
    
    # Configure logging in all FPM config files
    if [ "$dry_run" = "true" ]; then
        echo "🔍 [DRY RUN] Would configure PHP logging in all FPM configs..."
    else
        echo "⚙️ Configuring PHP logging in all FPM configs..."
    fi
    
    local changes_made=0
    local total_configs=0
    
    for fpm_config in "$HERD_FPM_CONFIG_DIR"/*-fpm.conf; do
        if [ -f "$fpm_config" ]; then
            total_configs=$((total_configs + 1))
            PHP_VERSION=$(basename "$fpm_config" | sed 's/-fpm.conf//')
            
            # Check current state
            local error_log_active=$(grep -c "^php_admin_value\[error_log\]" "$fpm_config" 2>/dev/null | head -1)
            local log_errors_active=$(grep -c "^php_admin_flag\[log_errors\]" "$fpm_config" 2>/dev/null | head -1)
            local error_log_commented=$(grep -c "^;php_admin_value\[error_log\]" "$fpm_config" 2>/dev/null | head -1)
            local log_errors_commented=$(grep -c "^;php_admin_flag\[log_errors\]" "$fpm_config" 2>/dev/null | head -1)
            
            # Ensure we have valid integers
            error_log_active=${error_log_active:-0}
            log_errors_active=${log_errors_active:-0}
            error_log_commented=${error_log_commented:-0}
            log_errors_commented=${log_errors_commented:-0}
            
            local currently_enabled=false
            if [ "$error_log_active" -gt 0 ] || [ "$log_errors_active" -gt 0 ]; then
                currently_enabled=true
            fi
            
            if [ "$dry_run" = "true" ]; then
                echo "🔍 [DRY RUN] Would configure PHP $PHP_VERSION: $fpm_config"
                
                if [ "$action" = "enable" ]; then
                    if [ "$currently_enabled" = "true" ]; then
                        echo "ℹ️ [DRY RUN] PHP logging already enabled for PHP $PHP_VERSION"
                    else
                        echo "   → Would uncomment logging directives"
                        echo "🔍 [DRY RUN] Would enable PHP logging for PHP $PHP_VERSION"
                        changes_made=$((changes_made + 1))
                    fi
                else
                    if [ "$currently_enabled" = "false" ]; then
                        echo "ℹ️ [DRY RUN] PHP logging already disabled for PHP $PHP_VERSION"
                    else
                        echo "   → Would comment out logging directives"
                        echo "🔍 [DRY RUN] Would disable PHP logging for PHP $PHP_VERSION"
                        changes_made=$((changes_made + 1))
                    fi
                fi
            else
                echo "🔧 Configuring PHP $PHP_VERSION: $fpm_config"
                
                if [ "$action" = "enable" ]; then
                    if [ "$currently_enabled" = "true" ]; then
                        echo "ℹ️ PHP logging already enabled for PHP $PHP_VERSION - skipping"
                    else
                        # Enable logging by uncommenting the lines
                        sed -i '' 's/^;php_admin_value\[error_log\]/php_admin_value[error_log]/' "$fpm_config"
                        sed -i '' 's/^;php_admin_flag\[log_errors\]/php_admin_flag[log_errors]/' "$fpm_config"
                        echo "✅ Enabled PHP logging for PHP $PHP_VERSION"
                        changes_made=$((changes_made + 1))
                    fi
                else
                    if [ "$currently_enabled" = "false" ]; then
                        echo "ℹ️ PHP logging already disabled for PHP $PHP_VERSION - skipping"
                    else
                        # Disable logging by commenting the lines
                        sed -i '' 's/^php_admin_value\[error_log\]/;php_admin_value[error_log]/' "$fpm_config"
                        sed -i '' 's/^php_admin_flag\[log_errors\]/;php_admin_flag[log_errors]/' "$fpm_config"
                        echo "✅ Disabled PHP logging for PHP $PHP_VERSION"
                        changes_made=$((changes_made + 1))
                    fi
                fi
            fi
        fi
    done
    
    if [ "$dry_run" = "true" ]; then
        echo ""
        if [ "$changes_made" -eq 0 ]; then
            echo "ℹ️ [DRY RUN] No changes needed - PHP logging is already ${action}d for all versions"
        else
            echo "🔍 [DRY RUN] Would make changes to $changes_made out of $total_configs PHP configurations"
            echo "🔍 [DRY RUN] Would restart Herd to apply configuration changes..."
        fi
        echo "🔍 [DRY RUN] No actual changes were made."
        echo ""
        echo "💡 Run without --dry-run to apply these changes."
    else
        if [ "$changes_made" -eq 0 ]; then
            echo ""
            echo "ℹ️ No changes made - PHP logging is already ${action}d for all versions"
            echo "🎯 Configuration is already in the desired state!"
        else
            echo "✅ PHP logging ${action_desc}d successfully! ($changes_made/$total_configs configurations changed)"
            
            # Restart Herd to apply changes
            echo "🔄 Restarting Herd to apply configuration changes..."
            herd restart
            if [ $? -eq 0 ]; then
                echo "✅ Herd restarted successfully!"
            else
                echo "⚠️ Warning: Failed to restart Herd. You may need to restart manually."
            fi
        fi
        
        if [ "$action" = "enable" ]; then
            echo ""
            echo "📝 PHP Error Log Location:"
            echo "   $HOME/Library/Application Support/Herd/Log/php-fpm.log"
            echo ""
            echo "💡 You can tail the log with:"
            echo "   tail -f \"$HOME/Library/Application Support/Herd/Log/php-fpm.log\""
            echo ""
            echo "📊 Happy Debugging!"
        else
            echo ""
            echo "💡 Notice: PHP FPM logging is now disabled."
            echo "   You can still check WordPress debug logs in individual sites:"
            echo "   ~/Herd/[site-name]/wp-content/debug.log"
            echo ""
            echo "🚀 PHP logging disabled for better performance!"
        fi
    fi
}

# Check arguments
if [ $# -lt 1 ]; then
    show_usage
    exit 1
fi

COMMAND="$1"

case "$COMMAND" in
    "log")
        if [ $# -lt 2 ]; then
            echo "❌ Error: log command requires on/off parameter."
            echo "Usage: $0 log [on|off] [--dry-run]"
            exit 1
        fi
        
        LOG_ACTION="$2"
        DRY_RUN="false"
        
        # Check for dry-run flag
        if [ $# -eq 3 ] && [ "$3" = "--dry-run" ]; then
            DRY_RUN="true"
        elif [ $# -gt 2 ] && [ "$3" != "--dry-run" ]; then
            echo "❌ Error: Invalid option '$3'. Use --dry-run or omit."
            exit 1
        fi
        
        case "$LOG_ACTION" in
            "on")
                configure_php_logging "enable" "Enable" "📊" "$DRY_RUN"
                ;;
            "off")
                configure_php_logging "disable" "Disable" "📊❌" "$DRY_RUN"
                ;;
            *)
                echo "❌ Error: Invalid log action '$LOG_ACTION'. Use 'on' or 'off'."
                exit 1
                ;;
        esac
        ;;
    *)
        echo "❌ Error: Invalid command '$COMMAND'."
        show_usage
        exit 1
        ;;
esac
