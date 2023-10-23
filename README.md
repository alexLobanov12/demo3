# Демо проект

## Установка
1) Клонировать репозиторий git clone https://github.com/alexLobanov12/demo3.git
2) Перейти в корневую директорию проекта 
3) В корне проекта открыть консоль запустить команду composer i
4) Переместить файлы data_attempts.json и data_cars.json из корня проекта в \storage\app
5) Переименовать файл .env.example в .env в корне проекта
6) В консали ввести команду php artisan key:generate
7) Запустить встроенный сервер php artisan serve
8) Перейти на главную страницу {your_local_domain}/

Для корректной работы в директории \storage\app должны находиться файлы data_attempts.json и data_cars.json, с корректной структурой данных
