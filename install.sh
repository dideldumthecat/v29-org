#!/bin/bash
set -e

# Pick the PHP binary once; route both the config-reader and WP-CLI through it.
# IONOS ships `wp` as a shell wrapper that hardcodes PHP 8.0 and exports its own
# WP_CLI_PHP, so the env var can't move it — outside DDEV we bypass the wrapper
# and call the WP-CLI phar directly under 8.4. Inside DDEV, `php` is already 8.4.
if [ "${IS_DDEV_PROJECT:-}" = "true" ]; then
  _php=php
else
  _php=/usr/bin/php8.4-cli
  wp() { "$_php" /usr/share/php/wp-cli/wp-cli-*.phar "$@"; }
fi

# Read constants from wp-config-*.php into shell variables.
# PHP echoes assignments like WP_SITE_URL='https://...' and eval sets them here.
_config="$($_php -r "
if (getenv('IS_DDEV_PROJECT') === 'true') {
    define('ABSPATH', getcwd() . '/');
    require 'wp-config-ddev.php';
} else {
    require 'wp-config-production.php';
}
echo 'WP_SITE_URL='      . escapeshellarg(WP_SITEURL)       . PHP_EOL;
echo 'WP_SITE_TITLE='    . escapeshellarg(WP_SITE_TITLE)    . PHP_EOL;
echo 'WP_ADMIN_USER='    . escapeshellarg(WP_ADMIN_USER)    . PHP_EOL;
echo 'WP_ADMIN_PASSWORD='. escapeshellarg(WP_ADMIN_PASSWORD). PHP_EOL;
echo 'WP_ADMIN_EMAIL='   . escapeshellarg(WP_ADMIN_EMAIL)   . PHP_EOL;
echo 'MY_THEME='         . escapeshellarg(WP_THEME)         . PHP_EOL;
")" || { echo "Error: failed to read config — is wp-config-production.php on the server?" >&2; exit 1; }
eval "$_config"

wp core download --path=./ --locale=en_US || true
wp core install --path=./ --url="$WP_SITE_URL" --title="$WP_SITE_TITLE" --admin_user="$WP_ADMIN_USER" --admin_password="$WP_ADMIN_PASSWORD" --admin_email="$WP_ADMIN_EMAIL" || true

# Install the Secure Custom Fields and SMTP plugins
wp plugin install secure-custom-fields --activate --force
wp plugin install wp-mail-smtp --activate --force

# Activate theme
wp theme activate "$MY_THEME"

# Remove all other plugins except the SCF and SMTP plugins
wp plugin list --status=inactive --field=name | grep -v "wp-mail-smtp" | grep -v "secure-custom-fields" | while read -r name; do wp plugin delete "$name"; done

# Remove all other themes except the activated theme
wp theme list --status=inactive --field=name | grep -v "$MY_THEME" | while read -r name; do wp theme delete "$name"; done
