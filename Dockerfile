# Stage 1: Build frontend assets using Node.js
FROM node:14 AS frontend-builder

WORKDIR /app

# Copy package.json and package-lock.json
COPY package.json package-lock.json* ./

# Install npm dependencies
RUN npm install

# Copy the rest of your frontend source code
COPY . .

# Conditionally install esbuild based on architecture
RUN if [ "$(arch)" = "aarch64" ]; then \
        npm install esbuild-linux-arm64; \
    else \
        npm install esbuild-linux-64; \
    fi

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