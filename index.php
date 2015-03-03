<!DOCTYPE HTML>

<html>

<head>
    <title>Untitled</title>
    <meta charset="utf-8">

</head>

<body>

    <table id="sf" style="width: 400px;" border="1" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <select>
                    <option value="">-- Выбрать --</option>
                    <option value="">Все наименования</option>
                    <option value="зеленый">зеленый</option>
                    <option value="красный">красный</option>
                </select>
            </td>
            <td>
                <select>
                    <option value="">-- Выбрать --</option>
                    <option value="">Все наименования</option>
                    <option value="да">да</option>
                    <option value="нет">нет</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>зеленый 1</td>
            <td>да</td>
        </tr>
        <tr>
            <td>зеленый 2</td>
            <td>нет</td>
        </tr>
        <tr>
            <td>красный 1</td>
            <td>нет</td>
        </tr>
        <tr>
            <td>красный 2</td>
            <td>да</td>
        </tr>
    </table>
    <input type="button" value="reset" class="res"/>
    <p>Как можно сделать: если отфильтровать строки в одном из столбцов, как-то сохранить результат, а из оставшихся строк сделать выборку по другому столбцу </p>
    <p>например, выбираем в первом столбце ЗЕЛЕНЫЙ, во втором ДА, и в результате остается одна строка - зеленый 1 да </p>
    <table border="1" cellpadding="0" cellspacing="0" id="sf2" style="width: 400px;">
        <tr>
            <td>зеленый 1</td>
            <td>да</td>
        </tr>
    </table>
    <script>
        window.onload = function() {
            var tab = document.querySelector('#sf'),
                tr = tab.querySelectorAll('tr:nth-child(n+2)'),
                sel = tab.querySelectorAll('select'),
                arr = [],
                res = document.querySelector('.res');
            Array.prototype.forEach.call(sel, function(a, b) {
                arr[b] = a.value;
                a.onchange = function() {
                    arr[b] = a.value;
                    a.options[0].selected = !0;
                    Array.prototype.forEach.call(tr, function(a, b) {
                        var c = Array.prototype.every.call(a.querySelectorAll("td"), function(a, b) {
                            return RegExp(arr[b]).test(a.textContent)
                        });
                        a.style.display = c ? "" : "none"
                    })
                }
            });
           res.onclick =  function() {
                for (var i=0; i<sel.length; i++)  {sel[i].onchange()}               }
        }
    </script>
</body>

</html>
