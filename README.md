## About Retention Apps

To develop a customer retention application that effectively enhances customer loyalty and satisfaction by implementing personalized engagement strategies, analyzing user behavior, and providing actionable insights. 

## Requirements

- PHP min 8.1
- MySQL database
- web server (apache/nginx)

## How to setup

- clone this repo `git clone https://github.com/uthadehikaru/retention`
- create database 'retention'
- copy file .env.example to .env
- edit .env file
DB_DATABASE=laravel_bootstrap
DB_USERNAME=root
DB_PASSWORD=
- open terminal and navigate to project folder
- run `composer install`
- run `php artisan key:generate`
- run `php artisan migrate --seed`
- run `php artisan serve`
- open browser and access http://127.0.0.1:8000