#!/bin/bash

# --- WordPress Management Script for Herd ---
# This script manages various WordPress settings and templates
#
# Date: January 2025

# Function to show usage
show_usage() {
    echo "🐘 --- WordPress Management for Laravel Herd --- 🐘"
    echo "This script manages WordPress settings and templates."
    echo "----------------------------------------------------"
    echo ""
    echo "Usage: $0 <command> [options] [site-directory|all] [--dry-run]"
    echo ""
    echo "Commands:"
    echo "  error-template [on|off] [site|all]  - Enable/disable PHP error templates"
    echo ""
    echo "Options:"
    echo "  --dry-run       - Show what would be changed without applying"
    echo ""
    echo "Examples:"
    echo "  $0 error-template on mysite       # Add error template to specific site"
    echo "  $0 error-template off mysite      # Remove error template from specific site"
    echo "  $0 error-template on all          # Add to all WordPress sites"
    echo "  $0 error-template off all         # Remove from all WordPress sites"
    echo "  $0 error-template on mysite --dry-run  # Preview adding template"
}

# Source php-error.php template path
TEMPLATE_FILE=".php-error-template"
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

# Function to check if directory is a WordPress site
is_wordpress_site() {
    local dir="$1"
    if [ -f "$dir/wp-config.php" ] && [ -d "$dir/wp-content" ]; then
        return 0
    fi
    return 1
}

# Function to add php-error.php to a site
add_php_error() {
    local site_dir="$1"
    local dry_run="$2"
    local target_file="$site_dir/wp-content/php-error.php"
    
    if [ ! -f "$SCRIPT_DIR/$TEMPLATE_FILE" ]; then
        echo "❌ Error: Template file not found at $SCRIPT_DIR/$TEMPLATE_FILE"
        return 1
    fi
    
    if is_wordpress_site "$site_dir"; then
        if [ -f "$target_file" ]; then
            if [ "$dry_run" = "true" ]; then
                echo "ℹ️ [DRY RUN] PHP error template already exists in $(basename "$site_dir") - would skip"
            else
                echo "ℹ️ PHP error template already exists in $(basename "$site_dir") - skipping"
            fi
        else
            if [ "$dry_run" = "true" ]; then
                echo "🔍 [DRY RUN] Would add PHP error template to $(basename "$site_dir")"
            else
                cp "$SCRIPT_DIR/$TEMPLATE_FILE" "$target_file"
                if [ $? -eq 0 ]; then
                    echo "✅ Added PHP error template to $(basename "$site_dir")"
                else
                    echo "❌ Failed to add PHP error template to $(basename "$site_dir")"
                fi
            fi
        fi
    else
        if [ "$dry_run" = "true" ]; then
            echo "⏭️ [DRY RUN] Would skip $(basename "$site_dir") - not a WordPress site"
        else
            echo "⏭️ Skipping $(basename "$site_dir") - not a WordPress site"
        fi
    fi
}

# Function to remove php-error.php from a site
remove_php_error() {
    local site_dir="$1"
    local dry_run="$2"
    local target_file="$site_dir/wp-content/php-error.php"
    
    if [ -f "$target_file" ]; then
        if [ "$dry_run" = "true" ]; then
            echo "🔍 [DRY RUN] Would remove PHP error template from $(basename "$site_dir")"
        else
            rm "$target_file"
            if [ $? -eq 0 ]; then
                echo "✅ Removed PHP error template from $(basename "$site_dir")"
            else
                echo "❌ Failed to remove PHP error template from $(basename "$site_dir")"
            fi
        fi
    else
        if [ "$dry_run" = "true" ]; then
            echo "ℹ️ [DRY RUN] PHP error template not found in $(basename "$site_dir") - already removed"
        else
            echo "ℹ️ PHP error template not found in $(basename "$site_dir") - already removed"
        fi
    fi
}

# Function to manage error templates
manage_error_template() {
    local action="$1"
    local target="$2"
    local dry_run="$3"
    
    # Capitalize first letter of action
    local action_cap="$(echo "$action" | sed 's/^./\U&/')"
    
    if [ "$dry_run" = "true" ]; then
        echo "🔍 --- DRY RUN: ${action_cap}ing PHP Error Templates --- 🔍"
        echo "This is a preview of changes that would be made."
    else
        echo "🐛 --- ${action_cap}ing PHP Error Templates --- 🐛"
        echo "This will $action PHP error templates for WordPress sites."
    fi
    echo "----------------------------------------------------"
    
    # Handle 'all' target
    if [ "$target" = "all" ]; then
        if [ "$dry_run" = "true" ]; then
            echo "🔍 [DRY RUN] Would process all directories in $SCRIPT_DIR..."
        else
            echo "🔍 Processing all directories in $SCRIPT_DIR..."
        fi
        
        local processed=0
        for dir in "$SCRIPT_DIR"/*; do
            if [ -d "$dir" ] && [ "$(basename "$dir")" != ".git" ]; then
                if [ "$action" = "add" ]; then
                    add_php_error "$dir" "$dry_run"
                else
                    remove_php_error "$dir" "$dry_run"
                fi
                processed=$((processed + 1))
            fi
        done
        
        if [ "$processed" -eq 0 ]; then
            if [ "$dry_run" = "true" ]; then
                echo "ℹ️ [DRY RUN] No WordPress sites found in $SCRIPT_DIR"
            else
                echo "ℹ️ No WordPress sites found in $SCRIPT_DIR"
            fi
        fi
    else
        # Handle specific site
        SITE_DIR="$SCRIPT_DIR/$target"
        
        if [ ! -d "$SITE_DIR" ]; then
            echo "❌ Error: Directory '$target' not found in $SCRIPT_DIR"
            exit 1
        fi
        
        if [ "$action" = "add" ]; then
            add_php_error "$SITE_DIR" "$dry_run"
        else
            remove_php_error "$SITE_DIR" "$dry_run"
        fi
    fi
    
    echo ""
    if [ "$dry_run" = "true" ]; then
        echo "🔍 [DRY RUN] No actual changes were made."
        echo "💡 Run without --dry-run to apply these changes."
    else
        echo "🎉 Operation completed!"
    fi
}

# Check arguments
if [ $# -lt 1 ]; then
    show_usage
    exit 1
fi

COMMAND="$1"

case "$COMMAND" in
    "error-template")
        if [ $# -lt 3 ]; then
            echo "❌ Error: error-template command requires action and target."
            echo "Usage: $0 error-template [on|off] [site-directory|all] [--dry-run]"
            exit 1
        fi
        
        ACTION="$2"
        TARGET="$3"
        DRY_RUN="false"
        
        # Check for dry-run flag
        if [ $# -eq 4 ] && [ "$4" = "--dry-run" ]; then
            DRY_RUN="true"
        elif [ $# -gt 3 ] && [ "$4" != "--dry-run" ]; then
            echo "❌ Error: Invalid option '$4'. Use --dry-run or omit."
            exit 1
        fi
        
        case "$ACTION" in
            "on")
                manage_error_template "add" "$TARGET" "$DRY_RUN"
                ;;
            "off")
                manage_error_template "remove" "$TARGET" "$DRY_RUN"
                ;;
            *)
                echo "❌ Error: Invalid action '$ACTION'. Use 'on' or 'off'."
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
