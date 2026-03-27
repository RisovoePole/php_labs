<?php
include __DIR__ . '/transactions.php';
require __DIR__ . '/functions.php';

$findTransactions = findTransactionsByDescription("Laptop");

//var_dump($findTransactions); 

$findTran = findTransactionById(8);

//var_dump($findTran); 

addTransaction(11, new DateTime(), 999, "some desc", "MYSELF");

var_dump($transactions[10]);