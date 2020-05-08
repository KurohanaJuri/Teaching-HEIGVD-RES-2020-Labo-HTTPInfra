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

<a name="setup"/>

## 2. Setup

### 2.1 Launching the static server 

* Download this repository
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
