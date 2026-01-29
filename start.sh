#!/usr/bin/env sh
set -e

echo "Running pre-start tasks..."

# Clear caches (مش لازم يفشل لو مش موجود)
php artisan optimize:clear || true

# Run migrations (لو DB موجودة)
php artisan migrate --force --no-interaction || true

# Fix permissions (احتياطي)
chmod -R 775 storage bootstrap/cache || true

echo "Starting PHP server on port: ${PORT:-8080}"
php -S 0.0.0.0:${PORT:-8080} -t public
