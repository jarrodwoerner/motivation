#!/bin/sh
set -e

# Create necessary directories
mkdir -p /var/log/supervisor
mkdir -p /var/run
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/storage/app/public
mkdir -p /var/www/html/storage/framework/cache
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/bootstrap/cache
mkdir -p /var/www/html/database

# Wait for database to be ready (if DATABASE_URL is set)
if [ -n "$DATABASE_URL" ]; then
    echo "Waiting for database..."
    sleep 5
fi

# Create SQLite database if using SQLite
if [ "$DB_CONNECTION" = "sqlite" ]; then
    touch /var/www/html/database/database.sqlite
    chown www-data:www-data /var/www/html/database/database.sqlite
fi

# Run migrations
php artisan migrate --force

# Clear and cache configuration
php artisan config:clear

# Only cache if not in local environment
if [ "$APP_ENV" != "local" ]; then
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
fi

# Generate application key if not set
if [ -z "$APP_KEY" ]; then
    echo "APP_KEY not set, generating new key..."
    php artisan key:generate --force --show
fi

# Output environment for debugging
echo "Environment: APP_ENV=$APP_ENV"
echo "Debug Mode: APP_DEBUG=$APP_DEBUG"
echo "URL: APP_URL=$APP_URL"
echo "Database: DB_CONNECTION=$DB_CONNECTION"

# Test database connection (skip if intl extension missing)
php -m | grep -q intl && php artisan db:show || echo "Skipping database test..."

# Create storage symlink
php artisan storage:link || true

# Set proper permissions
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache
chown -R www-data:www-data /var/www/html/database

echo "Application ready!"

# Execute the main command
exec "$@"