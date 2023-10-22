# Демо проект

## Установка
1) Клонировать репозиторий git clone https://github.com/alexLobanov12/demo3
2) Перейти в корневую директорию проекта 
3) В корне проекта открыть консоль запустить команду composer i
4) Сгенерировать символическую ссылку php artisan storage:link
5) Переместить файлы data_attempts.json и data_cars.json из корня проекта в \storage\app
6) Запустить встроенный сервер php artisan serve
7) Перейти на главную страницу {your_local_domain}/

Для корректной работы в директории \storage\app должны находиться файлы data_attempts.json и data_cars.json, с корректной структурой данных