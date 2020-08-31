API Development Assignment

The App hasbeen developed with Laravel 7.x and hence requires Laravel dependencies to be tested. 

The local database file is in the root directory of the project when cloned and unziped on the test system



INSTALLATION STEPS

Clone or Download the API assignment from : https://github.com/nugwuegbu/apidevassignment.git

Unzip to a computer that satifies PHP Laravel requirements and has MYSQL database installed.

import the local database file included in root directory as localdb.sql

install Apache if you prefer to use VirtualHost to test the API or use php artisan to run the App


the API endpoints are as follows:

GET http://localhost:8080/api/external-books/$id where $id = 1,2,.,.,.,.,.,n

POST http://localhost:8080/api/v1/books

GET http://localhost:8080/api/v1/books

PATCH http://localhost:8080/api/v1/books/$id

DELETE http://localhost:8080/api/v1/books/$id

GET http://localhost:8080/api/v1/books/$id


The API implementation can be found in app/Http/Controllers/BookController.php


 
