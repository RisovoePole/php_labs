<?php

declare(strict_types=1);

final class TransactionTableRenderer
{

    /**
     * Builds an HTML table from transaction list.
     *
     * @param Transaction[] $transactions
     */
    public function render(array $transactions): string
    {
        /*
        Метод должен возвращать HTML-таблицу со следующими столбцами:

    ID транзакции;
    дата;
    сумма;
    описание;
    название получателя;
    категория получателя;
    количество дней с момента транзакции.

        */

        $result = "<table>\n";
        $result .= "<tr>\n";
        $result .= "\t<th> id </th>\n";
        $result .= "\t<th> date </th>\n";
        $result .= "\t<th> amount </th>\n";
        $result .= "\t<th> description </th>\n";
        $result .= "\t<th> merchant </th>\n";
        $result .= "\t<th> day passed </th>";
        $result .= "</tr>\n";
        foreach ($transactions as $t) {
            $result .= "<tr>\n";
            $result .= "\t<td>" . $t->getId() . "</td>\n";
            $result .= "\t<td>" . $t->getDate()->format("Y-m-d H:i") . "</td>\n";
            $result .= "\t<td>" . $t->getAmount() . "</td>\n";
            $result .= "\t<td>" . $t->getDescription() . "</td>\n";
            $result .= "\t<td>" . $t->getMerchant() . "</td>\n";
            $result .= "\t<td>" . $t->getDaysSinceTransaction() . "</td>\n";
            $result .= "</tr>\n";
        }
        $result .= "</table>";
        return $result;
    }
}
