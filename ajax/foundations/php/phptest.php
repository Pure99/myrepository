<?php
// определить формат выходных данных как xml
header('Content-Type: text/xml');
// создать новый документ XML
$dom = new DOMDocument();
// создать корневой элемент <response>
$response = $dom->createElement('response');
$dom->appendChild($response);
// создать элемент <books> и добавить его как дочерний,
// по отношению к <response>
$books = $dom->createElement('books');
$response->appendChild($books);
// создать элемент title для элемента book
$title = $dom->createElement('title');
$titleText = $dom->createTextNode('Building Reponsive Web Applications with AJAX and PHP');
$title->appendChild($titleText);
// создать элемент isbn для элемента book
$isbn = $dom->createElement('isbn');
$isbnText = $dom->createTextNode('1-904811-82-5');
$isbn->appendChild($isbnText);
// создать элемент <book>
$book = $dom->createElement('book');
$book->appendChild($title);
$book->appendChild($isbn);
// добавить элемент <book>, как дочерний по отношению к элементу <books>
$books->appendChild($book);
// переписать структуру XML в строковую переменную
$xmlString = $dom->saveXML();
// вывести строку XML
echo $xmlString;
?>
