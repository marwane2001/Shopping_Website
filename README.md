# Shopping Site Documentation

## Site Objective

This shopping site allows users to browse and purchase products online. It offers features such as cart management, order processing, and user authentication.

## Technologies Used

- **Symfony**: PHP framework for web development.
- **Twig**: Template engine for PHP.
- **Bootstrap**: Css framework for a fast deisgn.
- **Doctrine**: ORM for database management.

# Installation and configuration :

## Pre-requirements :

- PHP 8.0 or superior (im currently working with php 8.2 bundled with xampp)
- Composer

## Installation

clone the depo :
```bash
git clone https://github.com/marwane2001/Shopping_Website.git
cd Shopping_Website
composer install
(configure the .env file according to your database)
php bin/console doctrine:database:create or symfony console d:d:c
php bin/console doctrine:migrations:migrate or symfony console d:m:m
symfony server:start
```
<br>
Link: https://shopping-webapp.reactive-chat.tech
<br>

   
<br>
Project Developer
<br>
Marwane2001
