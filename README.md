# Temper Tech Assessment Laravel PHP

This is a simple Laravel application to view the onboarding progress in a chart

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

You need to have the following for this application to run

* [Composer](https://getcomposer.org/)
* [Laravel](https://laravel.com/)
* [PHP >= 7](https://www.apachefriends.org/download.html)


### Installing

* Clone or download this repo to your local machine
* Create a .env file using the content in .env.example
* Configure your database connection in the .env file
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE={YOUR DATABSE NAME}
DB_USERNAME={YOUR DATABSE USERNAME}
DB_PASSWORD={YOUR DATABASE PASSWORD}
```
* In your CLI navigate to the root of the project folder
* Install the solution
```
composer install
```
* Run database migrations
```
php artisan migrate
```
* Launch the solution
```
php artisan serve
```

## Updating The Chart Data

* Click on Browse to select the export.csv file
![Browse for CSV](https://github.com/masitsa/temper/blob/master/storage/1.png)
* Click on Import to upload the file and store the CSV data to your database
![Import CSV](https://github.com/masitsa/temper/blob/master/storage/2.png)
* The page will reload and the chart will populate using the information in your database
![Chart](https://github.com/masitsa/temper/blob/master/storage/3.png)

```
Each time you update the chart data it will clear the database table and import the new CSV
```