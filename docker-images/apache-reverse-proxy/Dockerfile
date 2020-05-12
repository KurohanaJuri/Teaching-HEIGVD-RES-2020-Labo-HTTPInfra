FROM php:7.2-apache

COPY conf/ /etc/apache2/

# Enable mod for reverse proxy
RUN a2enmod proxy proxy_http

# Enable a default site and our site
RUN a2ensite 000-* 001-*