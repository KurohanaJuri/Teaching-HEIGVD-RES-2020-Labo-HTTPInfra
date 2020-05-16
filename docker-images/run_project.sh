#Apache 
docker run -d --name apache_static res/apache_php

#Dynacmic server
docker run -d --name express_dynamic res/express_students

#Reverse proxy
docker run -d --name reverse_proxy -p 8080:80 res/apache_rp