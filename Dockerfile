FROM php:8.2-fpm

# Installation des dépendances système
RUN apt-get update && apt-get install -y \
    git unzip libicu-dev libpq-dev libzip-dev nginx \
    && docker-php-ext-install intl pdo pdo_mysql zip opcache

# Configuration Nginx
COPY .nginx.conf /etc/nginx/sites-available/default

WORKDIR /var/www/html

# Copie du projet (exclut var/ et vendor/ grâce au .dockerignore)
COPY . .

# Forcer l'environnement de production pour Composer
ENV APP_ENV=prod
ENV COMPOSER_ALLOW_SUPERUSER=1

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Exécution manuelle du warmup du cache de prod
RUN php bin/console cache:clear --env=prod

# Permissions
RUN chown -R www-data:www-data /var/www/html/var

EXPOSE 80

CMD service nginx start && php-fpm