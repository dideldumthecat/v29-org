#!/bin/bash

# Enable debugging and logging
#set -x

# Load environment variables from the .env file
set -a
source .env
set +a

# Pick the PHP binary once; route both the config-reader and WP-CLI through it.
# IONOS ships `wp` as a shell wrapper that hardcodes PHP 8.0 and exports its own
# WP_CLI_PHP, so the env var can't move it — outside DDEV we bypass the wrapper
# and call the WP-CLI phar directly under 8.4. Inside DDEV, `php` is already 8.4.
wp() { command $INSTALL_WP_COMMAND "$@"; }

# Approved plugins — add/remove entries here only
PLUGINS=(
  secure-custom-fields
  wp-mail-smtp
)

# First install commands
wp core download --path=./ --locale=en_US || true
wp core install --path=./ --url="$INSTALL_SITE_URL" --title="$INSTALL_SITE_TITLE" --admin_user="$INSTALL_ADMIN_USER" --admin_password="$INSTALL_ADMIN_PASSWORD" --admin_email="$INSTALL_ADMIN_EMAIL"

# Install and activate approved plugins (skips download if already present)
for plugin in "${PLUGINS[@]}"; do
  wp plugin install "$plugin" --activate
done

# Activate theme
wp theme activate "V29"

# Delete any plugin not in the approved list (active or inactive)
is_approved_plugin() {
  local name="$1" p
  for p in "${PLUGINS[@]}"; do [ "$name" = "$p" ] && return 0; done
  return 1
}
while read -r name; do
  is_approved_plugin "$name" || wp plugin delete "$name"
done < <(wp plugin list --field=name)

# Remove all other themes except the activated theme
wp theme list --status=inactive --field=name | grep -v "V29" | while read -r name; do wp theme delete "$name"; done

# For local development
# wp user update admin --user_pass=admin
