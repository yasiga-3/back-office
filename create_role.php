<?php
session_start();
if(!isset($_SESSION['id'])){
  header('Location:index.php');
}
ob_start();
include_once('con.php');
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sharkfin ventures - Add role</title>
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
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Home</span></a>
                                <ul class="collapse">
                                    <li><a href="dashboard.php">Dashboard</a></li>
                                    <li><a href="user_management.php">User Management</a></li>
                                </ul>
                            </li>
                            <li class="active">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i><span>Settings</span></a>
                                <ul class="collapse">
                                    <li class="active"><a href="roles_list.php">Roles</a></li>
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
                                    <a class="dropdown-item" href="view_account.php?id=<?php echo $id; ?>" onclick="location.href='view_account.php?id=<?php echo $id; ?>'; return false;"><img class="avatar user-thumb" src="assets/images/authors/avatar.png" alt="avatar"><?php echo $name; ?></a>
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
                <div class="row align-items-center" >
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix" style="padding: 10px;">
                            <h4 class="page-title pull-left">Add Role</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="user_management.php">Role List</a></li>
                                <li><span>Add Role</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            
            <!-- page title area end -->
        <!-- page title area end -->
        <div class="main-content-inner" style="width:78%;margin-left:11%;">
            <div class="row">
                <!-- data table start -->
                <div class="col-lg-6 col-ml-12">
                        <div class="row">
                            <!-- Textual inputs start -->
                            <div class="col-12 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                        <form role="form" action="create_role.php" method="post">
			                                <div class="form-group">
			                                    <label class="col-form-label">Role name</label>
				                                <input type="text" name="role" id="role" class="form-control " placeholder="role name" tabindex="1" required>
			                                </div>
                                            <div class="form-group">
                                                <label class="col-form-label">Status</label>
				                                <select type="text" name="status" id="status" class="custom-select" placeholder="status" tabindex="2" required>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
			                                </div>                              
                                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
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
    <!-- offset area start -->
    
    
    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
   
    
    <script src="assets/js/scripts.js"></script>
</body>
</html>
<?php
if(isset($_POST['submit'])){
	$role = $_POST['role'];
	$status = $_POST['status'];

	$query = "insert into roles (role, status, created_at) values('".$role."', '".$status."', NOW())";
	$execute = mysqli_query($con, $query);

	if($execute){
		if(isset($_SESSION['id'])){
            $_SESSION['success_message'] = 'Success! Role added successfully.';
			header('Location:roles_list.php');
		}
	}else{
		echo "check the query";
	}
}
?>