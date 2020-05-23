# PHP with apache
FROM php:7.2-apache

# install nano
RUN apt-get update && apt-get install nano

# /var/www/html/ container file system arborescence
# Static copy
# content/ site sources
# Apache config file are in /etc/apache2/
COPY content/ /var/www/html/