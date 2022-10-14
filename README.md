<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Laravel api

Краткое описание - спроектирован api сервис, база данных, модели данных, эндпоинты покрыты тестами, доступна автодокументация.<br>
В сервисе реализована jwt аутентификация, новый пользователь может зарегистрироваться (при успешной регистрации пользователь уведомляется по email), существующий выполнить вход, изменить свои данные. 
Авторизованный пользователь может создавать сущности (посты), выполнять crud над этими сущностями. Сущность пост, связана с другими сущностями в проекте.
В сервисе реализована гибкая фильтрация, сортировка по атрибутам сущности (и по связям). Основные get запросы кешируются. <br>
Технологии: сборка - docker (sail), фреймворк - Laravel 9,
документация - Scribe/Laravel API Documentation, фильтрация - SpatieQueryBuilder, тесты - PHPUnit, кеширование: Redis, очереди - DB.

## Разворот

1. `git clone git@github.com:ilyazenQ/do-app.git`<br>
2. `composer require laravel/sail --dev`<br>
3. `php artisan sail:install`<br>
4. `./vendor/bin/sail up`<br>
5. `cp .env.example .env` В .env.example указаны верные данные для cтандартного sail контейнера<br>
6. `./vendor/bin/sail shell`<br>
7. `php artisan key:generate`<br>
8. `php artisan storage:link`<br>
9. `php artisan jwt:secret`<br>
10. `php artisan lrd:generate`<br>
11. `php artisan scribe:generate`<br>
12. `php artisan migrate`<br>

## *Документация и тесты

LRD: доступен по url: http://0.0.0.0/request-docs/. <br>
Scribe:  доступен по url: http://0.0.0.0/docs. <br>
(Вывод по автодокументации - подходит для простых эндпоинтов, эндпоинты с кастомными validate Rules, сложными полями, авторизацией не корректно документируются. Можно использовать как скелет для swagger, так как сгенерированная документация доступна в формате open api)<br>
Тесты: запуск тестов: <br> `/vendor/bin/sail shell` <br> `php artisan test`
