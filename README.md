# Teaching-HEIGVD-RES-2020-Labo-HTTPInfra

##### Table of Contents

[0. Before starting](#beforestarting)  
[1. Configuration](#config)  
[2. Setup](#setup)  

<a name="beforestarting"/>

## 0. Before starting

Before you can start launching servers left and right, make sure you have the proper setup. Here are the tools we used and that you will need to get the full experience : 

| Windows       | Linux         |
| ------------- |:-------------:|
| [Docker Toolbox](https://docs.docker.com/toolbox/toolbox_install_windows/)| [Docker Engine](https://docs.docker.com/engine/install/) |

<a name="config"/>

## 1. Configuration

### 1.1 Static server

For the static server, we used [Apache's httpd container for php](https://hub.docker.com/_/php/).

### 1.2 Dynamic server

To run a dynamic server, we need `nodejs` and `npm`, we used [node](https://hub.docker.com/_/node/) with the version 12.16

We also need Express.js framework, run `npm install express-generator -g` on the terminal, to install it as a global installation.

In this project we use Express.js and chance.js, to intall the dependece run  `./install-npm-dependance.sh` in `docker-images/express-image/src/`

### 1.3 Reverse proxy

To have access at our site, you need to map your machine IP to our size address [demo.res.ch](demo.res.ch). In the file `hosts` (Linux : `/etc/hosts`), you need to add `YOUR_IP    demo.res.ch`. If you want to test if the IP is correctly mapped, you can ping our site address, if it's correct, you receive a response.

<a name="setup"/>

## 2. Setup
Before doing anything make sure to download this repository :)

### 2.1 Launching the static server 

* Start docker and go to your local repository directory and build the container with the command in the folder  `docker-images/apache-php-image`: 
```
docker build -t res/apache_php .
```
* Run the container to start the server on the port 9090 :
```
docker run -d -p 9090:80 php:7.2-apache
```
* Access the server on your docker local address, i.e. http://192.168.99.101:9090/ 

### 2.2 Launching the dynamic server

* Run build-image.sh
* Run run-container.sh

The dynamic server listen on port 3000.

### 2.3

The IP of the 2 container (static server and the dynamic server) are hardcoded. In our case the apache static is on 172.17.0.2:80 and the express dynamic is on 172.18.0.3:3000
