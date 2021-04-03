<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
    header('location:index.php');
else
{
    if( $_GET['disid'])
    {
        $id=intval($_GET['disid']);
        $query=mysqli_query($con,"update tblposts set Is_Active='0' where id='$id'");
        $msg="Post unapprove ";
    }
    // Code for restore
    if($_GET['appid'])
    {
        $id=intval($_GET['appid']);
        $query=mysqli_query($con,"update tblposts set Is_Active='1' where id='$id'");
        $msg="Post approved";
    }

    // Code for deletion
    if($_GET['action']=='del' && $_GET['rid'])
    {
        $id=intval($_GET['rid']);
        $query=mysqli_query($con,"delete from  tblposts  where id='$id'");
        $delmsg="Post deleted forever";
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>NewsBuzz | Manage Post</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
        <script src="assets/js/modernizr.min.js"></script>
    </head>
    <body class="fixed-left">
        <!-- Begin page -->
        <div id="wrapper">
            <!-- Top Bar Start -->
<?php include('includes/topheader.php');?>
            <!-- ========== Left Sidebar Start ========== -->
<?php include('includes/leftsidebar.php');?>
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
                                    <h4 class="page-title">Manage Unapproved Posts</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li> <a href="#">Admin</a> </li>
                                        <li> <a href="#">Posts </a> </li>
                                        <li class="active"> Unapprove Posts </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->
                        <div class="row">
                            <div class="col-sm-6">  
                            <?php if($msg){ ?>
                                <div class="alert alert-success" role="alert">
                                    <strong>Well done!</strong> <?php echo htmlentities($msg);?>
                                </div>
                            <?php } ?>
                            <?php if($delmsg){ ?>
                                <div class="alert alert-danger" role="alert">
                                    <strong>Oh snap!</strong> <?php echo htmlentities($delmsg);?></div>
                                <?php } ?>
                                </div>
                                <div class="row">
									<div class="col-md-12">
									    <div class="demo-box m-t-20">
											<div class="table-responsive">
                                                <table class="table m-0 table-colored-bordered table-bordered-primary">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>PostTitle</th>
                                                            <th width="300">PostDetails</th>
                                                            <th>PostingDate</th>
                                                            <th>Status</th>
                                                            <th>Post / News</th>
                                                            <th>Posting Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php 
                                                        $query=mysqli_query($con,"Select id,PostTitle,PostDetails,PostingDate,Is_Active from tblposts where Is_Active=0");
                                                        $cnt=1;
                                                        while($row=mysqli_fetch_array($query)){ ?>
                                                            <tr>
                                                                <th scope="row"><?php echo htmlentities($cnt);?></th>
                                                                <td><?php echo htmlentities($row['PostTitle']);?></td>
                                                                <td><?php echo htmlentities($row['PostDetails']);?></td>
                                                                <td><?php echo htmlentities($row['PostingDate']);?></td>
                                                                <td><?php $st=$row['Is_Active'];
                                                                    if($st=='0'):
                                                                        echo "Wating for approval";
                                                                    else:
                                                                        echo "Approved";
                                                                    endif;
                                                                    ?> </td>
                                                                <td><a href="edit-post.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['PostTitle']);?></a> </td>
                                                                <td><?php echo htmlentities($row['PostingDate']);?></td>
                                                                <td>
                                                                <?php if($st=='1'):?>
                                                                    <a href="unapprove-post.php?disid=<?php echo htmlentities($row['id']);?>" title="Disapprove this Post"><i class="ion-arrow-return-right" style="color: #29b6f6;"></i></a> 
                                                                <?php else :?>
                                                                    <a href="unapprove-post.php?appid=<?php echo htmlentities($row['id']);?>" title="Approve this Post"><i class="ion-arrow-return-right" style="color: #29b6f6;"></i></a> 
                                                                <?php endif;?>
                                                                    &nbsp;<a href="unapprove-post.php?rid=<?php echo htmlentities($row['id']);?>&&action=del"> <i class="fa fa-trash-o" style="color: #f05050"></i></a> </td>
                                                            </tr>
                                                                <?php $cnt++;
                                                        } ?>
                                                    </tbody>
                                                </table>
                                            </div>
    									</div>
									</div>
    							</div>  <!--- end row -->                            
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="demo-box m-t-20">
                                            <div class="m-b-30">
                                            </div>  
                                        </div>
									</div>
								</div>                  
                    </div> <!-- container -->
                </div> <!-- content -->
<?php include('includes/footer.php');?>
            </div>
        </div>
        <!-- END wrapper -->
        <script>
            var resizefunc = [];
        </script>
        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="../plugins/switchery/switchery.min.js"></script>
        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
    </body>
</html>
<?php } ?>