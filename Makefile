all: up

up: 
	docker-compose up -d

down:
	docker-compose down

restart: down up

rebuild:
	docker-compose up -d --build

purge:
	docker-compose down -v --rmi all

bash:
	docker exec -ti php-app bash