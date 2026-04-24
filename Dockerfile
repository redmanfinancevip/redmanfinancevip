FROM php:8.2-apache

# Install the MySQLi extension we worked so hard on
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copy your website files to the server
COPY . /var/www/html/

# Expose the port Render uses
EXPOSE 80


# Add this line to fix the "Headers already sent" error globally
RUN echo "output_buffering = On" >> /usr/local/etc/php/conf.d/docker-php-ext-ob.ini