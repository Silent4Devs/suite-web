.PHONY: composer-install copy-env generate-key migrate chmod-storage optimize-clear storage-link migrate-fresh migrate-fresh-seed obtener-permisos

composer-install:
	docker compose exec php composer install --ignore-platform-reqs

copy-env:
	docker compose exec php cp .env.example .env

generate-key:
	docker compose exec php php artisan key:generate

storage-link:
	docker compose exec php php artisan storage:link

migrate:
	docker compose exec php php artisan migrate

migrate-fresh:
	docker compose exec php php artisan migrate:fresh

migrate-fresh-seed:
	docker compose exec php php artisan migrate:fresh --seed

obtener-permisos:
	docker compose exec php chown -R www-data: /var/www/html

chmod-storage:
	docker compose exec php chmod 777 -R storage

optimize-clear:
	docker compose exec php php artisan optimize:clear

generate-preload:
    docker compose exec php php artisan preload:placeholder

setup: composer-install copy-env generate-key generate-preload migrate chmod-storage optimize-clear

restart-containers:
    docker compose restart

