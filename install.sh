#!/bin/bash
set -e

_php="${PHP_BINARY:-php}"
export WP_CLI_PHP="$_php"
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
wp plugin list --status=inactive --field=name | grep -v "wp-mail-smtp" | grep -v "secure-custom-fields" | xargs -I {} wp plugin delete {}

# Remove all other themes except the activated theme
wp theme list --status=inactive --field=name | grep -v "$MY_THEME" | xargs -I {} wp theme delete {}
