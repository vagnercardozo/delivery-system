.PHONY: up down restart stop dev

LARAVEL_PORT=8000

up:
	-@pkill -f "php artisan serve" || true
	-@pkill -f "npm run dev" || true

	docker compose up -d mysql

	php artisan optimize:clear

	npm run dev &
	php artisan serve --port=$(LARAVEL_PORT)

down:
	docker compose down

stop:
	-@pkill -f "php artisan serve" || true
	-@pkill -f "npm run dev" || true

restart:
	make stop
	make up
