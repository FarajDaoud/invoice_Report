<?php

$servername = '';
$dbname = '';
$dbuser = '';
$dbpass = '';

$pMonth = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pMonth = testInput($_POST['month']);
}

function testInput($data) 
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

try {
    //set the variable $dbc for calling attr about the connection to the database.
    $dbc = new PDO("mysql:host=$servername;dbname=$dbname", $dbuser, $dbpass);
    $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "connected \r\n \r\n";
} catch(PDOException $e) {
    echo "failed to connect with Server \r\n \r\n";
    echo "Error: " . $e->getMessage();
    die();
}

try{

    $stmt = $dbc->prepare(
        'SELECT
            DATE_FORMAT(i.DATE, "%m-%d-%y") as "Date"
            ,count(i.INVOICE_NUM) as "Invoice Count"
            ,sum(i.SALE) as "Total Sales"
            ,sum(i.SHIPPING) as "Total Shipping"
            ,sum(i.TAX) as "Total Tax"
            ,sum(i.INVOICE_TOTAL) as "Total Invoice"
            ,sum(i.COST) as "Total Cost"
            ,sum(i.INVOICE_TOTAL) - sum(i.COST) as "Total Gross"
        FROM `invoices` as i
        where month(i.date) = :pMonth
        group by i.DATE
        order by i.DATE asc'
    );
    
    $stmt->bindParam(':pMonth', $pMonth);

    //construct HTML
    if($stmt->execute()){
    $outp = '<table id="tableInvoices" class="table table-responsive table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Date</th>
                        <th>Invoice Count</th>
                        <th>Total Sales</th>
                        <th>Total Shipping</th>
                        <th>Total Tax</th>
                        <th>Total Invoice</th>
                        <th>Total Cost</th>
                        <th>Total Gross</th>
                    </tr>
                </thead>
                <tbody>';
    $rowNum = 1;
    while ($row = $stmt->fetch()) {
        $outp .=    '<tr id="rowNum' . $rowNum . '">
                        <td class="date">' . $row["Date"] . '</td> 
                        <td class="invoiceCount"><button class="btn btn-info btn-sm" onClick="showModal('. $rowNum . ')">' . $row["Invoice Count"] . ' Invoice(s)</button></td>
                        <td class="totalSale">' . $row["Total Sales"] . '</td>
                        <td class="totalShipping">' . $row["Total Shipping"] . '</td>
                        <td class="totalTax">' . $row["Total Tax"] . '</td>
                        <td class="totalInvoice">' . $row["Total Invoice"] . '</td>
                        <td class="totalCost">' . $row["Total Cost"] . '</td>
                        <td class="totalGross">' . $row["Total Gross"] . '</td>
                    </tr>';
        $rowNum += 1;
    }
    $outp .=   '</tbody></table>';
    
    }
    echo $outp;
}
catch(PDOException $e) {
    echo "could not create xml \r\n \r\n";
    echo "Error: " . $e->getMessage();
    die();
}
?>