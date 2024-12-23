<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['login']))
  {
    $adminuser=$_POST['username'];
    $password=md5($_POST['password']);
    $query=mysqli_query($con,"select ID from tbladmin where  UserName='$adminuser' && Password='$password' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['aid']=$ret['ID'];
     header('location:add-category.php');
    }
    else{
     echo "<script>alert('Попробуйте еще раз');</script>";
   echo "<script>window.location.href='dashboard.php'</script>";
    }
  }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Диплом</title>
    <meta name="description" content="A responsive bootstrap 4 admin dashboard template" />

    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    
   
    <div class="hk-wrapper">

        <div class="hk-pg-wrapper hk-auth-wrapper">
            <header class="d-flex justify-content-between align-items-center">
               
            </header>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-5 pa-0">
                        <div id="owl_demo_1" class="owl-carousel dots-on-item owl-theme">
                            <div class="fadeOut item auth-cover-img overlay-wrap" style="background-image:url(dist/img/banner2.jpg);">
                                <div class="auth-cover-info py-xl-0 pt-100 pb-50">
                                    <div class="auth-cover-content text-center w-xxl-75 w-sm-90 w-xs-100">
                                       
                                    </div>
                                </div>
                                <div class="bg-overlay bg-trans-dark-20"></div>
                            </div>
                            <div class="fadeOut item auth-cover-img overlay-wrap" style="background-image:url(dist/img/banner1.jpg);">
                                <div class="auth-cover-info py-xl-0 pt-100 pb-50">
                                    <div class="auth-cover-content text-center w-xxl-75 w-sm-90 w-xs-100">
                                      
                                    </div>
                                </div>
                                <div class="bg-overlay bg-trans-dark-20"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 pa-0">
                        <div class="auth-form-wrap py-xl-0 py-50">
     <div class="auth-form w-xxl-55 w-xl-75 w-sm-90 w-xs-100">
                                <form method="post">

<div class="form-group">
<input class="form-control" placeholder="Логин" type="text" name="username" required="true">
</div>

<div class="form-group">
<div class="input-group">
<input class="form-control" placeholder="Пароль" type="password" name="password" required="true">
<div class="input-group-append">
<span class="input-group-text"><span class="feather-icon"><i data-feather="eye-off"></i></span></span>
</div>
</div>
</div>
                              
<button class="btn btn-warning btn-block" type="submit" name="login">Войти</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/popper.js/dist/umd/popper.min.js"></script>
<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="dist/js/jquery.slimscroll.js"></script>
<script src="dist/js/dropdown-bootstrap-extended.js"></script>
<script src="vendors/owl.carousel/dist/owl.carousel.min.js"></script>
<script src="dist/js/feather.min.js"></script>
<script src="dist/js/init.js"></script>
<script src="dist/js/login-data.js"></script>

</body>

</html>