
# AutoVerge - Car parking & fleet management system

This project is for a holding company,Auto Verge which handles public car parking and fleet management in
Dubai International Airport.The company would like to introduce a new service for business class
customers who would like to travel to another city or country for short stay. For those type of
customers, they would like to come by their private car, drive in and drop the key at the airport,
then they will take a flight to another city for a few days and pick up the key once they have
come back and drive back home with their private car. Customer can also get additional
services such as daily cleaning and polishing to provide a fresh and clean experience once they
come back to pick up their car.This project solves the requirements for the company.


## Features

- System administrator can manage(view, create, update, delete) the car parking bookings,users,customers and the additional services that the company provides.
- A customer is notified with the email once they have finished the booking and when they have paid the invoices and taken back their private car.



## Tech Stack

- PHP
- Laravel 
- MySQL 


## Installation

Clone the project repo or download as zip

Run this command

```bash
composer install
```
Create .env file in the project root folder and copy all the content from .env.example and then paste in the created .env.And then generate the application key with the following command.

```bash
php artisan key:generate
```

Fill with your local database instance username and password and local database name in .env file in the project root folder

```bash
DB_DATABASE="dbname"
DB_USERNAME="username"
DB_PASSWORD="password"
```

Fill with your mailtrap credentials in .env file like this

```bash
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME="your mailtrap username"
MAIL_PASSWORD="your mailtrap password"
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=admin@autoverge.com
```
    
Then, run the migration command to generate the tables and the test data

```bash
php artisan migrate --seed
```

Set queue driver to database in .env file

```bash
QUEUE_CONNECTION=database
```

Now, open command prompt and locate to the project root folder,run this command

```bash
php artisan serve
```

open another command prompt and locate to the project root folder,run this command for laravel queue

```bash
php artisan  queue:work
```

you can  send request to the following api endpoints,the admin username is "admin" and password is "admin#123".

```bash
+--------+-----------+-----------------------------+-------------------+------------------------------------------------------------+------------------------------------------+
| Domain | Method    | URI                         | Name              | Action                                                     | Middleware                               |
+--------+-----------+-----------------------------+-------------------+------------------------------------------------------------+------------------------------------------+
|        | GET|HEAD  | /                           |                   | Closure                                                    | web                                      |
|        | GET|HEAD  | api/bookings                | bookings.index    | App\Http\Controllers\Api\BookingController@index           | api                                      |
|        |           |                             |                   |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | POST      | api/bookings                | bookings.store    | App\Http\Controllers\Api\BookingController@store           | api                                      |
|        |           |                             |                   |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | DELETE    | api/bookings/{booking}      | bookings.destroy  | App\Http\Controllers\Api\BookingController@destroy         | api                                      |
|        |           |                             |                   |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | PUT|PATCH | api/bookings/{booking}      | bookings.update   | App\Http\Controllers\Api\BookingController@update          | api                                      |
|        |           |                             |                   |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD  | api/bookings/{booking}      | bookings.show     | App\Http\Controllers\Api\BookingController@show            | api                                      |
|        |           |                             |                   |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | PATCH     | api/bookings/{booking}/paid |                   | App\Http\Controllers\Api\BookingController@paid            | api                                      |
|        |           |                             |                   |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | POST      | api/customers               | customers.store   | App\Http\Controllers\Api\CustomerController@store          | api                                      |
|        |           |                             |                   |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD  | api/customers               | customers.index   | App\Http\Controllers\Api\CustomerController@index          | api                                      |
|        |           |                             |                   |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | DELETE    | api/customers/{customer}    | customers.destroy | App\Http\Controllers\Api\CustomerController@destroy        | api                                      |
|        |           |                             |                   |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | PUT|PATCH | api/customers/{customer}    | customers.update  | App\Http\Controllers\Api\CustomerController@update         | api                                      |
|        |           |                             |                   |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD  | api/customers/{customer}    | customers.show    | App\Http\Controllers\Api\CustomerController@show           | api                                      |
|        |           |                             |                   |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD  | api/services                | services.index    | App\Http\Controllers\Api\ServiceController@index           | api                                      |
|        |           |                             |                   |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        |           |                             |                   |                                                            | App\Http\Middleware\CheckIsAdmin         |
|        | POST      | api/services                | services.store    | App\Http\Controllers\Api\ServiceController@store           | api                                      |
|        |           |                             |                   |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        |           |                             |                   |                                                            | App\Http\Middleware\CheckIsAdmin         |
|        | DELETE    | api/services/{service}      | services.destroy  | App\Http\Controllers\Api\ServiceController@destroy         | api                                      |
|        |           |                             |                   |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        |           |                             |                   |                                                            | App\Http\Middleware\CheckIsAdmin         |
|        | PUT|PATCH | api/services/{service}      | services.update   | App\Http\Controllers\Api\ServiceController@update          | api                                      |
|        |           |                             |                   |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        |           |                             |                   |                                                            | App\Http\Middleware\CheckIsAdmin         |
|        | GET|HEAD  | api/services/{service}      | services.show     | App\Http\Controllers\Api\ServiceController@show            | api                                      |
|        |           |                             |                   |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        |           |                             |                   |                                                            | App\Http\Middleware\CheckIsAdmin         |
|        | POST      | api/auth/login              |                   | App\Http\Controllers\Api\Auth\LoginController@login        | api                                      |
|        | POST      | api/users                   | users.store       | App\Http\Controllers\Api\UserController@store              | api                                      |
|        |           |                             |                   |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        |           |                             |                   |                                                            | App\Http\Middleware\CheckIsAdmin         |
|        | GET|HEAD  | api/users                   | users.index       | App\Http\Controllers\Api\UserController@index              | api                                      |
|        |           |                             |                   |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        |           |                             |                   |                                                            | App\Http\Middleware\CheckIsAdmin         |
|        | DELETE    | api/users/{user}            | users.destroy     | App\Http\Controllers\Api\UserController@destroy            | api                                      |
|        |           |                             |                   |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        |           |                             |                   |                                                            | App\Http\Middleware\CheckIsAdmin         |
|        | PUT|PATCH | api/users/{user}            | users.update      | App\Http\Controllers\Api\UserController@update             | api                                      |
|        |           |                             |                   |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        |           |                             |                   |                                                            | App\Http\Middleware\CheckIsAdmin         |
|        | GET|HEAD  | api/users/{user}            | users.show        | App\Http\Controllers\Api\UserController@show               | api                                      |
|        |           |                             |                   |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        |           |                             |                   |                                                            | App\Http\Middleware\CheckIsAdmin         |
+--------+-----------+-----------------------------+-------------------+------------------------------------------------------------+------------------------------------------+
```