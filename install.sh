#!/bin/bash
set -e

# PHP binary: explicit override via PHP_BINARY env var, otherwise probe for php8.4-cli.
_php="${PHP_BINARY:-$(command -v php8.4-cli || command -v php8.4 || command -v php)}"

# IONOS's system `wp` wrapper hardcodes /usr/bin/php8.0-cli and ignores WP_CLI_PHP.
# Find the WP-CLI PHAR and invoke it directly with $_php instead.
_wp_phar="$(find /usr/share/php/wp-cli -name '*.phar' 2>/dev/null | sort | tail -1)"
if [ -n "$_wp_phar" ]; then
    wp() { "$_php" "$_wp_phar" "$@"; }
fi

# Read constants from wp-config-*.php into shell variables.
# PHP echoes assignments like WP_SITE_URL='https://...' and eval sets them here.
eval "$($_php -r "
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
")"

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
