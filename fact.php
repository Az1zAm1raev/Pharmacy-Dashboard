<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['aid']) == 0) {
    header('location:logout.php');
} else {
    // Получение данных для заголовка
    $inid = 250124519;
//    $query = mysqli_query($con, "SELECT DISTINCT InvoiceNumber, CustomerName, CustomerContactNo, PaymentMode, InvoiceGenDate FROM tblorders WHERE InvoiceNumber='$inid'");
//    $invoiceData = mysqli_fetch_array($query);
    // Получение данных для таблицы товаров
    $productsQuery = mysqli_query($con, "
   SELECT tblproducts.CategoryName, 
           tblproducts.ProductName, 
           tblproducts.CompanyName, 
           tblproducts.ProductPrice,
           tblorders.Quantity, 
           tblorders.PaymentMode,	
           tblorders.InvoiceNumber,
           tblorders.CustomerName,
           tblorders.CustomerContactNo, 
           tblorders.PaymentMode,
           tblorders.InvoiceGenDate,
           tblorders.CRequisites,
           tblorders.CAdres,
           tblorders.CINN,
           tblorders.CGNSCode,           
           tblcompany.Adres,
           tblcompany.GNSСode, 
           tblcompany.Requisites,
           tblcompany.INN,
    	   tc1.name AS company_tax_name,
           tc2.name AS customer_tax_name
    FROM tblorders 
        JOIN tblproducts ON tblproducts.id = tblorders.ProductId 
        JOIN tblcompany ON tblcompany.CompanyName = tblproducts.CompanyName 
        JOIN tax_codes AS tc1 ON tc1.code = tblcompany.GNSСode
        JOIN tax_codes AS tc2 ON tc2.code = tblorders.CGNSCode

            WHERE tblorders.InvoiceNumber =  '$inid'");
    $invoiceData = mysqli_fetch_array($productsQuery);
    $products = [];
    while ($row = mysqli_fetch_array($productsQuery)) {
        $products[] = $row;
    }
}
?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>Счет-фактура</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                font-size: 14px;
                color: #000;
            }
            .invoice-container {
                width: 100%;
                max-width: 800px;
                margin: 0 auto;
                padding: 20px;
                border: 1px solid #000;
            }
            .invoice-header, .invoice-footer {
                text-align: center;
                margin-bottom: 20px;
            }
            .invoice-table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
                font-size: 12px;
            }
            .invoice-table th, .invoice-table td {
                border: 1px solid #000;
                padding: 8px;
                text-align: center;
            }
            .invoice-table th {
                background-color: #f2f2f2;
            }
            .section-title {
                font-weight: bold;
                text-align: left;
                margin: 10px 0;
            }
            .total-row th, .total-row td {
                font-weight: bold;
            }
            .signatures {
                display: flex;
                justify-content: space-between;
                margin-top: 30px;
            }
            .signatures div {
                width: 45%;
                text-align: center;
            }
        </style>
    </head>
    <body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h2>Образец</h2>
            <h3>СЧЕТ-ФАКТУРА НДС</h3>
            <table class="invoice-table">
                <tr>
                    <td>102</td>
                    <td>Номер: <?php echo $invoiceData['InvoiceNumber']; ?></td>
                    <td>103</td>
                    <td>Дата: <?php echo $invoiceData['InvoiceGenDate']; ?></td>
                    <td>103</td>
                    <td>Форма оплаты: <?php echo $invoiceData['PaymentMode']; ?></td>
                </tr>
                <tr>
                    <td>201</td>
                    <td colspan="3">Поставщик: <?php echo $invoiceData['CompanyName']; ?></td>
                    <td>204</td>
                    <td>Получатель: <?php echo $invoiceData['CustomerName']; ?></td>
                </tr>
                <tr>
                    <td>202</td>
                    <td colspan="3">ИНН поставщика: <?php echo $invoiceData['INN']; ?></td>
                    <td>205</td>
                    <td>ИНН получателя: <?php echo $invoiceData['CINN']; ?></td>
                </tr>
                <tr>
                    <td>203</td>
                    <td colspan="3">Адрес поставщика: <?php echo $invoiceData['Adres']; ?></td>
                    <td>207</td>
                    <td>Адрес поставщика: <?php echo $invoiceData['CAdres']; ?></td>
                </tr>
                <tr>
                    <td>300</td>
                    <td colspan="3">Код районной ГНС: <?php echo $invoiceData['GNSСode']; ?></td>
                    <td>301</td>
                    <td colspan="3">Код районной ГНС: <?php echo $invoiceData['CGNSCode']; ?></td>
                </tr>
                <tr>
                    <td>302</td>
                    <td colspan="3">Наименование УГНС: <?php echo $invoiceData['company_tax_name']; ?></td>
                    <td>303</td>
                    <td colspan="3">Наименование УГНС: <?php echo $invoiceData['customer_tax_name']; ?></td>
                </tr>
                <tr>
                    <td>400</td>
                    <td colspan="3">Банковские реквизиты: <?php echo $invoiceData['Requisites']; ?></td>
                    <td>401</td>
                    <td>Банковские реквизиты: <?php echo $invoiceData['CRequisites']; ?></td>
                </tr>
            </table>
        </div>

        <div class="section-title">Раздел "Отгрузка"</div>
        <table class="invoice-table">
            <thead>
            <tr>
                <th>Код группы товаров</th>
                <th>Наименование товаров (работ, услуг)</th>
                <th>Единица измерения</th>
                <th>Количество</th>
                <th>Стоимость товаров (работ, услуг) без НДС и НСП (сом)</th>
                <th>НДС (сом)</th>
                <th>НСП (сом)</th>
                <th>Всего стоимость поставки (сом)</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $query = mysqli_query($con, "SELECT 
                tblproducts.CategoryName, 
                tblproducts.ProductName, 
                tblproducts.CompanyName,
                tblproducts.ProductPrice,
                tblorders.Quantity,           
                tblcategory.CategoryCode                
            FROM tblorders 
                JOIN tblproducts ON tblproducts.id = tblorders.ProductId 
                JOIN tblcategory ON tblcategory.CategoryName = tblproducts.CategoryName
            WHERE tblorders.InvoiceNumber = '$inid'");

            $cnt = 1;
            $grandtotal = 0; // Инициализация grandtotal
            $grandnsp = 0; // Инициализация grandtotal
            $grandnds = 0; // Инициализация grandtotal


            while ($row = mysqli_fetch_array($query)) {
                $qty = $row['Quantity'];
                $ppu = $row['ProductPrice'];
                $subtotal = $ppu * $qty;
                $grandtotal += $subtotal; // Накопление subtotal в grandtotal

                $nds = $subtotal / 100 * 12;
                $nsp = $subtotal / 100 * 1;

                $grandnds+=$nds;
                $grandnsp+=$nsp;

                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['CategoryCode']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['ProductName']) . "</td>";
                    echo "<td>шт</td>";
                    echo "<td>" . htmlspecialchars($row['Quantity']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['ProductPrice']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['ProductPrice'] / 100 * 12) . "</td>";
                    echo "<td>" . $row['ProductPrice'] / 100 . "</td>";
                    echo "<td>" . number_format($subtotal+$nds+$nsp, 2) . "</td>";
                    echo "</tr>";

                    $cnt++;

            }
            ?>
            <tr class="total-row">
                <td colspan="4">ИТОГО</td>
                <td><?php echo number_format($grandtotal, 2); ?></td>
                <td><?php echo $grandnds ?></td>
                <td><?php echo $grandnsp ?></td>
                <th><?php echo number_format($grandtotal + $grandnds + $grandnsp, 2, '.', ','); ?></th>
            </tr>
            </tbody>
        </table>

        <div class="signatures">
            <div>
                <p>Руководитель:</p>
                <p>________________________</p>
            </div>
            <div>
                <p>Главный бухгалтер:</p>
                <p>________________________</p>
            </div>
        </div>
    </div>
    </body>
    </html>
<?php ?>
