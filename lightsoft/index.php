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
$result=$connection->query("SELECT name
FROM category AS child_cats
WHERE parent_category_id=0 AND child_cats.name LIKE 'Авто%'");
while ($row = $result->fetch_array()) { 
//extract ($row);

echo $row['name']; }
?>

</body>
<script> 
$('table .c').css('color','green');
$("table").addClass("a");
var elem = document.getElementById('t');
elem.className = "a";//добавляем новый класс к элементу
</script>
</html>
