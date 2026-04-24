FROM php:8.2-apache

# Install the MySQLi extension we worked so hard on
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copy your website files to the server
COPY . /var/www/html/

# Expose the port Render uses
EXPOSE 80