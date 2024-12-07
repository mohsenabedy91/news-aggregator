docker-compose up -d
docker exec -it news_aggregator_app chmod -R 777 storage bootstrap/cache
docker exec -it laravel_app php artisan migrate
