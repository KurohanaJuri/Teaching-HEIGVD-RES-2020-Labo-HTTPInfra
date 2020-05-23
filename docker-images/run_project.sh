#!/bin/bash

#Apache 
docker run -d --name apache_static res/apache_php

#Dynacmic server
docker run -d --name express_dynamic res/express_students

ip_static=$(docker inspect -f "{{ .NetworkSettings.IPAddress }}"  apache_static )
echo $ip_static

ip_dynamic=$(docker inspect -f "{{ .NetworkSettings.IPAddress }}"  express_dynamic )
echo $ip_dynamic

#Reverse proxy
docker run -d -e STATIC_APP="$ip_static:80" -e DYNAMIC_APP="$ip_dynamic:3000" --name reverse_proxy -p 8080:80 res/apache_rp