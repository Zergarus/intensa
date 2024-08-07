<?php

ini_set('display_errors', 1);

session_start();
require 'vendor/autoload.php';
\Core\Route::start(); // запускаем маршрутизатор
