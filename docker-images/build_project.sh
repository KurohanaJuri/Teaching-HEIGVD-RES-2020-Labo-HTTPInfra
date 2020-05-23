#!/bin/bash

# Apache
docker build -t res/apache_php apache-php-image

# Dynamic server
docker build -t res/express_students express-image

#Install npm dependencie
# npm install --save chance
# npm install --save express

# Reverse proxy
docker build -t res/apache_rp apache-reverse-proxy
