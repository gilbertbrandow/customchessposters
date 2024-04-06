#!/bin/bash

# Run php artisan config:clear
php artisan config:clear

#Run command to cache config after environment variables has been set at runtime
php artisan config:cache