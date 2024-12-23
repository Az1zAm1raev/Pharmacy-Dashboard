<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['aid'] == 0)) {
    header('location:logout.php');
} else { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <title>Диплом</title>
        <link href="vendors/vectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" type="text/css"/>
        <link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
        <link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
        <link href="vendors/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
        <link href="dist/css/style.css" rel="stylesheet" type="text/css">
    </head>

    <body>


    <div class="hk-wrapper hk-vertical-nav">

        <?php include_once('includes/navbar.php');
        include_once('includes/sidebar.php');
        ?>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <div class="hk-pg-wrapper">
            <div class="container-fluid mt-xl-50 mt-sm-30 mt-15">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hk-row">

                            <div class="col-md-12 text-center p-5 pt-0">
                                <h1>Информация</h1>
                            </div>

                            <?php
                            $query = mysqli_query($con, "select id from tblcategory");
                            $listedcat = mysqli_num_rows($query);
                            ?>

                            <div class="col-md-4">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-5">
                                            <div>
                                                <span class="d-block font-15 text-dark font-weight-500">Категории</span>
                                            </div>
                                            <div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <span class="d-block display-3 text-dark mb-5"><?php echo $listedcat; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <?php
                            $ret = mysqli_query($con, "select id from tblcompany");
                            $listedcomp = mysqli_num_rows($ret);
                            ?>
                            <div class="col-md-4">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-5">
                                            <div>
                                                <span class="d-block font-15 text-dark font-weight-500">Компании</span>
                                            </div>
                                            <div>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <span class="d-block display-3 text-dark mb-5"><span
                                                        class="counter-anim"><?php echo $listedcomp; ?></span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            $sql = mysqli_query($con, "select id from tblproducts");
                            $listedproduct = mysqli_num_rows($sql);
                            ?>
                            <div class="col-md-4">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-5">
                                            <div>
                                                <span class="d-block font-15 text-dark font-weight-500">Продукты</span>
                                            </div>
                                            <div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <span class="d-block display-3 text-dark mb-5"><?php echo $listedproduct; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 text-center p-5 pt-0">
                                <h1>Доходы</h1>
                            </div>

                            <?php
                            $query = mysqli_query($con, "select sum(tblorders.Quantity*tblproducts.ProductPrice) as tt  from tblorders join tblproducts on tblproducts.id=tblorders.ProductId ");
                            $row = mysqli_fetch_array($query);
                            ?>
                            <div class="col-md-4">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-5">
                                            <div>
                                                <span class="d-block font-15 text-dark font-weight-500">Продажи</span>
                                            </div>
                                            <div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <span class="d-block display-3 text-dark mb-5"><?php echo number_format($row['tt'], 2); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            $qury = mysqli_query($con, "select sum(tblorders.Quantity*tblproducts.ProductPrice) as tt  from tblorders join tblproducts on tblproducts.id=tblorders.ProductId where date(tblorders.InvoiceGenDate)>=(DATE(NOW()) - INTERVAL 7 DAY)");
                            $row = mysqli_fetch_array($qury);
                            ?>
                            <div class="col-md-4">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-5">
                                            <div>
                                                <span class="d-block font-15 text-dark font-weight-500">Продажи за последние 7 дней</span>
                                            </div>
                                            <div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <span class="d-block display-3 text-dark mb-5"><?php echo number_format($row['tt'], 2); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            $quryss = mysqli_query($con, "select sum(tblorders.Quantity*tblproducts.ProductPrice) as tt  from tblorders join tblproducts on tblproducts.id=tblorders.ProductId where date(tblorders.InvoiceGenDate)=CURDATE()");
                            $rws = mysqli_fetch_array($quryss);
                            ?>
                            <div class="col-md-4">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-5">
                                            <div>
                                                <span class="d-block font-15 text-dark font-weight-500">Сегодняшние продажи</span>
                                            </div>
                                            <div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <span class="d-block display-3 text-dark mb-5"><?php echo number_format($rws['tt'], 2); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12 text-center p-5 pt-0">
                                <h1>Расходы</h1>
                            </div>

                            <?php
                            $quryss = mysqli_query($con, "select sum(tblproducts.Quantity*tblproducts.ProductCost) as tt FROM tblproducts");
                            $rws = mysqli_fetch_array($quryss);
                            ?>
                            <div class="col-md-4">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-5">
                                            <div>
                                                <span class="d-block font-15 text-dark font-weight-500">Расходы</span>
                                            </div>
                                            <div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <span class="d-block display-3 text-dark mb-5"><?php echo number_format($rws['tt'], 2); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            $qury = mysqli_query($con, "select sum(tblproducts.Quantity*tblproducts.ProductCost) as tt FROM tblproducts WHERE date(tblproducts.PostingDate)>=(DATE(NOW()) - INTERVAL 7 DAY)");
                            $row = mysqli_fetch_array($qury);
                            ?>
                            <div class="col-md-4">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-5">
                                            <div>
                                                <span class="d-block font-15 text-dark font-weight-500">Расходы за последние 7 дней</span>
                                            </div>
                                            <div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <span class="d-block display-3 text-dark mb-5"><?php echo number_format($row['tt'], 2); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            $quryss = mysqli_query($con, "select sum(tblproducts.Quantity*tblproducts.ProductCost) as tt FROM tblproducts where date(tblproducts.PostingDate)=CURDATE()");
                            $rws = mysqli_fetch_array($quryss);
                            ?>
                            <div class="col-md-4">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-5">
                                            <div>
                                                <span class="d-block font-15 text-dark font-weight-500">Сегодняшние расходы</span>
                                            </div>
                                            <div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <span class="d-block display-3 text-dark mb-5"><?php echo number_format($rws['tt'], 2); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                    <!-- /Container -->

                    <!-- Footer -->
                    <?php include_once('includes/footer.php'); ?>
                    <!-- /Footer -->
                </div>
                <!-- /Main Content -->

            </div>
            <!-- /HK Wrapper -->

            <!-- jQuery -->
            <script src="vendors/jquery/dist/jquery.min.js"></script>
            <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
            <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
            <script src="dist/js/jquery.slimscroll.js"></script>
            <script src="dist/js/dropdown-bootstrap-extended.js"></script>
            <script src="dist/js/feather.min.js"></script>
            <script src="vendors/jquery-toggles/toggles.min.js"></script>
            <script src="dist/js/toggle-data.js"></script>
            <script src="vendors/waypoints/lib/jquery.waypoints.min.js"></script>
            <script src="vendors/jquery.counterup/jquery.counterup.min.js"></script>
            <script src="vendors/jquery.sparkline/dist/jquery.sparkline.min.js"></script>
            <script src="vendors/vectormap/jquery-jvectormap-2.0.3.min.js"></script>
            <script src="vendors/vectormap/jquery-jvectormap-world-mill-en.js"></script>
            <script src="dist/js/vectormap-data.js"></script>
            <script src="vendors/owl.carousel/dist/owl.carousel.min.js"></script>
            <script src="vendors/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
            <script src="vendors/apexcharts/dist/apexcharts.min.js"></script>
            <script src="dist/js/irregular-data-series.js"></script>
            <script src="dist/js/init.js"></script>

    </body>

    </html>
<?php } ?>