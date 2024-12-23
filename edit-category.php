<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['update']))
{
$cid=substr(base64_decode($_GET['catid']),0,-5);    
$catname=$_POST['category'];
$catcode=$_POST['categorycode'];   
$query=mysqli_query($con,"update tblcategory set CategoryName='$catname',CategoryCode='$catcode' where id='$cid'"); 
echo "<script>alert('Категория изменена успешно');</script>";
echo "<script>window.location.href='manage-categories.php'</script>";
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
<li class="breadcrumb-item"><a href="#">Категория</a></li>
<li class="breadcrumb-item active" aria-current="page">Изменить</li>
                </ol>
            </nav>
            <div class="container">
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="external-link"></i></span></span>Изменить категорию</h4>
                </div>
                <div class="row">
                    <div class="col-xl-12">
<section class="hk-sec-wrapper">

<div class="row">
<div class="col-sm">
<form class="needs-validation" method="post" novalidate>
<?php
$cid=substr(base64_decode($_GET['catid']),0,-5);
$ret=mysqli_query($con,"select * from tblcategory where ID='$cid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
?>                                       
<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">Категория</label>
<input type="text" class="form-control" id="validationCustom03" value="<?php echo $row['CategoryName'];?>" name="category" required>
<div class="invalid-feedback">Введите категорию</div>
</div>
</div>

<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">Код категории</label>
<input type="text" class="form-control" id="validationCustom03" value="<?php echo $row['CategoryCode'];?>" name="categorycode" required>
<div class="invalid-feedback">Введите код категории</div>
</div>
</div>
<?php } ?>                                 
<button class="btn btn-primary" type="submit" name="update">Изменить</button>
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