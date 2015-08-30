<?php
//include("connect.php");
$db_host = 'localhost'; //имя MySQL-сервера
$db_user = 'root'; // имя пользователя
$db_pass = ''; // пароль
$db_name = 'base'; // имя БАЗЫ
// устанавливаем соединение с БД

$connection = new mysqli($db_host, $db_user, $db_pass, $db_name);
$connection->set_charset("utf8");
if($_GET['id'] and $_GET['data'])
{
	$id = $_GET['id'];
	$data = $_GET['data'];
	if($connection->query("update information set name='$data' where id='$id'"))
	echo 'success';
}
?>
