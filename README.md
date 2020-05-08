# Teaching-HEIGVD-RES-2020-Labo-HTTPInfra

## Configuration setup 

### Launching the server from docker

* Download this repository
* Start docker and go to your local repository directory and build the container with the command : 
```
docker build -t res/apache_php .
```
* Run the container to start the server on the port 9090 :
```
docker run -d -p 9090:80 php:7.2-apache
```