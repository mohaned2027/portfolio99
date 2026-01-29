#!/usr/bin/env sh
set -e

echo "Running pre-start tasks..."

# Clear caches (important when env changes on Railway)
php artisan optimize:clear || true

# Fix permissions
chmod -R 775 storage bootstrap/cache || true

# (Optional) wait a bit for DB to be ready (especially first deploy)
echo "Checking database connection..."
php -r '
try {
  $pdo = new PDO(
    "mysql:host=" . getenv("DB_HOST") . ";port=" . getenv("DB_PORT") . ";dbname=" . getenv("DB_DATABASE"),
    getenv("DB_USERNAME"),
    getenv("DB_PASSWORD"),
    [PDO::ATTR_TIMEOUT => 3]
  );
  echo "DB OK\n";
} catch (Exception $e) {
  echo "DB NOT READY: " . $e->getMessage() . "\n";
  exit(0);
}
' || true

# Run migrations ONLY if DB is reachable
echo "Running migrations (if possible)..."
php artisan migrate --force --no-interaction || true

echo "Starting PHP server on port: ${PORT:-8080}"
exec php -S 0.0.0.0:${PORT:-8080} -t public
