FROM webdevops/php-nginx:8.1-alpine

# Install Laravel framework system requirements (https://laravel.com/docs/8.x/deployment#optimizing-configuration-loading)
RUN apk add oniguruma-dev postgresql-dev libxml2-dev libpng-dev

RUN docker-php-ext-install \
    gd \
    pcntl \
    bcmath \
    mysqli \
    pdo_mysql

# Copy Composer binary from the Composer official Docker image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV WEB_DOCUMENT_ROOT /app/public

ENV APP_ENV production

WORKDIR /app

COPY . .

RUN composer update 

RUN composer install --optimize-autoloader --no-dev

RUN php artisan optimize

# Optimizing Configuration loading
RUN php artisan config:cache

# Optimizing Route loading
RUN php artisan route:cache

# Optimizing View loading
RUN php artisan view:cache

RUN chown -R application:application .