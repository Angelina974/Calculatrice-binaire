SHELL := /bin/bash

# Variables
PORT	   = 8000
PHPUNIT    = ./vendor/bin/phpunit --colors=always
PHPSTAN    = ./vendor/bin/phpstan analyze src tests --level=max
PHPMD      = ./vendor/bin/phpmd src text cleancode,codesize,controversial,design,naming,unusedcode
PHPCPD     = ./vendor/bin/phpcpd src
DOCKER_IMG = calcul-binaire
CONTAINER_NAME = calcul-binaire-container
 
.PHONY: all install build docker test stan md pcpd

# Installe les dépendances 
all: install test stan md pcpd docker

build:
	docker build -t $(DOCKER_IMG) .

run:
	docker run -d --name $(CONTAINER_NAME) -p $(PORT):8000 $(DOCKER_IMG)

stop:
	docker stop $(CONTAINER_NAME)

install:
	composer require --dev phpstan/phpstan phpmd/phpmd sebastian/phpcpd


test:
	$(PHPUNIT)

# Lance PHPStan
stan:
	$(PHPSTAN)

# Lance PHPMD

md:
	$(PHPMD)

# Lance PHPCPD

pcpd:
	$(PHPCPD)