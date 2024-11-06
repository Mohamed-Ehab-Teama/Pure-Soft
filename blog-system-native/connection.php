<?php

session_start();

$DBName = 'blog-system-native';
$serverName = 'localhost';
$DBUserName = 'root';
$DBPassword = '';

$connection = mysqli_connect($serverName, $DBUserName, $DBPassword, $DBName);