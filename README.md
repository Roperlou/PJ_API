1. Клонировать репозиторий.
2. Перейти директорию приложения.
3. Скопировать файл .env_example в файл .env.
4. В .env указать свои значения для блока DB.
5. Запустить php artisan key:generate
6. Запустить php artisan migrate
7. Запустить php artisan db:seed --class=BusSeeder
8. Запустить php artisan db:seed --class=DriverSeeder
9. Запустить php artisan db:seed --class=PivotSeeder
10. Запустить php artisan serve

hostname/api/drivers/ -> получить список всех водителей

hostname/api/drivers/{id} -> получить одного водителя

hostname/api/drivers/getTravelTime/{City_1}|{City_2} -> получить список всех водителей с расчитаным временем путешествия от City_1 до City_2

hostname/api/drivers/{id}/getTravelTime/{City_1}|{City_2} -> получить одного водителя с расчитаным временем путешествия от City_1 до City_2
