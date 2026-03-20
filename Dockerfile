# Using official PHP Apache image (similar to XAMPP's Apache + PHP)
FROM php:8.2-apache

# Enable Apache modules (same as XAMPP)
RUN a2enmod rewrite \
    && a2enmod headers \
    && a2enmod expires

# Copy all your PHP files to the web root
# This is like copying to C:\xampp\htdocs\ on your Windows
COPY . /var/www/html/

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Configure Apache to listen on port 10000 (Render requirement)
RUN sed -i 's/80/10000/g' /etc/apache2/ports.conf \
    && sed -i 's/80/10000/g' /etc/apache2/sites-available/000-default.conf

# Enable error logging (helpful for debugging)
RUN echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php.ini \
    && echo "display_errors = On" >> /usr/local/etc/php/conf.d/docker-php.ini

# Set working directory
WORKDIR /var/www/html

# Expose port 10000 (Render requirement)
EXPOSE 10000

# Start Apache
CMD ["apache2-foreground"]