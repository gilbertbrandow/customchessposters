# Stage 1: Build frontend assets using Node.js
FROM node:14 AS frontend-builder

WORKDIR /app

# Copy package.json and package-lock.json
COPY package.json package-lock.json* ./

# Install npm dependencies
RUN npm install

# Copy the rest of your frontend source code
COPY . .

# Build frontend assets
RUN npm run build

# Next build step
FROM webdevops/php-nginx:8.1-alpine

# Install Laravel framework system requirements
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

# Copy the built frontend assets from the previous stage
COPY --from=frontend-builder /app ./

# Copy clear cache script into directory that is executed on container start
COPY entrypoint.sh /opt/docker/provision/entrypoint.d/entrypoint.sh

# Update composer, run laravel commands for production optimization & change owner of repo
RUN composer update --optimize-autoloader --no-dev && \
    composer install --optimize-autoloader --no-dev && \
    php artisan optimize && \
    php artisan route:cache && \
    php artisan view:cache && \
    chown -R application:application .