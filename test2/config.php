﻿<?php
$db_host = 'localhost'; //имя MySQL-сервера
$db_user = 'root'; // имя пользователя
$db_pass = ''; // пароль
$db_name = 'test2'; // имя БАЗЫ
// устанавливаем соединение с БД

$link = mysql_connect($db_host, $db_user, $db_pass);
if (!$link) {
    die('Ошибка соединения: ' . mysql_error());
}

$sql = 'CREATE DATABASE test2';
if (mysql_query($sql, $link)) {
    echo "База test2 успешно создана\n";
} 
$connection = new mysqli($db_host, $db_user, $db_pass, $db_name);
$connection->set_charset("utf8");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

?>
