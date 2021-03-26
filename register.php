<?php
session_start();
//Database Configuration File
include('includes/config.php');
//error_reporting(0);
if(isset($_POST['signup']))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $uname=$_POST['username'];
    $password=$_POST['password'];
    $status = 1;
    $sql=mysqli_query($con,"SELECT username FROM users WHERE username='$uname'");
    $num=mysqli_fetch_array($sql);
    if($num>0) {
        echo "<script>alert('Username already registered with us');</script>";
		echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
    }else{
        $query=mysqli_query($con,"INSERT into users(name,username,password,email,contact_no,status)
        values('$name','$uname','$password','$email','$phone','$status')");
        if($query){
            echo "<script>alert('User Successfully Registered!');</script>";
            echo "<script type='text/javascript'> document.location = 'login.php'; </script>";   
        }
        else{
            echo "<script>alert('Something Went Wrong! Try Again');</script>";
            echo "<script type='text/javascript'> document.location = 'register.php'; </script>"; 
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="News Portal.">
    <meta name="author" content="PHPGurukul">
    <!-- App title -->
    <title>NewsBuzz | Create Account</title>
    <!-- App css -->
    <link href="admin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="admin/assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="admin/assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="admin/assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="admin/assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="admin/assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="admin/assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <script src="admin/assets/js/modernizr.min.js"></script>
    <style>
    .logo {
        color: #ffffff !important;
        font-size: 24px;
        text-transform: uppercase;
        font-family: 'Hind Madurai', sans-serif;
        font-weight: 600;
        letter-spacing: 1px;
        line-height: 40px;
    }

    a {
        color: #337ab7;
        text-decoration: none;
    }
    </style>
</head>

<body class="bg-transparent">
    <!-- HOME -->
    <section>
        <div class="container-alt">
            <div class="row">
                <div class="col-sm-12">
                    <div class="wrapper-page">
                        <div class="m-t-40 account-pages">
                            <div class="text-center account-logo-box">
                                <h2 class="text-uppercase">
                                    <a href="index.html" class="text-success">
                                        <a href="#" class="logo"><span>NEWS<span>BUZZ</span></span><i
                                                class="mdi mdi-layers"></i></a>
                                    </a>
                                </h2>
                            </div>
                            <div class="account-content">
                                <form class="form-horizontal" method="post">
                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <input class="form-control" type="text" required="" name="name"
                                                placeholder="Full Name" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <input class="form-control" type="text" required="" name="email"
                                                placeholder="Email" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <input class="form-control" type="text" required="" name="phone"
                                                placeholder="Contact No" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <input class="form-control" type="text" required="" name="username"
                                                placeholder="Username or email" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input class="form-control" type="password" name="password" required=""
                                                placeholder="Password" autocomplete="off">
                                        </div>
                                    </div>
                                    <a href="login.php">Already Have an Account?</a>
                                    <div class="form-group account-btn text-center m-t-10">
                                        <div class="col-xs-12">
                                            <button class="btn w-md btn-bordered btn-danger waves-effect waves-light"
                                                type="submit" name="signup">Sign Up</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <!-- end card-box-->
                    </div>
                    <!-- end wrapper -->
                </div>
            </div>
        </div>
    </section>
    <!-- END HOME -->
    <script>
    var resizefunc = [];
    </script>
    <!-- jQuery  -->
    <script src="admin/assets/js/jquery.min.js"></script>
    <script src="admin/assets/js/bootstrap.min.js"></script>
    <script src="admin/assets/js/detect.js"></script>
    <script src="admin/assets/js/fastclick.js"></script>
    <script src="admin/assets/js/jquery.blockUI.js"></script>
    <script src="admin/assets/js/waves.js"></script>
    <script src="admin/assets/js/jquery.slimscroll.js"></script>
    <script src="admin/assets/js/jquery.scrollTo.min.js"></script>
    <!-- App js -->
    <script src="admin/assets/js/jquery.core.js"></script>
    <script src="admin/assets/js/jquery.app.js"></script>

</body>

</html>