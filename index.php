<?php
/*
  * Форма расчета стоимости и срока
  * Обработчик формы /calc.php
  * */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Расчет</title>
</head>
<body>
<form action="/calc.php" method="POST">
    <h3>Откуда (kladr - код)</h3>
    <input type="text" name="source_kladr" required>
    <h3>Куда (kladr - код)</h3>
    <input type="text" name="target_kladr" required>
    <h3>Вес</h3>
    <input type="number" name="weight" required>
    <h3>Способ</h3>
    <p>Медленная доставка</p>
    <input type="radio" name="delivery" value="slow" checked>
    <p>Быстрая доставка</p>
    <input type="radio" name="delivery" value="fast"><br><br>
    <button type="submit" name="calculate_button">Рассчитать</button>
</form>
</body>
</html>