<?php

session_start();

$DBName = 'day01-blog-system';
$serverName = 'localhost';
$DBUserName = 'root';
$DBPassword = '';

$connection = mysqli_connect($serverName, $DBUserName, $DBPassword, $DBName);