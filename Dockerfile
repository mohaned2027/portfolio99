FROM php:8.4-cli

# System deps
RUN apt-get update && apt-get install -y \
  git curl zip unzip libpng-dev libonig-dev libxml2-dev \
  && rm -rf /var/lib/apt/lists/*

# PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring bcmath gd

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy project
COPY . .

# Install deps
RUN composer install --no-dev --optimize-autoloader

# Laravel writable dirs (مهم جدًا)
RUN mkdir -p storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

# Railway supplies PORT; default 8080
ENV PORT=8080

EXPOSE 8080

CMD sh -lc 'php -S 0.0.0.0:${PORT} -t public'
