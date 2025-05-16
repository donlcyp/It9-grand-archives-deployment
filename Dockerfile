FROM richarvey/nginx-php-fpm:3.1.6

FROM php:8.4-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    supervisor \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Copy application code
COPY . /var/www/html

# Copy configuration files
COPY ./php-fpm.conf /etc/php/8.4/fpm/pool.d/www.conf
COPY ./nginx.conf /etc/nginx/sites-available/default
COPY ./supervisord.conf /etc/supervisor/supervisord.conf

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R ug+rwx /var/www/html/storage /var/www/html/bootstrap/cache \
    && mkdir -p /var/run && chown www-data:www-data /var/run

# Install Composer dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --optimize-autoloader --no-dev --working-dir=/var/www/html

# Run migrations and clear cache
RUN php /var/www/html/artisan config:clear \
    && php /var/www/html/artisan migrate --force


COPY . .

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]
