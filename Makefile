DC=docker-compose
PHP=$(DC) exec php
CONS=$(PHP) bin/console

## —— Docker 🐳  ———————————————————————————————————————————————————————————————
up: ## docker-compose up -d
	$(DC) up -d

down: ## docker-compose down
	$(DC) down -v --remove-orphans

php:
	$(PHP) sh

## —— Database 📑 ———————————————————————————————————————————————————————————————
install: ## Runs doctrine migrations
	$(DC) up -d
	$(PHP) composer install
	$(CONS) d:m:m -n
