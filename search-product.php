<?php
session_start();


include('includes/config.php');
if (strlen($_SESSION['aid']) == 0) {
    header('location:logout.php');
} else {
    if (!empty($_GET["action"])) {
        switch ($_GET["action"]) {

            case "add":
                if (!empty($_POST["quantity"])) {
                    $pid = $_GET["pid"];
                    $quantity = intval($_POST["quantity"]);
                    $result = mysqli_query($con, "SELECT * FROM tblproducts WHERE id='$pid'");
                    $productByCode = mysqli_fetch_array($result);

                    if ($productByCode) {
                        $availableQuantity = intval($productByCode["Quantity"]);
                        if ($quantity <= $availableQuantity) {
                            $itemArray = array($productByCode["id"] => array(
                                'catname' => $productByCode["CategoryName"],
                                'compname' => $productByCode["CompanyName"],
                                'quantity' => $quantity,
                                'pname' => $productByCode["ProductName"],
                                'price' => $productByCode["ProductPrice"],
                                'code' => $productByCode["id"]
                            ));
                            if (!empty($_SESSION["cart_item"])) {
                                if (in_array($productByCode["id"], array_keys($_SESSION["cart_item"]))) {
                                    foreach ($_SESSION["cart_item"] as $k => $v) {
                                        if ($productByCode["id"] == $k) {
                                            $_SESSION["cart_item"][$k]["quantity"] += $quantity;
                                        }
                                    }
                                } else {
                                    $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                                }
                            } else {
                                $_SESSION["cart_item"] = $itemArray;
                            }
                        } else {
                            echo '<script>alert("Requested quantity exceeds available stock.");</script>';
                        }
                    }
                }
                break;

                case "remove":
                if (!empty($_SESSION["cart_item"])) {
                    foreach ($_SESSION["cart_item"] as $k => $v) {
                        if ($_GET["code"] == $k)
                            unset($_SESSION["cart_item"][$k]);
                        if (empty($_SESSION["cart_item"]))
                            unset($_SESSION["cart_item"]);
                    }
                }
                break;

            case "empty":
                unset($_SESSION["cart_item"]);
                break;
        }
    }

    function sendPostRequest($requisite, $total_price) {

        $url = 'http://localhost:8080/api/client/payment/make';

        // Генерация случайного числа для externalId
        $externalId = rand(100000, 999999);

        // Тело запроса
        $data = [
            "requisite" => $requisite,
            "amount" => $total_price,
            "serviceId" => 1,
            "externalId" => $externalId
        ];

        // Конвертация тела запроса в JSON
        $jsonData = json_encode($data);

        // Создание контекста для запроса
        $options = [
            'http' => [
                'header' => [
                    "Content-Type: application/json",
                    "Authorization: Basic " . base64_encode("clienttest1:clienttest1")
                ],
                'method' => 'POST',
                'content' => $jsonData
            ]
        ];

        $context = stream_context_create($options);
        var_dump($context);
        var_dump($jsonData);

        // Отправка запроса
        $result = file_get_contents($url, false, $context);

        if ($result === FALSE) {
            die('Error occurred');
        }

        // Обработка ответа
        var_dump($result);
    }

    if (isset($_POST['checkout'])) {
        $invoiceno = mt_rand(100000000, 999999999);
        $pid = $_SESSION['productid'];
        $quantity = $_POST['quantity'];
        $cname = $_POST['customername'];
        $cmobileno = $_POST['mobileno'];
        $pmode = $_POST['paymentmode'];
        $pname = $_POST['productname'];
        $preq = $_POST['customerreq'];
        $pgns = $_POST['customergns'];
        $padr = $_POST['customeradr'];
        $pinn = $_POST['inn'];
        $value = array_combine($pid, $quantity);

        foreach ($value as $pdid => $qty) {
            $query = mysqli_query($con, "insert into tblorders(ProductId,Quantity,InvoiceNumber,CustomerName,CustomerContactNo,PaymentMode, CGNSCode, CRequisites, CAdres, CINN) values('$pdid','$qty','$invoiceno','$cname','$cmobileno','$pmode', '$pgns', '$preq', '$padr', $pinn)");
            $update_query = mysqli_query($con, "UPDATE tblproducts SET Quantity = Quantity - $qty WHERE id = '$pdid'");
        }
        sendPostRequest($cmobileno, $_SESSION['total_price']);
        echo '<script>alert("Квитанция №"+"' . $invoiceno . '")</script>';
        unset($_SESSION["cart_item"]);
        $_SESSION['invoice'] = $invoiceno;
        echo "<script>window.location.href='invoice.php'</script>";

    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <title>Диплом</title>
        <link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
        <link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
        <link href="dist/css/style.css" rel="stylesheet" type="text/css">
    </head>

    <body>


    <div class="hk-wrapper hk-vertical-nav">

        <?php include_once('includes/navbar.php');
        include_once('includes/sidebar.php');
        ?>


        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <div class="hk-pg-wrapper">
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Поиск</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Продукт</li>
                </ol>
            </nav>
            <div class="container">
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i
                                        data-feather="external-link"></i></span></span>Поиск продукта</h4>
                </div>
                <div class="row">
                    <div class="col-xl-12">

                        <section class="hk-sec-wrapper">

                            <div class="row">
                                <div class="col-sm">
                                    <form class="needs-validation" method="post" novalidate>

                                        <div class="form-row">
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom03">Название продукта</label>
                                                <input type="text" class="form-control" id="validationCustom03"
                                                       name="productname" required>
                                                <div class="invalid-feedback">Введите название продукта</div>
                                            </div>
                                        </div>


                                        <button class="btn btn-primary" type="submit" name="search">поиск</button>
                                    </form>
                                </div>
                            </div>
                        </section>
                        <?php if(isset($_POST['search'])){?>
                        <section class="hk-sec-wrapper">

                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-wrap">
                                        <table id="datable_1" class="table table-hover w-100 display pb-30">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Категория</th>
                                                <th>Компания</th>
                                                <th>Продукт</th>
                                                <th>Цена</th>
                                                <th>Количество</th>
                                                <th>Действие</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $pname = $_POST['productname'];
                                            $query = mysqli_query($con, "select * from tblproducts where ProductName like '%$pname%'");
                                            $cnt = 1;
                                            while ($row = mysqli_fetch_array($query)) {
                                                ?>
                                                <form method="post"
                                                      action="search-product.php?action=add&pid=<?php echo $row["id"]; ?>">
                                                    <tr>
                                                        <td><?php echo $cnt; ?></td>
                                                        <td><?php echo $row['CategoryName']; ?></td>
                                                        <td><?php echo $row['CompanyName']; ?></td>
                                                        <td><?php echo $row['ProductName']; ?></td>
                                                        <td><?php echo $row['ProductPrice']; ?></td>
                                                        <td><input type="text" class="product-quantity" name="quantity"
                                                                   value="1" size="2"/></td>
                                                        <td>
                                                            <input type="submit" value="Добавить" class="btnAddAction"/>
                                                        </td>
                                                    </tr>
                                                </form>
                                                <?php
                                                $cnt++;
                                            } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <?php } ?>


                        <form class="needs-validation" method="post" novalidate>

                            <section class="hk-sec-wrapper">

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="table-wrap">
                                            <h4>Корзина</h4>
                                            <hr/>

                                            <a id="btnEmpty" href="search-product.php?action=empty">Пустая корзина</a>
                                            <?php
                                            if (isset($_SESSION["cart_item"])){
                                            $total_quantity = 0;
                                            $total_price = 0;
                                            ?>
                                            <table id="datable_1" class="table table-hover w-100 display pb-30"
                                                   border="1">
                                                <tbody>
                                                <tr>
                                                    <th>Название продукта</th>
                                                    <th>Категория</th>
                                                    <th>Компания</th>
                                                    <th>Количество</th>
                                                    <th>Цена</th>
                                                    <th>Итог</th>
                                                    <th>Удалить</th>
                                                </tr>
                                                <?php
                                                $productid = array();
                                                foreach ($_SESSION["cart_item"] as $item) {
                                                    $item_price = $item["quantity"] * $item["price"];
                                                    array_push($productid, $item['code']);

                                                    ?>
                                                    <input type="hidden" value="<?php echo $item['quantity']; ?>"
                                                           name="quantity[<?php echo $item['code']; ?>]">
                                                    <tr>
                                                        <td><?php echo $item["pname"]; ?></td>
                                                        <td><?php echo $item["catname"]; ?></td>
                                                        <td><?php echo $item["compname"]; ?></td>
                                                        <td><?php echo $item["quantity"]; ?></td>
                                                        <td><?php echo $item["price"]; ?></td>
                                                        <td><?php echo number_format($item_price, 2); ?></td>
                                                        <td>
                                                            <a href="search-product.php?action=remove&code=<?php echo $item["code"]; ?>"
                                                               class="btnRemoveAction"><img src="dist/img/remove.png"
                                                                                            alt="Remove Item"/></a></td>
                                                    </tr>
                                                    <?php
                                                    $total_quantity += $item["quantity"];
                                                    $total_price += ($item["price"] * $item["quantity"]);
                                                    $_SESSION['total_price'] = $total_price;
                                                }
                                                $_SESSION['productid'] = $productid;
                                                ?>

                                                <tr>
                                                    <td colspan="3" align="right">Total:</td>
                                                    <td colspan="2"><?php echo $total_quantity; ?></td>
                                                    <td colspan=>
                                                        <strong><?php echo number_format($total_price, 2); ?></strong>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                </tbody>
                                            </table>

                                            <div class="form-row">
                                                <div class="col-md-6 mb-10">
                                                    <label for="validationCustom03">Имя</label>
                                                    <input type="text" class="form-control" id="validationCustom03"
                                                           name="customername" required>
                                                    <div class="invalid-feedback">Введите имя</div>
                                                </div>
                                                <div class="col-md-6 mb-10">
                                                    <label for="validationCustom03">Телефон</label>
                                                    <input type="text" class="form-control" id="validationCustom03"
                                                           name="mobileno" required>
                                                    <div class="invalid-feedback">Введите телефон</div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-6 mb-10">
                                                    <label for="validationCustom03">Код районной ГНС</label>
                                                    <input type="text" class="form-control" id="validationCustom03"
                                                           name="customergns" required>
                                                    <div class="invalid-feedback">Введите код гнс</div>
                                                </div>
                                                <div class="col-md-6 mb-10">
                                                    <label for="validationCustom03">Адрес</label>
                                                    <input type="text" class="form-control" id="validationCustom03"
                                                           name="customeradr" required>
                                                    <div class="invalid-feedback">Введите адрес</div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-6 mb-10">
                                                    <label for="validationCustom03">Реквизиты</label>
                                                    <input type="text" class="form-control" id="validationCustom03"
                                                           name="customerreq" required>
                                                    <div class="invalid-feedback">Введите реквизиты</div>
                                                </div>
                                                <div class="col-md-6 mb-10">
                                                    <label for="validationCustom03">ИНН</label>
                                                    <input type="text" class="form-control" id="validationCustom03"
                                                           name="inn" required>
                                                    <div class="invalid-feedback">Введите инн</div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-6 mb-10">
                                                    <label for="validationCustom03">Метод оплаты</label>
                                                    <div class="custom-control custom-radio mb-10">
                                                        <input type="radio" class="custom-control-input"
                                                               id="customControlValidation2" name="paymentmode"
                                                               value="Наличные" required>
                                                        <label class="custom-control-label"
                                                               for="customControlValidation2">Наличные</label>
                                                    </div>
                                                    <div class="custom-control custom-radio mb-10">
                                                        <input type="radio" class="custom-control-input"
                                                               id="customControlValidation3" name="paymentmode"
                                                               value="Карта" required>
                                                        <label class="custom-control-label"
                                                               for="customControlValidation3">Карта</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-10">
                                                    <button class="btn btn-primary" type="submit" name="checkout">
                                                        Выполнить
                                                    </button>
                                                </div>
                                            </div>
                        </form>

                        <?php
                        } else {
                        ?>
                        <div style="color:red" align="center">Корзина пустая</div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            </section>


        </div>
    </div>
    </div>


    <?php include_once('includes/footer.php'); ?>

    </div>

    </div>

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="vendors/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
    <script src="dist/js/jquery.slimscroll.js"></script>
    <script src="dist/js/dropdown-bootstrap-extended.js"></script>
    <script src="dist/js/feather.min.js"></script>
    <script src="vendors/jquery-toggles/toggles.min.js"></script>
    <script src="dist/js/toggle-data.js"></script>
    <script src="dist/js/init.js"></script>
    <script src="dist/js/validation-data.js"></script>
    <style type="text/css">

        #btnEmpty {
            background-color: #ffffff;
            border: #d00000 1px solid;
            padding: 5px 10px;
            color: #d00000;
            float: right;
            text-decoration: none;
            border-radius: 3px;
            margin: 10px 0px;
        }

    </style>

    </body>
    </html>
<?php } ?>