<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit']))
{
$adminid=$_SESSION['aid'];
$cpassword=md5($_POST['currentpassword']);
$newpassword=md5($_POST['newpassword']);
$query=mysqli_query($con,"select ID from tbladmin where ID='$adminid' and   Password='$cpassword'");
$row=mysqli_fetch_array($query);
if($row>0){
$ret=mysqli_query($con,"update tbladmin set Password='$newpassword' where ID='$adminid'");
echo "<script>alert('Пароль изменен успешно');</script>";
echo "<script>window.location.href='change-password.php'</script>";
} else {
echo "<script>alert('Текущий пароль неверный');</script>";
echo "<script>window.location.href='change-password.php'</script>";
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
<script type="text/javascript">
function checkpass()
{
if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
{
alert('New Password and Confirm Password field does not match');
document.changepassword.confirmpassword.focus();
return false;
}
return true;
}   
</script>    
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
<li class="breadcrumb-item"><a href="#">Change Password</a></li>
<li class="breadcrumb-item active" aria-current="page">Admin</li>
                </ol>
            </nav>
            <div class="container">
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="external-link"></i></span></span>Смена пароля</h4>
                </div>
                <div class="row">
                    <div class="col-xl-12">
<section class="hk-sec-wrapper">

<div class="row">
<div class="col-sm">
<form class="needs-validation" method="post" name="changepassword" novalidate onsubmit="return checkpass();">
                                       
<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">Текущий пароль</label>
<input type="password" class="form-control" id="currentpassword" name="currentpassword" required>
<div class="invalid-feedback">Введите текущий пароль</div>
</div>
</div>

<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">Новый пароль</label>
<input type="password" class="form-control" id="newpassword" name="newpassword" required>
<div class="invalid-feedback">Введите новый пароль</div>
</div>
</div>

<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">Подтвердите пароль</label>
<input type="password" class="form-control" id="confirmpassword" name="confirmpassword" required>
<div class="invalid-feedback">Введите новый пароль</div>
</div>
</div>
                                 
<button class="btn btn-primary" type="submit" name="submit">Изменить</button>
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