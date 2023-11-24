<?php
session_start();
ob_start();
if(!isset($_SESSION['id'])){
    header('Location:index.php');
}
include_once('con.php');
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sharkfin ventures - User Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
   
    <!-- Start datatable css -->
    <script language="JavaScript" src="https://code.jquery.com/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script language="JavaScript" src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script language="JavaScript" src="https://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <style>
       body{
           overflow-x: hidden;
       }
       .icon-link {
            position: relative;
            display: inline-block;
        }

        .icon-link i.fa-lock {
            position: absolute;
            top: 6px;
            left: 5px;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#datatable').dataTable();
        } );
    </script>
</head>

<body class="body-bg">
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="dashboard.php"><img src="logo.jpg" style="width:130px;height:90px;border-radius:15px;" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li class="active">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Home</span></a>
                                <ul class="collapse">
                                    <li><a href="dashboard.php">Dashboard</a></li>
                                    <li class="active"><a href="user_management.php">User Management</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i><span>Settings</span></a>
                                <ul class="collapse">
                                    <li><a href="roles_list.php">Roles</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-black-tie"></i><span>Scheme</span></a>
                                <ul class="collapse">
                                    <li><a href="scheme_list.php">Schemes</a></li>
                                    <li><a href="add_scheme.php"><span>Add Scheme</span></a></li>
                                </ul>
                            </li>
                            <li><a href="index.php"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>     
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left" style="display:none;">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <!--<div class="search-box pull-left">
                            <form action="#">
                                <input type="text" name="search" placeholder="Search..." required>
                                <i class="ti-search"></i>
                            </form>
                        </div> -->
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                            <li class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-settings"></i>
                                <?php 
                                $query = "select id,first_name from users where email= '".$_SESSION['id']."'";
                                $execute = mysqli_query($con, $query);
                                while($row = mysqli_fetch_assoc($execute)){
                                    $id = $row['id'];
                                    $name = $row['first_name'];
                                }
                                ?>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" onclick="location.href='view_account.php?id=<?php echo $id; ?>'; return false;"><img class="avatar user-thumb" src="assets/images/authors/avatar.png" alt="avatar"><?php echo $name; ?></a>
                                    <a class="dropdown-item" href="index.php" onclick="location.href='index.php'; return false;" style="margin-left:37px;">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center" style="padding: 10px;">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">User Management</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="#">Home</a></li>
                                <li><span>User Management</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            
            <!-- page title area end -->
        <?php if (isset($_SESSION['success_message'])): ?>
                <div id="msg" style="margin-top:2%;margin-bottom:-2%;" class="alert alert-success">
                    <?php echo $_SESSION['success_message']; ?>
                </div>
                <script>
                    $("#msg").fadeOut(3000);
                </script>
        <?php unset($_SESSION['success_message']); ?>
        <?php endif;   ?>
        <div class="main-content-inner" style="width:78%;margin-left:11%;">
            <div class="row">
                <!-- data table start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Users</h4>
                            <a role="button" type="submit" class="btn btn-primary" href="add_user.php" style="margin-bottom:10px;">Add</a>
                            <div class="data-tables" style="overflow-x: scroll;">
<table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="99%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Role</th>
                                            <th>Account no</th>
                                            <th>Capital Amount</th>
                                            <th>Status</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $query = "select * from users";
                                    $execute = mysqli_query($con,$query);
                                    while($row=mysqli_fetch_assoc($execute)){
                                        $id = $row['id'];
                                        $role_id = $row['role_id'];
                                        $first_name = $row['first_name'];
                                        $last_name = $row['last_name'];
                                        $name = $first_name." ".$last_name;
                                        $email = $row['email'];
                                        $phone = $row['phone'];
                                        $account_no = $row['account_no'];
                                        $capital_amount = $row['capital_amount'];
                                        $status_id = $row['status_id'];
                                        
                                        $status_select = "select status from status where id='".$status_id."'";
                                        $execute_status = mysqli_query($con, $status_select);
                                        while($check_status = mysqli_fetch_assoc($execute_status)){
                                            $status = $check_status['status'];
                                        }
                                        
                                        $role_select = "select role from roles where id='".$role_id."'";
                                        $execute_role = mysqli_query($con, $role_select);
                                        while($check_role = mysqli_fetch_assoc($execute_role)){
                                            $role = $check_role['role'];
                                        }
                                    ?>
                                    <tr>
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo $name; ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td><?php echo $phone; ?></td>
                                        <td><?php echo $role; ?></td>
                                        <td><?php echo $account_no; ?></td>
                                        <td><?php echo $capital_amount; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><a href="edit_user.php?id=<?php echo $id; ?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;<a onclick="return confirm('Are you sure, you want to delete it?')" href="delete_user.php?id=<?php echo $id; ?>"><i class="fa fa-times"></i></a>&nbsp;&nbsp;&nbsp;<a class="icon-link" onclick="return confirm('Are you sure, you want to reset the password?')" href="password_reset.php?id=<?php echo $id; ?>"><i class="fa fa-undo" style="font-size:17px;"></i><i class="fa fa-lock" style="font-size:7px;"></i></a></td>
                                        
                                    </tr> 
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- data table end -->
                
            </div>
        </div>
            

        </div>
        <!-- main content area end -->
        <footer>
            <div class="footer-area">
                <p>All right reserved.</p>
            </div>
        </footer>
    </div>
    <!-- page container area end -->
    
    
    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
<!-- Start datatable js -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
   
    <script src="assets/js/scripts.js"></script>
</body>

</html>
