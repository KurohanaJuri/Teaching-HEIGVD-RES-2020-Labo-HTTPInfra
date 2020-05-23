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

To run a dynamic server, we need `nodejs` ([download here](https://nodejs.org/en/)) and `npm`, we used [node's container](https://hub.docker.com/_/node/) with the version 12.16

We also need Express.js framework, run `npm install express-generator -g` on the terminal, to install it as a global installation.

In this project we use Express.js and chance.js, to intall the dependece run  `./install-npm-dependance.sh` in `docker-images/express-image/src/`

### 1.3 Reverse proxy

To have access at our site, you need to map your machine IP to our size address [demo.res.ch](demo.res.ch). In the file `hosts` (Linux : `/etc/hosts`), you need to add `YOUR_IP    demo.res.ch`. If you want to test if the IP is correctly mapped, you can ping our site address, if it's correct, you receive a response.

<a name="setup"/>

## 2. Setup
Before doing anything make sure to :
* Download or clone this repository
* Start docker
* Go to your local repository's directory in docker

### 2.1 Launching the static server 

* Go into the `docker-images/apache-php-image/` directory 
* Run the script `build-image.sh` 
* Run the script `run-container.sh`
* Access the server on your docker local address, i.e. http://192.168.99.101:9090/ 

### 2.2 Launching the dynamic server
* Go into the `docker-images/express-image/src` directory 
* Run the script `install-npm-dependance.sh`
* Go back to `docker-images/express-image`
* Run the script `build-image.sh` 
* Run the script `run-container.sh`
The dynamic server listen on port 3000.

### 2.3 Reverse proxy with apache

The IP of the 2 container (static server and the dynamic server) are hardcoded. In our case the apache static is on 172.17.0.2:80 and the express dynamic is on 172.18.0.3:3000

### 2.4 AJAX requests with JQuery

Every 30 seconds our website show a array of random numbers, with data comming from dynamic server.
It's only work with the reverse proxy because the dynamc server and the static had a different IP and the reverse proxy is here to redirect differents resquests to the correct server.
