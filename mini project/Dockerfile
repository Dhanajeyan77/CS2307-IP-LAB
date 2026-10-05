FROM php:8.1-apache

# Install PDO MySQL extension
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite (optional but good practice)
RUN a2enmod rewrite

# Copy the application source code to the container
COPY . /var/www/html/

# Set permissions for the uploads directory so users can upload files
RUN if [ -d "/var/www/html/uploads" ]; then chmod -R 777 /var/www/html/uploads; fi
