#!/usr/bin/env sh
set -e

echo "=============================="
echo "🚀 Starting Laravel on Railway"
echo "=============================="

# Go to app directory (safety)
cd /var/www

echo "🧹 Clearing caches..."
php artisan config:clear || true
php artisan cache:clear || true
php artisan route:clear || true
php artisan view:clear || true
php artisan optimize:clear || true

echo "🔐 Fixing permissions..."
chmod -R 775 storage bootstrap/cache || true

echo "🛢️ Checking database connection..."
php -r '
$host = getenv("DB_HOST");
$port = getenv("DB_PORT") ?: "3306";
$db   = getenv("DB_DATABASE");
$user = getenv("DB_USERNAME");
$pass = getenv("DB_PASSWORD");

if (!$host || !$db || !$user) {
  fwrite(STDERR, "DB env missing: DB_HOST/DB_DATABASE/DB_USERNAME\n");
  exit(1);
}

$dsn = "mysql:host={$host};port={$port};dbname={$db}";
try {
  new PDO($dsn, $user, $pass, [PDO::ATTR_TIMEOUT => 5]);
  echo "✅ DB Connected\n";
} catch (Exception $e) {
  fwrite(STDERR, "❌ DB Connection Failed: " . $e->getMessage() . "\n");
  exit(1);
}
'

echo "📦 Running migrations..."
php artisan migrate --force --no-interaction

echo "✅ Migrations done"

echo "🌐 Starting PHP server on port: ${PORT:-8080}"
exec php -S 0.0.0.0:${PORT:-8080} -t public
