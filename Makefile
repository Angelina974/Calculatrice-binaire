SHELL := /bin/bash

PHPUNIT    = ./vendor/bin/phpunit --colors=always
PHPSTAN    = ./vendor/bin/phpstan analyze src tests --level=max
PHPMD      = ./vendor/bin/phpmd src text cleancode,codesize,controversial,design,naming,unusedcode
PHPCPD     = ./vendor/bin/phpcpd src

.PHONY: all install test stan md pcpd

all: test stan md pcpd


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