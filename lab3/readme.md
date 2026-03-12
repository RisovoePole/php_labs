# Лабораторная работа №3. Управляющие конструкции

## Выполнил - Анисимов Виктор IA2403

### Задание 1. Создать таблицу по заданным условиям

Необзодимо создать таблицу, которая будет отображать график работы на сегодня для *John Styles* и *Jane Doe*.

График работы каждого из них зависит от текущего дня недели:

- John Styles
Работает по дням недели **Пн, Ср, Пт** с *8 часов утра до 12 часов утра*

- Jane Doe
Работает по дням недели **Вт, Чт, Сб** с *12 часов утра до 16 часов дня*

Реализация через отдельные переменные под начало и конец времени:
`$nameWorkScheduleStart` и `$nameWorkScheduleEnd` соответственно.

Определения текущего дня недели выполненно через функцию `date("l")`, которая возвращает строку с названием текущего дня недели.

#### Реализация страницы

``` php
<?php 
    <?php 
    $currentDayOfWeek = date("l");#"Friday"  |  "Monday"

    $weekends = "Нерабочий день";


    $johnWorkScheduleStart = new DateTime('8:00:00');
    $johnWorkScheduleEnd = new DateTime('12:00:00');
    $johnWorkSchedule = 
        $johnWorkScheduleStart->format('H:i:s') .
        " - " .
        $johnWorkScheduleEnd->format('H:i:s');

    $janeWorkScheduleStart = new DateTime('12:00:00');
    $janeWorkScheduleEnd = new DateTime('16:00:00');
    $janeWorkSchedule = 
            $janeWorkScheduleStart->format('H:i:s') .
            " - " .
            $janeWorkScheduleEnd->format('H:i:s');
            
?>







<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <style>
    body {
      margin: 0;
      height: 100vh;
      display: flex;
      justify-content: center;   /* по горизонтали */
      align-items: center;       /* по вертикали */
      background: #878484ff;
      font-family: system-ui, sans-serif;
    }

    table {
      border-collapse: collapse;
      min-width: 260px;
      background: #ffffff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
    }

    th, td {
      padding: 10px 16px;
      border-bottom: 1px solid #eeeeee;
      text-align: left;
      font-size: 14px;
      color: #333333;
    }

    th {
      font-weight: 600;
      background: #fafafa;
    }

    tr:last-child td {
      border-bottom: none;
    }
  </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab3</title>
</head>
<body>
    <table>
        <tr>
            <th>
                №
            </th>
            <th>
                Фамилия Имя
            </th>
            <th>
                График работы
            </th>
        </tr>
        
        <tr>
            <td>
                1
            </td>
            <td>
                John Styles
            </td>
            <td>
                <?= match( $currentDayOfWeek ) {
                    "Monday", "Wednesday", "Friday" => $johnWorkSchedule,
                    default => $weekends
                };
                ?>
            </td>
        </tr>

        <tr>
            <td>
                2
            </td>
            <td>
                Jane Doe
            </td>
            <td>
                <?= match( $currentDayOfWeek ) {
                    "Tuesday", "Thursday", "Saturday" => $janeWorkSchedule,
                    default => $weekends
                }; 
                ?>
            </td>
        </tr>
    </table> 

</body>
</html>
```

### Задание 2. Циклы for, while и do-while

Необходимо создать файл `index.php` со следующим кодом:

``` php
<?php

$a = 0;
$b = 0;

for ($i = 0; $i <= 5; $i++) {
   $a += 10;
   $b += 5;
}

echo "End of the loop: a = $a, b = $b";
```

Задание состоит в том, что бы

1. Добавьте вывод промежуточных значений $a и $b на каждом шаге цикла.
2. Перепишите этот цикл, используя оператор while и do-while.

#### Реализация циклов

``` php
<?php

$a = 0;
$b = 0;

echo "loop FOR:\n";

for ($i = 0; $i <= 5; $i++) {
   $a += 10;
   $b += 5;

   echo "Now, a = $a, b = $b\n";
}

echo "\nEnd of the loop: a = $a, b = $b\n\n";

echo "loop WHILE:\n";

# обнуляем переменные
$a = 0;
$b = 0;
$i = 0;

while ($i<=5) {
    $a += 10;
    $b += 5;

    echo "Now, a = $a, b = $b\n";

    $i++;
}

echo "\nEnd of the loop: a = $a, b = $b\n\n";

echo "loop DO - WHILE:\n";
# обнуляем переменные
$a = 0;
$b = 0;
$i = 0;

do  {
    $a += 10;
    $b += 5;

    echo "Now, a = $a, b = $b\n";

    $i++;
} while ($i<=5);

echo "\nEnd of the loop: a = $a, b = $b\n\n";
```

### Ответы на контрольные вопросы

1. В чем разница между циклами for, while и do-while? В каких случаях лучше использовать каждый из них?
  
   - Цикл `for` использует счётчик, из-за чего с ним удобно работать, когда нам нужно номер текущей итерации.\ **Последовательность работы:** иницализирование счётчика при вхождении. Далее проверка условия: если истино, тогда выполняем тело цикла, иначе завершаем цикл. Последнее - изменение значения счётчика.
   - Цикл `while` обычо испльзуется для случаев, когда выход из цикла обусловлен только условием. Отличается от `for` отсутствием переменной - прийдётся создать отедльную переменную счётчик. \
   **Последовательность работы:** Проверка условия: истина - выполняем тело, иначе - выход из цикла.
   - Цикл `do-while` ничем не отличается от `while`, кроме того, что вхождение в цикл проиходит без проверки условия, и только в конце первой итерации проверяется условие: если истино - повторение тела цикла. Обычно используется для таких случаев, где в цикле не только происходят какие-то преобразования, но и инициализация начальных значений этими же инструкциями или функциями

    Важно понимать, что условие в цикле может застаить выполнятся цикл бесконечно. Бывают исключения, когда это делают намерено. \
    Например, когда необходимо, что бы программа работала до внешнего прерывания(отключение, остановка программы). В таком случае бесконечный цикл внутри программы, это лучший кандидат.

2. Как работает тернарный оператор ? : в PHP?

   `условие ? истина : ложь`. Это краткая запись `if (условие) {значение при истине} else {значение при ложном условии}` \
    Используется, когда лишние блоки кода или лишняя вложенность ухудшает читаймость кода и его красоту.

3. Что произойдет, если в do-while поставить условие, которое изначально ложно?

    Выполнится программа внутри блока do {} while один раз, и т.к. условие ложно произойдёт выход из цикла.
