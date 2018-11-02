# PHP quiz page

This project simple quiz system where user can fill different quizzes

## General

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

For development was used WAMP server with following server versions:
-- Apache version: 5.7.23
-- PHP Version: 7.2.10
-- phpmysqladmin version 4.8.3

Download all source files in webserver root directory. It is important to include `.htacces` config file there also. As this project uses data in Latvian language MySQL, PHP and Apache server should be configured to use UTF-8.

To create DB I have used in this project import `quiz.sql` dump file into your MySQL DB.

For this project development I have used Wamp development environment. Instructions can be found in Wamp webpage http://www.wampserver.com/en/

## Router class usage

Initialize router class:
```
require './router.php';
$app =new router();
```

Creating routes:
```
$app -> get("/", function ($req, $db,)
{
  //code goes here
});

```

## Using DB class

You need to pass mysqli object into DB to in
```
require './router.php';

$mysql = new mysqli("localhost", "<<username>>", "<<password>>", "<<<Db name>>>");

$mysql->set_charset("utf8");

$db =new db($mysql);
```
