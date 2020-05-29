#!/bin/bash

#Apache 
docker run -d --name apache_static_1 res/apache_php
docker run -d --name apache_static_2 res/apache_php
docker run -d --name apache_static_3 res/apache_php



#Dynacmic server
docker run -d --name express_dynamic_1 res/express_students
docker run -d --name express_dynamic_2 res/express_students
docker run -d --name express_dynamic_3 res/express_students


ip_static_1=$(docker inspect -f "{{ .NetworkSettings.IPAddress }}"  apache_static_1 )
echo $ip_static_1
ip_static_2=$(docker inspect -f "{{ .NetworkSettings.IPAddress }}"  apache_static_2 )
echo $ip_static_2
ip_static_3=$(docker inspect -f "{{ .NetworkSettings.IPAddress }}"  apache_static_3 )
echo $ip_static_3


ip_dynamic_1=$(docker inspect -f "{{ .NetworkSettings.IPAddress }}"  express_dynamic_1 )
echo $ip_dynamic_1
ip_dynamic_2=$(docker inspect -f "{{ .NetworkSettings.IPAddress }}"  express_dynamic_2 )
echo $ip_dynamic_2
ip_dynamic_3=$(docker inspect -f "{{ .NetworkSettings.IPAddress }}"  express_dynamic_3 )
echo $ip_dynamic_3

#Reverse proxy
docker run -d \
-e STATIC_APP_1="$ip_static_1:80" \
-e STATIC_APP_2="$ip_static_2:80"  \
-e STATIC_APP_3="$ip_static_3:80"  \
-e DYNAMIC_APP_1="$ip_dynamic_1:3000" \
-e DYNAMIC_APP_2="$ip_dynamic_2:3000" \
-e DYNAMIC_APP_3="$ip_dynamic_3:3000" \
--name reverse_proxy -p 8080:80 res/apache_rp