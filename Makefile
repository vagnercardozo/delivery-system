.PHONY: up down restart stop dev

LARAVEL_PORT=8000

up:
	-@pkill -f "php artisan serve" || true
	-@pkill -f "npm run dev" || true
	-@pkill -f "queue:work" || true

	docker compose up -d mysql redis

	php artisan optimize:clear

	npm run dev &
	php artisan serve --port=$(LARAVEL_PORT) &
	php artisan queue:work --queue=default,orders-reconciliation


down:
	docker compose down

stop:
	-@pkill -f "php artisan serve" || true
	-@pkill -f "npm run dev" || true

restart:
	make stop
	make up
