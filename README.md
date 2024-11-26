# Setup Development Environment

## Prerequisites
- Install Docker 
- Install [Docker Compose](https://docs.docker.com/compose/install/) 
- Verify that Docker Compose is installed correctly by checking the version.

```bash
docker compose version
```

## Build and start all services
At the project root folder

```bash
cd docker
docker compose up -d
```

Waiting for builds to complete.

## Install CakePHP dependencies
- At the project root folder

```bash
cd cakephp
cp config/.env.example config/.env
cp config/app_local.example.php config/app_local.php
```

- Get into Docker container's shell 

```bash
docker exec -it myapp-php-fpm bash
```

- Inside container's shell, run command

```bash
composer install
```

Waiting for builds to complete. Run migrations and seeders

```bash
bin/cake migrations migrate
bin/cake migrations seed
```

Then exit the container, type `exit` then Enter

## Restart docker services
At the project root folder

```bash
cd docker
docker compose up -d
```

Then visit `http://localhost:8180/` to see the welcome page.

# API documentation

## API KEY
- In order to consume application APIs, please use `x-api-key` request header
- Check `config/.env` file for valid API_KEY

## Users API
- Endpoint: http://localhost:8180/api/v1/users

### Get list of users
- Method: GET
- Optional parameters
   + page

### Create a new user
- Method: POST
- Request data: JSON
- Required parameters
   + name
   + email
   + username
   + age