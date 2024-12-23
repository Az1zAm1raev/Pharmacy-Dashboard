<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit']))
{
$catname=$_POST['category'];
$company=$_POST['company'];   
$pname=$_POST['productname'];
$pcost=$_POST['productcost'];
$pprice=$_POST['productprice'];
$pquantity=$_POST['productquant'];
$pman = $_POST['productman'];
$papp = $_POST['productapp'];
$pcond = $_POST['productcond'];
$pdos = $_POST['productdos'];
$ppack = $_POST['productpack'];
$pbef = $_POST['productbef'];
$query=mysqli_query($con,"insert into tblproducts(CategoryName,CompanyName,ProductName,ProductCost,ProductPrice, Quantity, Manufacture, Application, StorageConditions, Dosage, Package, BestBefore) values('$catname','$company','$pname','$pcost','$pprice','$pquantity', '$pman', '$papp', '$pcond', '$pdos', '$ppack', '$pbef')");
if($query){
echo "<script>alert('Продукт добавлен');</script>";
echo "<script>window.location.href='add-product.php'</script>";
} else{
echo "<script>alert('Попробуйте еще раз');</script>";
echo "<script>window.location.href='add-product.php'</script>";    
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
                <li class="breadcrumb-item"><a href="#">Продукт</a></li>
                <li class="breadcrumb-item active" aria-current="page">Добавить</li>
            </ol>
        </nav>

        <div class="container">
            <div class="hk-pg-header">
                <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="external-link"></i></span></span>Добавить продукт</h4>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <section class="hk-sec-wrapper">
                        <div class="row">
                            <div class="col-sm">
                                <form class="needs-validation" method="post" novalidate>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-10">
                                            <label for="validationCustom03">Категория</label>
                                            <select class="form-control custom-select" name="category" required>
                                                <option value=""></option>
                                                <?php
                                                $ret=mysqli_query($con,"select CategoryName from tblcategory");
                                                while($row=mysqli_fetch_array($ret))
                                                {?>
                                                    <option value="<?php echo $row['CategoryName'];?>"><?php echo $row['CategoryName'];?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="invalid-feedback">Выберите категорию</div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6 mb-10">
                                            <label for="validationCustom03">Компания</label>
                                            <select class="form-control custom-select" name="company" required>
                                                <option value=""></option>
                                                <?php
                                                $ret=mysqli_query($con,"select CompanyName from tblcompany");
                                                while($row=mysqli_fetch_array($ret))
                                                {?>
                                                    <option value="<?php echo $row['CompanyName'];?>"><?php echo $row['CompanyName'];?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="invalid-feedback">Выберите категорию</div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6 mb-10">
                                            <label for="validationCustom03">Название продукта</label>
                                            <input type="text" class="form-control" id="validationCustom03" name="productname" required>
                                            <div class="invalid-feedback">Введите название продукта</div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6 mb-10">
                                            <label for="validationCustom03">Купленная цена продукта</label>
                                            <input type="text" class="form-control" id="validationCustom03" name="productcost" required>
                                            <div class="invalid-feedback">Введите цену продукта</div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6 mb-10">
                                            <label for="validationCustom03">Продаваемая цена продукта</label>
                                            <input type="text" class="form-control" id="validationCustom03" name="productprice" required>
                                            <div class="invalid-feedback">Введите цену продукта</div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6 mb-10">
                                            <label for="validationCustom03">Количество</label>
                                            <input type="text" class="form-control" id="validationCustom03" name="productquant" required>
                                            <div class="invalid-feedback">Введите количество продукта</div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6 mb-10">
                                            <label for="validationCustom03">Производство</label>
                                            <input type="text" class="form-control" id="validationCustom03" name="productman" required>
                                            <div class="invalid-feedback">Введите страну производителя продукта</div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6 mb-10">
                                            <label for="validationCustom03">Применение</label>
                                            <input type="text" class="form-control" id="validationCustom03" name="productapp" required>
                                            <div class="invalid-feedback">Введите применение продукта</div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6 mb-10">
                                            <label for="validationCustom03">Условия хранения</label>
                                            <input type="text" class="form-control" id="validationCustom03" name="productcond" required>
                                            <div class="invalid-feedback">Введите условия хранения продукта</div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6 mb-10">
                                            <label for="validationCustom03">Дозировка</label>
                                            <input type="text" class="form-control" id="validationCustom03" name="productdos" required>
                                            <div class="invalid-feedback">Введите необходимую дозировку</div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6 mb-10">
                                            <label for="validationCustom03">Упаковка</label>
                                            <input type="text" class="form-control" id="validationCustom03" name="productpack" required>
                                            <div class="invalid-feedback">Введите количество штук в упаковке</div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6 mb-10">
                                            <label for="validationCustom03">Срок годности</label>
                                            <input type="date" class="form-control" id="validationCustom03" name="productbef" required>
                                            <div class="invalid-feedback">Введите срок годности</div>
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