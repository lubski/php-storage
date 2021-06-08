# php-storage v0.1
This is a first version of simple storage files based on PHP Hypertext Preprocessor programing language.
Project is a simple files storage and can be used as microservice in other project to hold seperated files with own structure.

## Table of Contents
* [Technologies Used](#technologies-used)
* [Project Status](#project-status)
* [Features](#features)
* [Improvement](#improvement)
* [Installation](#installation)
* [Usage](#usage)
* [Contact](#contact)

## Technologies Used

Technologies:
* [PHP 7.4](https://www.php.net/)
* [Symfony 5](https://symfony.com/)
* [PostgreSQL 13](https://www.postgresql.org/)
* [Doctrine ORM](https://www.doctrine-project.org/projects/orm.html)
* [Docker](https://www.docker.com/)
* [Docker Compose](https://docs.docker.com/compose/)
* [Message broker](https://en.wikipedia.org/wiki/Message_broker)

Patterns:
* [CQRS Pattern](https://martinfowler.com/bliki/CQRS.html)
* [Event Subscriber](https://symfony.com/doc/current/event_dispatcher.html#creating-an-event-subscriber)

## Project Status
Project is: _in progress_ 

## Features
Already done:
- Upload image by HTTP.
- Display image
- Download image
- Remove image

## Improvement
- User Authorization by [JWT](https://jwt.io/) token
- Validating uploaded files by MIME type

## Installation

Clone repository
```bash
git clone https://github.com/lubski/php-storage.git [folder-to-install]
```````
Set default uri in ```config/packages/routing.yaml```
```yaml
framework:
    router:
        utf8: true

        # Configure how to generate URLs in non-HTTP contexts, such as CLI commands.
        # See https://symfony.com/doc/current/routing.html#generating-urls-in-commands
        default_uri: https://localhost/

```
Install [Symfony CLI](https://symfony.com/download) and add path to CLI to ```$PATH```
Install [Docker](https://www.docker.com/) and [Docker Compose](https://docs.docker.com/compose/)
Install certificates
```bash
$ symfony server:ca:install
```
Install composer dependencies
```bash
$ composer require symfony/orm-pack \
  doctrine/doctrine-bundle \
  doctrine/doctrine-migrations-bundle "^3.0" ; composer install
```
Start Postgres 13 docker container
```bash
docker-compose up -d
```
Make database migrations
```bash
$ symfony console doctrine:migrations:migrate
```
Start server in the background
```bash
$ symfony server:start -d
```
Open site in browser
```bash
$ symfony open:local
```
If something was wrong check logs
```bash
$ symfony server:log
```
## Usage
* Upload for example image (Send POST via CURL or REST Client tool like [Postman](https://www.postman.com/))
```HTTP POST``` ```form-data``` one file with key ```file``` or multiple files in array ```file[]``` 
```
https://localhost:8000/upload
```
You will recursive respone with ```json``` and all liks to display picture, download and delete.
Delete must be ```DELETE``` HTTP Request method.

Example response:
```json
{
    "success": true,
    "files": [
        {
            "links": {
                "read": "https://localhost:8000/read/869444d23a42bb5c651136293ebf4e5f-60bf7fa32b6f5.jpg",
                "download": "https://localhost:8000/download/869444d23a42bb5c651136293ebf4e5f-60bf7fa32b6f5.jpg",
                "delete": "https://localhost:8000/delete/869444d23a42bb5c651136293ebf4e5f-60bf7fa32b6f5.jpg"
            }
        },
        {
            "links": {
                "read": "https://localhost:8000/read/9870d92bd31374f81e96378e8e7d643b-60bf7fa32f37f.jpg",
                "download": "https://localhost:8000/download/9870d92bd31374f81e96378e8e7d643b-60bf7fa32f37f.jpg",
                "delete": "https://localhost:8000/delete/9870d92bd31374f81e96378e8e7d643b-60bf7fa32f37f.jpg"
            }
        }
    ]
}
```

## Contact
Created by [Tomasz Lublin](mailto:lubski@gmail.com) - feel free to contact me!