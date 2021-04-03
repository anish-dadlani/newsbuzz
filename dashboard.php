<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
    header('location:index.php');
else
{ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">
    <!-- App title -->
    <title>NewsBuzz | Dashboard</title>
    <link rel="stylesheet" href="../plugins/morris/morris.css">
    <!-- App css -->
    <link href="admin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="admin/assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="admin/assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="admin/assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="admin/assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="admin/assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="admin/assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
    <script src="admin/assets/js/modernizr.min.js"></script>
</head>

<body class="fixed-left">
    <!-- Begin page -->
    <div id="wrapper">
        <div class="topbar">
            <!-- Top Bar Start -->
            <div class="topbar-left">
                <!-- LOGO -->
                <a href="index.php" class="logo"><span>NewsBuzz<span>User</span></span><i
                        class="mdi mdi-layers"></i></a>
            </div>
            <!-- Button mobile view to collapse sidebar menu -->
            <?php include('includes/includes/topheader.php');?>
        </div>
        <!-- Top Bar End -->
        <!-- ========== Left Sidebar Start ========== --> <?php include('includes/includes/leftsidebar.php');?>
        <!-- Left Sidebar End -->
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Dashboard</h4>
                                <ol class="breadcrumb p-0 m-0">
                                    <li> <a href="index.php">NEWSBuzz</a> </li>
                                    <li> <a href="#">User</a> </li>
                                    <li class="active"> Dashboard </li>
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="row">
                        <a href="manage-post.php">
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="card-box widget-box-one">
                                    <i class="mdi mdi-chart-areaspline widget-one-icon"></i>
                                    <div class="wigdet-one-content">
                                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow"
                                            title="Statistics">Posts Created</p>
                                        <?php $id=$_SESSION['user_id']; $username=$_SESSION['login'];
                                        $query=mysqli_query($con,"select * from tblposts where Is_Active=1 AND created_by='$id' and created_by_user='$username'");
                                                    $countcat=mysqli_num_rows($query); ?>
                                        <h2><?php echo htmlentities($countcat);?> <small></small></h2>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- end row -->
                </div> <!-- container -->
            </div> <!-- content -->
            <?php include('includes/includes/footer.php');?>
        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <div class="side-bar right-bar">
            <a href="javascript:void(0);" class="right-bar-toggle">
                <i class="mdi mdi-close-circle-outline"></i>
            </a>
            <h4 class="">Settings</h4>
            <div class="setting-list nicescroll">
                <div class="row m-t-20">
                    <div class="col-xs-8">
                        <h5 class="m-0">Notifications</h5>
                        <p class="text-muted m-b-0"><small>Do you need them?</small></p>
                    </div>
                    <div class="col-xs-4 text-right">
                        <input type="checkbox" checked data-plugin="switchery" data-color="#7fc1fc" data-size="small" />
                    </div>
                </div>
                <div class="row m-t-20">
                    <div class="col-xs-8">
                        <h5 class="m-0">API Access</h5>
                        <p class="m-b-0 text-muted"><small>Enable/Disable access</small></p>
                    </div>
                    <div class="col-xs-4 text-right">
                        <input type="checkbox" checked data-plugin="switchery" data-color="#7fc1fc" data-size="small" />
                    </div>
                </div>
                <div class="row m-t-20">
                    <div class="col-xs-8">
                        <h5 class="m-0">Auto Updates</h5>
                        <p class="m-b-0 text-muted"><small>Keep up to date</small></p>
                    </div>
                    <div class="col-xs-4 text-right">
                        <input type="checkbox" checked data-plugin="switchery" data-color="#7fc1fc" data-size="small" />
                    </div>
                </div>
                <div class="row m-t-20">
                    <div class="col-xs-8">
                        <h5 class="m-0">Online Status</h5>
                        <p class="m-b-0 text-muted"><small>Show your status to all</small></p>
                    </div>
                    <div class="col-xs-4 text-right">
                        <input type="checkbox" checked data-plugin="switchery" data-color="#7fc1fc" data-size="small" />
                    </div>
                </div>
            </div>
        </div>
        <!-- /Right-bar -->
    </div>
    <!-- END wrapper -->
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
    <script src="admin/../plugins/switchery/switchery.min.js"></script>
    <!-- Counter js  -->
    <script src="admin/../plugins/waypoints/jquery.waypoints.min.js"></script>
    <script src="admin/../plugins/counterup/jquery.counterup.min.js"></script>
    <!--Morris Chart-->
    <script src="admin/../plugins/morris/morris.min.js"></script>
    <script src="admin/../plugins/raphael/raphael-min.js"></script>
    <!-- Dashboard init -->
    <script src="admin/assets/pages/jquery.dashboard.js"></script>
    <!-- App js -->
    <script src="admin/assets/js/jquery.core.js"></script>
    <script src="admin/assets/js/jquery.app.js"></script>
</body>

</html>
<?php } ?>