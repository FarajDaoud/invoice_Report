<?php

$servername = '';
$dbname = '';
$dbuser = '';
$dbpass = '';

$pDate = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pDate = testInput($_POST['date']);
}

if($pDate != ''){
    $pDate = DateTime::createFromFormat('m-d-y', $pDate);
    $pDate = $pDate->format('Y-m-d');
}

function testInput($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

try {
    //set the variable $dbc for calling attr about the connection to the database.
    $dbc = new PDO("mysql:host=$servername;dbname=$dbname", $dbuser, $dbpass);
    $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo "failed to connect with Server \r\n \r\n";
    echo "Error: " . $e->getMessage();
    die();
}


try{

    $stmt = $dbc->prepare(
                'SELECT
                    i.INVOICE_NUM as "Invoice ID"
                    ,i.ORDER_NUM as "Order ID"
                    ,i.NAME as "Customer Name"
                    ,i.SALE as "Sales"
                    ,i.SHIPPING as "Shipping"
                    ,i.TAX as "Tax"
                    ,i.INVOICE_TOTAL AS "Invoice Total"
                    ,i.COST as "Cost"
                    ,i.INVOICE_TOTAL - i.COST as "Gross"
                FROM `invoices` as i
                where i.DATE = :pDate
                order by i.INVOICE_NUM asc'
            );

    $stmt->bindParam(':pDate', $pDate);

    //construct HTML to return to the client
    if($stmt->execute()){

        //create html for data container and header row. 
        $outp = '<table id="tableModal" class="table table-responsive table-hover">
                    <thead class="thead-dark">
                        <th>Invoice ID</th>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Sales</th>
                        <th>Shipping</th>
                        <th>Tax</th>
                        <th>Invoice Total</th>
                        <th>Cost</th>
                        <th>Gross</th>
                    </thead>
                    <tbody>';
        $rowNum = 1;

        //for each row returned by the select statment construct the html for a given row.   
        while ($row = $stmt->fetch()) {
            $outp .=    '<tr id="row_'. $rowNum .'">
                            <td class="invoiceID">'. $row["Invoice ID"] . '</td>
                            <td class="orderID">'. $row["Order ID"] . '</td>
                            <td class="customerName">'. $row["Customer Name"] . '</td>
                            <td class="sales">'. $row["Sales"] . '</td>
                            <td class="shipping">'. $row["Shipping"] . '</td>
                            <td class="tax">'. $row["Tax"] . '</td>
                            <td class="totalInvoice">'. $row["Invoice Total"] . '</td>
                            <td class="cost">'. $row["Cost"] . '</td>
                            <td class="gross">'. $row["Gross"] . '</td>
                        </tr>';
            $rowNum += 1;
        }
        $outp .= '</tbody></table>';
    }
    echo $outp;
}
catch(PDOException $e) {
    echo "could not create xml \r\n \r\n";
    echo "Error: " . $e->getMessage();
    die();
}


?>