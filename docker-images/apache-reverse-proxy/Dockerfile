FROM php:7.2-apache

# install nano
RUN apt-get update && apt-get install nano

# Copy our version of the script
COPY apache2-foreground /usr/local/bin/

# Copy template dir
COPY templates /var/apache2/templates

COPY conf/ /etc/apache2/

# Enable mod for reverse proxy
RUN a2enmod proxy proxy_http

# Enable a default site and our site
RUN a2ensite 000-* 001-*

