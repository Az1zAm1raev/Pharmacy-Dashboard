<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $cname = $_POST['companyname'];
        $cinn = $_POST['companyinn'];
        $cgn = $_POST['companygns'];
        $creq = $_POST['companyreq'];
        $cadd = $_POST['companyadr'];
        $check_tax_code = $con->query("SELECT name FROM tax_codes WHERE code='$cgn'");
        if ($check_tax_code->num_rows > 0) {
            $query = mysqli_query($con, "insert into tblcompany(CompanyName, INN, GNSСode, Requisites, Adres) values('$cname', '$cinn','$cgn', '$creq','$cadd')");
            if ($query) {
                echo "<script>alert('Компания добавилась');</script>";
                echo "<script>window.location.href='add-company.php'</script>";
            } else {
                echo "<script>alert('Попробуйте еще раз');</script>";
                echo "<script>window.location.href='add-company.php'</script>";
            }
        } else {
            echo "<script>alert('Попробуйте еще раз');</script>";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
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
                    <li class="breadcrumb-item"><a href="#">Компании</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Добавить</li>
                </ol>
            </nav>
            <div class="container">
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="external-link"></i></span></span>Добавить компанию</h4>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">

                            <div class="row">
                                <div class="col-sm">
                                    <form class="needs-validation" method="post" novalidate>

                                        <div class="form-row">
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom03">Название компании</label>
                                                <input type="text" class="form-control" id="validationCustom03" name="companyname" required>
                                                <div class="invalid-feedback">Введите название компании</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom03">ИНН компании</label>
                                                <input type="text" class="form-control" id="validationCustom03" name="companyinn" required>
                                                <div class="invalid-feedback">Введите инн компании</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom03">Код районной ГНС</label>
                                                <input type="text" class="form-control" id="validationCustom03" name="companygns" required>
                                                <div class="invalid-feedback">Введите код районной ГНС</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom03">Реквизиты</label>
                                                <input type="text" class="form-control" id="validationCustom03" name="companyreq" required>
                                                <div class="invalid-feedback">Введите реквизиты</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom03">Адрес</label>
                                                <input type="text" class="form-control" id="validationCustom03" name="companyadr" required>
                                                <div class="invalid-feedback">Введите адрес</div>
                                            </div>
                                        </div>

                                        <button class="btn btn-primary" type="submit" name="submit">Отправить</button>
                                    </form>
                                </div>
                            </div>
                        </section>

                    </div>
                </div>
            </div>


            <?php include_once('includes/footer.php');?>

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

    </body>
    </html>
<?php } ?>