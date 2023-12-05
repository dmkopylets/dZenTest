DOCKER_COMPOSE = docker-compose
EXEC_PHP       = $(DOCKER_COMPOSE) exec php-fpm
DOCKER_COMPOSE_FILE = -f docker-compose.yml

local-compose-file:
	$(eval DOCKER_COMPOSE_FILE = -f docker-compose.yml)

dev-compose-file:
	$(eval DOCKER_COMPOSE_FILE = -f docker-compose.base.yml -f docker-compose.dev.yml )

dc-build:
	$(DOCKER_COMPOSE) $(DOCKER_COMPOSE_FILE) build postgres php-fpm www

dc-up:
	$(DOCKER_COMPOSE) $(DOCKER_COMPOSE_FILE) up -d postgres php-fpm www

dc-down:
	$(DOCKER_COMPOSE) $(DOCKER_COMPOSE_FILE) down --remove-orphans

bash:
	$(EXEC_PHP) bash

fixtures:
	$(EXEC_PHP) sh -c " php bin/console doctrine:fixtures:load --no-interaction"

test:
	$(EXEC_PHP) sh -c " APP_ENV=test php bin/phpunit"

composer-i:
	$(EXEC_PHP) sh -c " composer install"

clear-cache:
	$(EXEC_PHP) bash -c " rm -rf var"

test-init:
	$(EXEC_PHP) sh -c " php bin/console doctrine:database:drop --env=test --force --if-exists; php bin/console doctrine:database:create --env=test --ansi; php bin/console  doctrine:schema:creat --env=test;"

migrate:
	$(EXEC_PHP) sh -c " php bin/console doctrine:migrations:migrate --no-interaction"

migrate-diff:
	$(EXEC_PHP) sh -c " php bin/console doctrine:migrations:diff"

nginx-restart:
	cd docker; docker exec -it www sh -c "nginx -t && nginx -s reload"

swagger-generate:
	$(EXEC_PHP) sh -c "./vendor/bin/openapi /var/www/src -o /var/www/api/openApi/swagger.json"