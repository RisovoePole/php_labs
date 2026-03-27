<?php

//Output
/**
 * Генерирует строку с заголовком таблицы на основе ключей первой транзакции.
 *
 * @param array $transaction ассоциативный массив одной транзакции (например, $transactions[0])
 * @return string HTML-строка с <tr> и <th> для каждого ключа, плюс столбец "day passed"
 */
function show_header_table(array $transaction): string
{
    $result = "<tr>\n";
    foreach (array_keys($transaction) as $key) {
        $result .= "<th>" . $key . "</th>\n";
    }

    $result .= "<th>day passed</th>";

    $result .= "</tr>\n";
    return $result;
}


/**
 * Генерирует тело таблицы для всех транзакций, добавляя столбец "дней прошло".
 *
 * @param array $transactions массив транзакций, каждая — ассоциативный массив
 * @return string HTML-строка с сериями <tr> и <td> для всех транзакций
 */
function show_body_table(array $transactions): string
{
    $result = "";

    $dayPassed = daysSinceTransaction(new DateTime());
    $idx = 0;

    foreach ($transactions as $t) {
        $t["date"] = $t["date"]->format("Y-m-d");

        $result .= "<tr>\n";

        foreach ($t as $value) {
            $result .= "\t<td>" . $value . "</td>\n";
        }

        $result .= "\t<td>" . $dayPassed[$idx++] . "</td>\n";
        $result .= "<tr>\n";
    }
    return $result;
}


/**
 * Считает общую сумму поля 'amount' по всем транзакциям.
 *
 * @param array $transactions массив транзакций, каждая — ассоциативный массив с ключом 'amount'
 * @return float общая сумма всех amount
 */
function calculateTotalAmount(array $transactions): float
{
    return array_sum(array_column($transactions, 'amount'));
}


/**
 * Находит все транзакции, в описании которых встречается заданная подстрока.
 * Использует глобальный массив $transactions.
 *
 * @param string $descriptionPart подстрока, которую ищем в поле 'description' транзакции
 * @return array массив отфильтрованных транзакций, удовлетворяющих условию
 */
function findTransactionsByDescription(string $descriptionPart): array
{
    global $transactions;
    return array_filter($transactions, fn($t) => str_contains($t['description'], $descriptionPart));
}


/**
 * Находит все транзакции с заданным id.
 * Использует глобальный массив $transactions.
 *
 * @param int $id идентификатор транзакции, который нужно найти
 * @return array массив транзакций с указанным id (может быть 0 или несколько элементов)
 */
function findTransactionById(int $id): array
{
    global $transactions;
    return array_filter($transactions, fn($t) => $t["id"] == $id);
}


/**
 * Для каждой транзакции возвращает количество дней между заданной датой и датой транзакции.
 * Использует глобальный массив $transactions.
 *
 * @param DateTime $date дата, относительно которой считать дни
 * @return array массив целых чисел, где каждый элемент — количество дней для соответствующей транзакции
 */
function daysSinceTransaction(DateTime $date): array
{
    global $transactions;
    return array_map(fn($t) => ($date->diff($t["date"]))->days, $transactions);
}


/**
 * Добавляет новую транзакцию в глобальный массив $transactions.
 *
 * @param int $id идентификатор транзакции
 * @param DateTime $date дата транзакции
 * @param float $amount сумма транзакции
 * @param string $description краткое описание транзакции
 * @param string $merchant имя магазина/сервиса
 * @return void
 */
function addTransaction(int $id, DateTime $date, float $amount, string $description, string $merchant): void
{
    global $transactions;
    $transactions[] = [
        "id" => $id,
        "date" => $date,
        "amount" => $amount,
        "description" => $description,
        "merchant" => $merchant,
    ];
}


/**
 * Сортирует массив транзакций по дате.
 *
 * @param array $transactions массив транзакций (будет отсортирован по значению поля 'date')
 * @param bool $newFirst если true, сортирует по дате от новых к старым; если false — от старых к новым
 * @return array новый массив, отсортированный транзакций по дате
 */
function sortByDate(array $transactions, bool $newFirst = true): array
{
    $cond = fn($a, $b) => $newFirst ? $b <=> $a : $a <=> $b;

    usort($transactions, fn($a, $b) => $cond($a['date'], $b['date']));

    return $transactions;
}


/**
 * Сортирует массив транзакций по сумме.
 *
 * @param array $transactions массив транзакций (будет отсортирован по значению поля 'amount')
 * @param bool $desc если true, сортирует по сумме от крупных к маленьким; если false — от маленьких к крупным
 * @return array новый массив, отсортированный транзакций по сумме
 */
function sortByAmount(array $transactions, bool $desc = true): array
{
    $cond = fn($a, $b) => $desc ? $b <=> $a : $a <=> $b;

    usort($transactions, fn($a, $b) => $cond($a['amount'], $b['amount']));

    return $transactions;
}