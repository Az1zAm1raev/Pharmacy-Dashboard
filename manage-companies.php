<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
    header('location:logout.php');
} else{
    if(isset($_GET['del'])){
        $cmpid=substr(base64_decode($_GET['del']),0,-5);
        $query=mysqli_query($con,"delete from tblcompany where id='$cmpid'");
        echo "<script>alert('Удалено');</script>";
        echo "<script>window.location.href='manage-companies.php'</script>";
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
                    <li class="breadcrumb-item active" aria-current="page">Управление</li>
                </ol>
            </nav>

                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="database"></i></span></span>Управление компаниями</h4>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-wrap">
                                        <table id="datable_1" class="table table-hover w-100 display pb-30">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Компания</th>
                                                <th>Дата</th>
                                                <th>ИНН</th>
                                                <th>Код районной ГНС</th>
                                                <th>Наименование УГНС</th>
                                                <th>Реквизиты</th>
                                                <th>Адрес</th>
                                                <th>Действие</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $rno=mt_rand(10000,99999);
                                            $query=mysqli_query($con,"select c. id,c.CompanyName , c.PostingDate, c.INN, c.GNSСode, c.Requisites, c.Adres, t.name from tblcompany c JOIN tax_codes t ON c.GNSСode = t.code;");
                                            $cnt=1;
                                            while($row=mysqli_fetch_array($query))
                                            {
                                                ?>
                                                <tr>
                                                    <td><?php echo $cnt;?></td>
                                                    <td><?php echo $row['CompanyName'];?></td>
                                                    <td><?php echo $row['PostingDate'];?></td>
                                                    <td><?php echo $row['INN'];?></td>
                                                    <td><?php echo $row['GNSСode'];?></td>
                                                    <td><?php echo $row['name'];?></td>
                                                    <td><?php echo $row['Requisites'];?></td>
                                                    <td><?php echo $row['Adres'];?></td>
                                                    <td>
                                                        <a href="edit-company.php?compid=<?php echo base64_encode($row['id'].$rno);?>" class="mr-25" data-toggle="tooltip" data-original-title="Edit"> <i class="icon-pencil"></i></a>
                                                        <a href="manage-companies.php?del=<?php echo base64_encode($row['id'].$rno);?>" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Вы уверены?');"> <i class="icon-trash txt-danger"></i> </a>
                                                    </td>
                                                </tr>
                                                <?php
                                                $cnt++;
                                            } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>

                </div>

            </div>
            <?php include_once('includes/footer.php');?>
        </div>
    </div>

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