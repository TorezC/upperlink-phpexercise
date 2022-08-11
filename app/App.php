<?php

declare(strict_types = 1);

// Your Code

function getFile() {
    $openFile = fopen("../transaction_files/sample_1.csv", "r");

    while (($transact = fgetcsv($openFile, 200, ","))) {
        $array[] = $transact;
    };

    fclose($openFile);

    return $array;
}

function getTotals() {
    $transaction = getFile();
    $transactionLen = count($transaction);
    $sumOfIncome = 0;
    $sumOfExpense = 0;
    
    for ($i=1; $i<$transactionLen; $i++) {
        $lastInd = count($transaction[$i]) - 1;
        $arrValue = $transaction[$i][$lastInd];
        if (!str_starts_with($arrValue, "-")) {       // check if positive value
            $incomeValue = trim_transaction($arrValue);
            $sumOfIncome += $incomeValue;
        } else {
            $expenseValue = trim_transaction($arrValue);
            $sumOfExpense += $expenseValue;
        }
    }
    $netTotal = $sumOfIncome+ $sumOfExpense;
    
    $sumOfIncome = number_format($sumOfIncome, 2);      // round up to 2 d.p

    $sumOfExpense = number_format($sumOfExpense, 2);
    $sumOfExpense = str_replace('-', '', $sumOfExpense);        // remove the '-' from expenses
    
    $netTotal = number_format($netTotal, 2);

    $totalsArr = array($sumOfIncome, $sumOfExpense, $netTotal);

    return $totalsArr;
}

function trim_transaction($transaction) {
    $transaction = str_replace('$', '', $transaction);  
    $transaction = str_replace(',', '', $transaction);  
    $transaction = (float)$transaction;       

    return $transaction;
};

?>