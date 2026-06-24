#!/bin/bash

# Enable debugging and logging
#set -x

# Load environment variables from the .env file
set -a
source .env
set +a

${COMPOSER_COMMAND}

wp core download --path=./ --locale=en_US
wp core install --path=./ --url="$WP_SITE_URL" --title="$WP_SITE_TITLE" --admin_user="$WP_ADMIN_USER" --admin_password="$WP_ADMIN_PASSWORD" --admin_email="$WP_ADMIN_EMAIL"

# Install the Secure Custom Fields and SMTP plugins
wp plugin install secure-custom-fields --activate
wp plugin install wp-mail-smtp --activate

# Activate theme
wp theme activate "$MY_THEME"

# Remove all other plugins except the SCF and SMTP plugins
wp plugin list --status=inactive --field=name | grep -v "wp-mail-smtp" | grep -v "secure-custom-fields" | xargs -I {} wp plugin delete {}

# Remove all other themes except the activated theme
wp theme list --status=inactive --field=name | grep -v "$MY_THEME" | xargs -I {} wp theme delete {}

# For local development
# wp user update admin --user_pass=admin