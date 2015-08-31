<!DOCTYPE HTML>
<html>
<head>
    <title>Lightsoft</title>
    <meta charset="utf-8">
<link href="../lightsoft/test.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body>
<table id=t >
    <tr>
        <td class=c>Текст</td>
    </tr>

</table>
<?php
$db_host = 'localhost'; //имя MySQL-сервера
$db_user = 'root'; // имя пользователя
$db_pass = ''; // пароль
$db_name = 'lightsoft'; // имя БАЗЫ
// устанавливаем соединение с БД
global $connection;
$connection = new mysqli($db_host, $db_user, $db_pass, $db_name);
$connection->set_charset("utf8");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();}
$connection->query("CREATE TABLE category (
    id integer not null primary key,
    parent_category_id integer references category(id),
    name varchar(100) not null
)"); 
$connection->query("CREATE TABLE category1 (
    id integer not null primary key,
    parent_category_id integer references category(id),
    name varchar(100) not null
)"); 
$connection->query("INSERT INTO category1 (id, parent_category_id, name) VALUES
(1, 0, 'Раздел 1'),
(2, 0, 'Раздел 2'),
(3, 0, 'Раздел 3'),
(4, 0, 'Раздел 4'),
(5, 1, 'Подраздел 1.1'),
(6, 1, 'Подраздел 1.2'),
(7, 1, 'Подраздел 1.3'),
(8, 2, 'Подраздел 2.1'),
(9, 2, 'Подраздел 2.2'),
(10, 5, 'Подраздел 1.1.1'),
(11, 5, 'Подраздел 1.1.2'),
(12, 11, 'Подраздел 1.1.2.1'),
(13, 3, 'Подраздел 3.1'),
(14, 4, 'Подраздел 4.1'),
(15, 4, 'Подраздел 4.2');");
$connection->query("INSERT INTO category (id, parent_category_id, name) VALUES
(1, 0, 'автомобили марка'),
(2, 1, 'автомобиль год выпуска'),
(3, 2, 'автомобиль модель'),
(4, 3, 'автосервис СТО заказчики'),
(5, 0, 'автозапчасти производители'),
(6, 3, 'запчасти двигателя'),
(7, 3, 'запчасти кузова'),
(8, 3, 'запчасти коробка передач'),
(9, 3, 'запчасти подвеска рычаги'),
(10, 6, 'номер детали двигателя'),
(11, 7, 'номер детали кузова'),
(12, 8, 'номер детали коробка передач'),
(13, 9, 'номер детали подвеска рычаги'),
(14, 11, 'кросс номер детали кузова');");

 $hostName = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "lightsoft";
  mysql_set_charset ("utf8");
  if (!($link=mysql_connect($hostName,$userName,$password))) {
 printf("Ошибка при соединении с MySQL !\n");
 exit();
 }
  if (!mysql_select_db($databaseName, $link)) {
 printf("Ошибка базы данных !");
 exit();
 } 

function ShowTree($ParentID, $lvl) {
	
	global $link;
	global $lvl;
	
	$lvl++;		
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8';");
	$sSQL = "SELECT id, name, parent_category_id FROM category WHERE parent_category_id = " . $ParentID . " ORDER BY name";
	
	$result = mysql_query($sSQL, $link);
	
	if (mysql_num_rows($result) > 0) {
		echo("<UL>\n");
	while ( $row = mysql_fetch_array($result) ) {
		$ID1 = $row["id"];
		echo("<LI>\n");
		echo("<A HREF=\"" . "?ID=" . $ID1 . "\">" . $row["name"] . "</A>" . "&nbsp;&nbsp;\n");
		ShowTree($ID1, $lvl); 
		$lvl--;
	}
		echo("</UL>\n");
	}
	
	}

ShowTree(0, 0);

mysql_close($link);
$result=$connection->query("SELECT name
FROM category AS child_cats
WHERE parent_category_id=0 AND child_cats.name LIKE 'Авто%'");
while ($row = $result->fetch_array()) { 
//extract ($row);

echo $row['name']; }
$result=$connection->query("SELECT * FROM category WHERE id not IN ( SELECT parent_category_id FROM category WHERE id IN ( SELECT parent_category_id FROM category WHERE id IN ( SELECT parent_category_id FROM category ) ))");
while ($row = $result->fetch_array()) { 
//extract ($row);

echo $row['name']; }
$result=$connection->query("SELECT * FROM category WHERE id NOT IN ( SELECT parent_category_id FROM category)");
while ($row = $result->fetch_array()) { 
//extract ($row);

echo $row['name']; }

?>
Скрипт проверки — является ли строка текста полиндромом…<br>
введите текст, например: Аргентина манит негра

<br><br>
<form action ='' method='get'>
Текст: <input type='text' value='' name='text'/><br>
<input type='submit'/>
</form>
</body>

</html>
<?php

error_reporting(-1);
mb_internal_encoding('utf-8');

// $text = $_POST[«text»];

$text = @$_GET['text'];

$resultTrue = "Результат — палиндром\n";
$resultFalse = "Результат — не палиндром\n";

$text = mb_strtolower($text);
$text1 = str_replace(' ','',$text);

function strrev_enc($text2)
{
$text2 = iconv('utf-8', 'windows-1251', $text2);
$text2 = strrev($text2);
$text2 = iconv('windows-1251', 'utf-8', $text2);
return $text2;
}

$text2 = strrev_enc($text1);

echo "Строка — {$text1}, инвертированная строка — {$text2}.\n";

if ($text1 == $text2) {
echo $resultTrue;
} else {
echo $resultFalse;
}?>
</body>
<script> 
$('table .c').css('color','green');
$("table").addClass("a");
var elem = document.getElementById('t');
elem.className = "a";//добавляем новый класс к элементу
</script>
</html>
