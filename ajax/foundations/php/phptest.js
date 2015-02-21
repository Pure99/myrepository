// переменная для хранения ссылки на объект XMLHttpRequest
var xmlHttp = createXmlHttpRequestObject();
// создает экземпляр объекта XMLHttpRequest
function createXmlHttpRequestObject()
{
// переменная для хранения ссылки на объект XMLHttpRequest
var xmlHttp;
// эта часть кода должна работать во всех броузерах, за исключением
// IE6 и более старых его версий
try
{
// попытаться создать объект XMLHttpRequest
xmlHttp = new XMLHttpRequest();
}
catch(e)
{
// предполагается, что в качестве броузера используется
// IE6 или более старая его версия
var XmlHttpVersions = new Array("MSXML2.XMLHTTP.6.0",
"MSXML2.XMLHTTP.5.0",
"MSXML2.XMLHTTP.4.0",
"MSXML2.XMLHTTP.3.0",
"MSXML2.XMLHTTP",
"Microsoft.XMLHTTP");
// попробовать все возможные prog id,
// пока какаялибо попытка не увенчается успехом
for (var i=0; i<XmlHttpVersions.length && !xmlHttp; i++)
{
try
{
// попытаться создать объект XMLHttpRequest
xmlHttp = new ActiveXObject(XmlHttpVersions[i]);
}
catch (e) {}
}
}
// вернуть созданный объект или вывести сообщение об ошибке
if (!xmlHttp)
alert("Ошибка создания объекта XMLHttpRequest.");
else
return xmlHttp;
}
// вызывается для чтения файла с сервера
function process()
{
// продолжать только если в xmlHttp не пустая ссылка
if (xmlHttp)
{
// попытаться установить соединение с сервером
try
{
// инициировать чтение файла с сервера
xmlHttp.open("GET", "phptest.php", true);
xmlHttp.onreadystatechange = handleRequestStateChange;
xmlHttp.send(null);
}
// вывести сообщение об ошибке в случае неудачи
catch (e)
{
alert("Невозможно соединиться с сервером:\n" + e.toString());
}
}
}
// эта функция вызывается при изменении состояния запроса HTTP
function handleRequestStateChange()
{
// когда readyState = 4, мы можем прочитать ответ сервера
if (xmlHttp.readyState == 4)
{
// продолжать, только если статус HTTP равен «OK»
if (xmlHttp.status == 200)
{
try
{
// обработать ответ, полученный от сервера
handleServerResponse();
}
catch(e)
{
// вывести сообщение об ошибке
alert("Ошибка чтения ответа: " + e.toString());
}
}
else
{
// вывести сообщение о состоянии
alert("Возникли проблемы во время получения данных:\n" +
xmlHttp.statusText);
}
}
}
// обрабатывает ответ, полученный от сервера
function handleServerResponse()
{
// прочитать сообщение, полученное от сервера
var xmlResponse = xmlHttp.responseXML;
// предотвратить потенциально возможные ошибки в IE и Opera
if (!xmlResponse || !xmlResponse.documentElement)
throw("Неверная структура XML:\n" + xmlHttp.responseText);
// предотвратить потенциально возможные ошибки в Firefox
var rootNodeName = xmlResponse.documentElement.nodeName;
if (rootNodeName == "parsererror") throw("Invalid XML structure");
// получить ссылку на корневой элемент документа XML
xmlRoot = xmlResponse.documentElement;
// получить ссылки на массивы с названиями книг и их ISBN
titleArray = xmlRoot.getElementsByTagName("title");
isbnArray = xmlRoot.getElementsByTagName("isbn");
// сгенерировать HTML код
var html = "";
// обойти в цикле массивы и создать структуру HTML
for (var i=0; i<titleArray.length; i++)
html += titleArray.item(i).firstChild.data +
", " + isbnArray.item(i).firstChild.data + "<br/>";
// получить ссылку на элемент <div>
myDiv = document.getElementById("myDivElement");
// вывести полученный код HTML
myDiv.innerHTML = html;
}
