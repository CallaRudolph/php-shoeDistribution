# _Shoe Store Distribution_

#### _PHP Database Extended Independent Project for Epicodus, 7.21.2017_

#### By _**Calla Rudolph (<mailto:callarudolph@gmail.com>)**_

## Description

_This PHP database project allows a shoe distribution company owner to create, add, update, and delete individual stores and distributed shoe brands. Each store can carry multiple shoe brands, and each shoe can be distributed at multiple stores. This database is an example of a many-to-many relationship._

## Setup Requirements

This project requires proper computer installation of [MAMP](https://www.mamp.info/en/), [Composer](https://getcomposer.org/), and [PHP](https://secure.php.net/).

* Open GitHub site on your browser: https://github.com/CallaRudolph/php-shoeDistribution
* Select the dropdown (green box) "Clone or download"
* Copy the link for the GitHub repository
* Open Terminal on your computer
* In Terminal, perform the following steps:
  * $ cd desktop
  * $ git clone [paste repository link]
  * $ cd php-shoeDistribution
  * $ composer install (to download dependencies: Silex, Twig, PHPUnit)
* In browser, type 'localhost:8888/phpmyadmin' to access Apache and databases
  * Click 'import' tab and choose file 'shoes.sql' from project folder to import database to your computer
* In MAMP, perform the following steps:
    * Open preferences>ports and verify that Apache Port is 8888
    * Go to preferences>web server and click the file folder next to document root
  * Select the php-shoeDistribution directory
  * Select the web folder inside the directory
  * Click OK at the bottom of preferences and then click 'Start Servers'
* In your browser, enter 'localhost:8888' to access the web app
* Click on the stores or shoes link to get started!

## Specifications
_The following user stories are available in this project:_
* The user can add, update, delete, and list shoe stores.
* The user can add, update, delete, and list shoe brands with prices.
* The user can add existing shoe brands to a store to show where they are sold.
* The user can associate the same brand of shoes with multiple stores.
* The user can see all shoe brands that the store sells on the individual store page.
* All shoe brands and store names are saved with capital letters using Title Case properties.
    * Example input: 'nike and sons'
    * Example output: 'Nike and Sons'
* Shoe prices are saved with two decimal places and displayed in currency format.
    * Example input: '50'
    * Example output: '$50.00'
* The user is unable to save a blank entry for store name or shoe brand.
* A store name and shoe brand are saved with a maximum of thirty characters.

_wish list:_
* The user cannot save a duplicate store name or duplicate shoe brand.

## MySQL Commands
The following MySQL commands were entered when creating the database and during testing:

* CREATE DATABASE shoes;
* USE shoes;
* CREATE TABLE stores (id serial PRIMARY KEY, name VARCHAR (30));
* CREATE TABLE shoes (id serial PRIMARY KEY, brand VARCHAR (30), price DECIMAL (5, 2));
* CREATE TABLE shoes_stores (id serial primary key, shoe_id INT, store_id INT);
* copy shoes to shoes_test in phpMyAdmin

## Technologies Used

PHP, HTML, Bootstrap CSS, Silex, Twig, Composer, MAMP, PHPUnit, MySQL, phpMyAdmin

### License

Copyright &copy; 2017 Calla Rudolph

_Please email me at the above address with any comments or improvements you have found!_

This software is licensed under the MIT license.
