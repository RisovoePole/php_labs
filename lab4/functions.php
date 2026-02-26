<?php

//Output

function show_header_table(array $transaction) : string {
    $result ="<tr>\n";
    foreach(array_keys($transaction) as $key){
        $result.="<th>". $key ."</th>\n";
    }
    $result.="</tr>\n";
    return $result;
}

function show_body_table(array $transactions) : string{
    $result ="";
    foreach($transactions as $t){
    $t["date"] = $t["date"]->format("Y-m-d");
    $result.= "<tr>\n";
    foreach($t as $value){
        $result .= "\t<td>" . $value . "</td>\n";
    }
    $result.= "<tr>\n";
    };
    return $result;
}

//Logic

function calculateTotalAmount(array $transactions): float {
    return array_sum(array_column($transactions, 'amount'));
}






















































?>