# Start with the PHP and Nginx setup
FROM webdevops/php-nginx:8.1-alpine AS php-nginx

# Install Laravel framework system requirements
RUN apk add oniguruma-dev postgresql-dev libxml2-dev libpng-dev nodejs npm

RUN docker-php-ext-install \
    gd \
    pcntl \
    bcmath \
    mysqli \
    pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set environment variables
ENV WEB_DOCUMENT_ROOT /app/public
ENV APP_ENV production

# Set the working directory
WORKDIR /app

# Copy the rest of your application
COPY . .

# Copy clear cache script into directory that is executed on container start
COPY entrypoint.sh /opt/docker/provision/entrypoint.d/entrypoint.sh

# Install npm dependencies
RUN npm install

# Build frontend assets
RUN npm run build

# Run Composer commands
RUN composer update && \
    composer install --optimize-autoloader --no-dev

# Laravel production optimization
RUN php artisan optimize && \
    php artisan route:cache && \
    php artisan view:cache

# Change file ownership
RUN chown -R application:application .