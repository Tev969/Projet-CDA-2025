reset-db:
	rm -rf migrations/*
	symfony console doctrine:database:drop --force
	symfony console doctrine:database:create
	symfony console make:migration
	symfony console doctrine:migrations:migrate -n
	symfony console doctrine:fixtures:load -n



