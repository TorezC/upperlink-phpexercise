
<!DOCTYPE html>
<html>
    <head>
        <title>Transactions</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
            .expense {
                color: red;
            }
            .income {
                color: green;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <!-- YOUR CODE -->
             <?php
                  include '../app/App.php';
                    $transactions = getFile();
                    $transactionsLen = count($transactions);
                    $totalIncome = getTotals()[0];
                    $totalExpense = getTotals()[1];
                    $netTotal = getTotals()[2];

                    for($i = 1; $i<$transactionsLen; $i++) {
                        $itemLen = count($transactions[$i]);
                        $row = "";
                        $lastIndex = $itemLen - 1;
                        for ($j = 0; $j<$itemLen; $j++) {
                            if ($j === 0) {                 // check if 1st column and change date format if true
                                $arrDate = $transactions[$i][$j];
                                $arrDate = explode('/', $arrDate);
                                $setDate =  date("M d, Y", mktime(0,0,0,$arrDate[0],$arrDate[1],$arrDate[2]));
                                $row .= "<td>". $setDate . "</td>";
                            }
                            elseif ($j !== $lastIndex) {        // check if it's not the last column
                                $row .= "<td>". $transactions[$i][$j]."</td>";
                            } else {
                                if (str_starts_with($transactions[$i][$j], '-')) {      // check if it's an expense and add red color if true
                                    $row .= "<td class='expense'>". $transactions[$i][$j]."</td>";
                                } else {                                        // check if it's an income and add green color if true
                                    $row .= "<td class='income'>". $transactions[$i][$j]."</td>";
                                }
                            }
                        }
                        echo "<tr>". $row . "</tr>";
                    }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
                    <?php echo "<td>$". $totalIncome . "</td>"; ?>
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
                    <?php echo "<td>-$". $totalExpense . "</td>"; ?>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
                    <?php echo "<td>$" . $netTotal . "</td>" ?>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
