# Peak Application Boilerplate

> **Note:** This repository contains an application skeleton for Peak framework. If you want only the framework core, visit the main [framework repository](https://github.com/peakphp/framework).

### Install via composer

```
$ composer create-project peak/peak --prefer-dist
```

### Install manually 

Download https://github.com/peakphp/peak/archive/master.zip

### Quick start with Docker

This project comes with a Docker configurations to help you start fast. What's included :

- PHP 7.3
- Nginx latest
- MYSQL 8
- Redis latest
- And a bunch of tools like composer and database migration

##### How to use it ?

- Copy ``.env.dist`` to ``.env``
- Install vendor with ``$ docker-compose run composer-install``
- Start the web server with ``$ docker-compose up -d web``
- Visit ``http://localhost:8080`` and voilà!
- Others docker commands:
    - ``$ docker-compose run migration`` for database migration
    - ``$ docker-compose run shell`` for entering in the container with shell bash
    - ``$ docker-compose run climber`` for using the CLI console application
    - ``$ docker-compose up adminer`` for running database web manager Adminer

Don't want to use docker? Just remove:
 - `Dockerfile`
 - `DockerfileShell`
 - `docker-compose.yml`
 - `/docker` folder