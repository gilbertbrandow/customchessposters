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

# Install npm dependencies
RUN npm install

# Install esbuild for x86 architecture
RUN if [ "$(arch)" = "x86_64" ]; then \
        npm install --arch=x64 esbuild; \
    else \
        npm install --arch=arm64 esbuild; \
    fi

# Build frontend assets
RUN npm run build

# Run Composer commands
RUN composer update && \
    composer install --optimize-autoloader --no-dev && \
    php artisan optimize && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    chown -R application:application .