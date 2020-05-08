# Teaching-HEIGVD-RES-2020-Labo-HTTPInfra

##### Table of Contents  
[0. Before starting](#beforestarting)  
[1. Configuration](#config)  
[2. Setup](#setup)  

<a name="beforestarting"/>
## 0. 

<a name="config"/>
## 1. Configuration 

### 1.1 Static server

For the static server, we used [Apache's httpd container for php](https://hub.docker.com/_/php/).

### 1.2 Dynamic server

Todo : used express.js

<a name="setup"/>
## 2. Setup

### 2.1 Launching the static server 

* Download this repository
* Start docker and go to your local repository directory and build the container with the command : 
```
docker build -t res/apache_php .
```
* Run the container to start the server on the port 9090 :
```
docker run -d -p 9090:80 php:7.2-apache
```
* Access the server on your docker local address, i.e. http://192.168.99.101:9090/ 

### 2.2 Launching the dynamic server

To launch the dynamic server you just need to go to the 
* Install nodejs and npm
* Install `npm install express-generator -g`
* run src/install-npm-dependance.sh
* run build-image.sh
* run run-container.sh