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


This project is tested on Ubuntu 18.04 and Docker version 19.03.8 

<a name="config"/>

## 1. Configuration

### 1.1 Static server

For the static server, we used [Apache's httpd container for php](https://hub.docker.com/_/php/) (version php:7.2-apache)

### 1.2 Dynamic server

To run a dynamic server, we need `nodejs` ([download here](https://nodejs.org/en/)) and `npm`, we used [node's container](https://hub.docker.com/_/node/) with the version 12.16

We also need Express.js framework, run `npm install express-generator -g` on the terminal, to install it as a global installation.

In this project we use Express.js and chance.js, to intall the dependece run  `./install-npm-dependance.sh` in `docker-images/express-image/src/`

### 1.3 Reverse proxy

To have access at our site, you need to map your machine IP to our size address [demo.res.ch](demo.res.ch). In the file `hosts` (Linux : `/etc/hosts`), you need to add `YOUR_IP    demo.res.ch`. If you want to test if the IP is correctly mapped, you can ping our site address, if it's correct, you receive a response.

We use a apache container (php:7.2-apache) for this proxy. 

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

#### Results
You should be able to see the author of this lab and a countdown to its deadline.


### 2.2 Launching the dynamic server
* Go into the `docker-images/express-image/src` directory 
* Run the script `install-npm-dependance.sh`
* Go back to `docker-images/express-image`
* Run the script `build-image.sh` 
* Run the script `run-container.sh`
* Access the server on your docker local address, i.e. http://192.168.99.101:9090/ 

#### Results
You should see the JSON array of random numbers as such : `[38,11,12,50,35]`

### 2.3 Reverse proxy with apache

The IP of the 2 container (static server and the dynamic server) are hardcoded. In our case the apache static is on 172.17.0.2:80 and the express dynamic is on 172.18.0.3:3000

### 2.4 AJAX requests with JQuery

Every 30 seconds our website show a array of random numbers, with data comming from dynamic server.
It's only work with the reverse proxy because the dynamc server and the static had a different IP and the reverse proxy is here to redirect differents resquests to the correct server.

### 2.5 Dynamic reverse proxy configuration

To build the final step, make sure that all previous container are kill and remove to avoid name conflict (You can use `remove_container.sh` in `docker-images/`).
Run `build_project.sh` to build our 3 containers, and run `run_project.sh` to start the containers. The IPs needed for reverse proxy is added dynmamicly as environement variables.

## Bonus

### Load Balancing

The load Balancing is implemented in the branch `fb_laod_balancer`, this branche isn't merge into `master`. The script to launche the projet with load balancer is in `run_project_load_lanacer.sh`

We have 3 contaieners for the static servers and 3 containers for the dynamic servers, the dynamic cluster implements the sticky session.


We use a template (`config-template-load-balancer.php`) to write the reverse proxy server configuration.

Each server type (static and dynamic) possesses their cluster in the reverse proxy containter.

* `balancer://dynamic-balancer` : Indicate the adresses use for the dynamic server, this balancer impelments sticky session. We need to indicate a name for the route, this name is used to set the route id in the cookie.
* `balncer://static-balancer` : Indicate the adresses use for the static server

Theses balancers are balanced with a round robin alogorithm (named `byrequests` in apache).

The client need to communicate us the session id. When the dynamic server send a response ot the client, the reverse proxy add the cookie with the session id in the resquest header.

To validate our balancer, we enable the blancer manager, this interface allow us the see the traffic beetween our servers.


### Management UI

For the mangement we use Portainer, as explain in their tutorial, we run these commandes,(**Caution** ! they are for linux host, for other OS, see [https://www.portainer.io/installation/]())

```
$ docker volume create portainer_data
$ docker run -d -p 9000:9000 --name=portainer --restart=always -v /var/run/docker.sock:/var/run/docker.sock -v portainer_data:/data portainer/portainer
```

These steps are resume in the script `managerUI.sh`

To acces our management UI, we open our browser and go to [localhost:9000](). The first time we open the manager, we need to create a account and select the local management.

![](images/portainer.png)
