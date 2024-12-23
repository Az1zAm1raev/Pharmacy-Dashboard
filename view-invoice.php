<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
    header('location:logout.php');
} else{
    if(isset($_GET['del'])){
        $cmpid=substr(base64_decode($_GET['del']),0,-5);
        $query=mysqli_query($con,"delete from tblcategory where id='$cmpid'");
        echo "<script>alert('Удалено');</script>";
        echo "<script>window.location.href='manage-categories.php'</script>";
    }
    $inid=substr(base64_decode($_GET['invid']),0,-5);

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
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>Диплом</title>
        <link href="vendors/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
        <link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
        <link href="dist/css/style.css" rel="stylesheet" type="text/css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>


    </head>
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
        #download-btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
    <body>


    <div class="hk-wrapper hk-vertical-nav">
        <?php include_once('includes/navbar.php');
        include_once('includes/sidebar.php');
        ?>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>

        <div class="hk-pg-wrapper">

            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Счет-фактура</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Просмотр</li>
                </ol>
            </nav>
            <div class="container">

                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="file"></i></span></span>Просмотр счет-фактуры</h4>
                </div>
                <div class="invoice-container">
                    <div class="fact">
                        <div class="invoice-header">
                            <h1 class="pb-30">СЧЕТ-ФАКТУРА</h1>
                            <table class="invoice-table">
                                <tr>
                                    <td>101</td>
                                    <td>Номер: <?php echo $invoiceData['InvoiceNumber']; ?></td>
                                    <td>102</td>
                                    <td>Дата: <?php echo $invoiceData['InvoiceGenDate']; ?></td>
                                    <td>103</td>
                                    <td>Форма оплаты: <?php echo $invoiceData['PaymentMode']; ?></td>
                                </tr>
                                <tr>
                                    <td>201</td>
                                    <td colspan="3">Поставщик: <?php echo $invoiceData['CompanyName']; ?></td>
                                    <td>301</td>
                                    <td>Получатель: <?php echo $invoiceData['CustomerName']; ?></td>
                                </tr>
                                <tr>
                                    <td>202</td>
                                    <td colspan="3">ИНН поставщика: <?php echo $invoiceData['INN']; ?></td>
                                    <td>302</td>
                                    <td>ИНН получателя: <?php echo $invoiceData['CINN']; ?></td>
                                </tr>
                                <tr>
                                    <td>203</td>
                                    <td colspan="3">Адрес поставщика: <?php echo $invoiceData['Adres']; ?></td>
                                    <td>303</td>
                                    <td>Адрес поставщика: <?php echo $invoiceData['CAdres']; ?></td>
                                </tr>
                                <tr>
                                    <td>204</td>
                                    <td colspan="3">Код районной ГНС: <?php echo $invoiceData['GNSСode']; ?></td>
                                    <td>304</td>
                                    <td colspan="3">Код районной ГНС: <?php echo $invoiceData['CGNSCode']; ?></td>
                                </tr>
                                <tr>
                                    <td>205</td>
                                    <td colspan="3">Наименование УГНС: <?php echo $invoiceData['company_tax_name']; ?></td>
                                    <td>305</td>
                                    <td colspan="3">Наименование УГНС: <?php echo $invoiceData['customer_tax_name']; ?></td>
                                </tr>
                                <tr>
                                    <td>206</td>
                                    <td colspan="3">Банковские реквизиты: <?php echo $invoiceData['Requisites']; ?></td>
                                    <td>306</td>
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
                                echo "<td></td>";
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
                </div>
                <a id="download-btn" href="javascript:void(0)" onclick="downloadPDF()">Скачать PDF</a>
            </div>
            <?php include_once('includes/footer.php');?>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <script>
            function downloadPDF() {
                var element = document.querySelector(".invoice-container");
                var opt = {
                    scale: 3,
                    useCORS: true,
                };

                html2canvas(element, opt).then(canvas => {
                    var imgData = canvas.toDataURL('image/png');
                    var pdf = new jspdf.jsPDF('p', 'mm', 'a4');
                    var imgWidth = 210;
                    var pageHeight = 295;
                    var imgHeight = canvas.height * imgWidth / canvas.width;
                    var heightLeft = imgHeight;
                    var position = 0;

                    pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;

                    while (heightLeft >= 0) {
                        position = heightLeft - imgHeight;
                        pdf.addPage();
                        pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                        heightLeft -= pageHeight;
                    }
                    pdf.save('счет-фактура.pdf');
                });
            }
        </script>
        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
        <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="dist/js/jquery.slimscroll.js"></script>
        <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="vendors/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="vendors/jszip/dist/jszip.min.js"></script>
        <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
        <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="dist/js/dataTables-data.js"></script>
        <script src="dist/js/feather.min.js"></script>
        <script src="dist/js/dropdown-bootstrap-extended.js"></script>
        <script src="vendors/jquery-toggles/toggles.min.js"></script>
        <script src="dist/js/toggle-data.js"></script>
        <script src="dist/js/init.js"></script>

    </body>
    </html>
<?php } ?>