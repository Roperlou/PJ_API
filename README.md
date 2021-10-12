1. Клонировать репозиторий.
2. Перейти директорию приложения.
3. Скопировать файл .env_example в файл .env.
4. В .env указать свои значения для блока DB.
5. Запустить composer install
6. Запустить php artisan key:generate
7. Запустить php artisan migrate
8. Запустить php artisan db:seed --class=BusSeeder
9. Запустить php artisan db:seed --class=DriverSeeder
10. Запустить php artisan db:seed --class=PivotSeeder
11. Запустить php artisan serve

hostname/api/documentation
