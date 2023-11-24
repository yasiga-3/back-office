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
    <title>Sharkfin Ventures - Dashboard</title>
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
    <!-- modernizr css -->
    
</head>

<body>
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
                                    <li class="active"><a href="dashboard.php">Dashboard</a></li>
                                    <li><a href="user_management.php">User Management</a></li>
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
                                    <a class="dropdown-item" href="view_account.php?id=<?php echo $id; ?>" onclick="location.href='view_account.php?id=<?php echo $id; ?>'; return false;"><img class="avatar user-thumb" src="assets/images/authors/avatar.png" alt="avatar"><?php echo $name; ?></a>
                                    <a href="index.php" onclick="location.href='index.php'; return false;" style="margin-left:43px;color:black;">Logout</a>
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
                            <h4 class="page-title pull-left">Dashboard</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="#">Home</a></li>
                                <li><span>Dashboard</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                <!-- sales report area start -->
                <div class="sales-report-area mt-5 mb-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="single-report mb-xs-30">
                                <div class="s-report-inner pr--20 pt--30 mb-3">
                                    <div class="icon"><i class="fa fa-user"></i></div>
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Admins</h4>
                                    </div>
                                    <div class="d-flex justify-content-between pb-2">
                                        <?php 
                                        $query = "select * from users where role_id = 1 or role_id = 2";
                                        $execute = mysqli_query($con,$query);
                                        if($execute){
                                            $count = mysqli_num_rows($execute);
                                        }
                                        ?>
                                        <h2><?php echo $count; ?></h2>
                                    </div>
                                </div>
                                <canvas id="coin_sales1" height="100"></canvas>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-report mb-xs-30">
                                <div class="s-report-inner pr--20 pt--30 mb-3">
                                    <div class="icon"><i class="fa fa-users"></i></div>
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Users</h4>
                                    </div>
                                    <div class="d-flex justify-content-between pb-2">
                                        <?php 
                                        $query = "select * from users where role_id != 1 and role_id != 2";
                                        $execute = mysqli_query($con,$query);
                                        if($execute){
                                            $count = mysqli_num_rows($execute);
                                        }
                                        ?>
                                        <h2><?php echo $count; ?></h2>
                                    </div>
                                </div>
                                <canvas id="coin_sales2" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                    
                <!-- sales report area end -->
            </div>
            <div class="row">
                    <!-- Live Crypto Price area start -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Recent users</h4>
                                <div class="cripto-live mt-5">
                                    <ul>
                                    <?php 
                                    $select = "SELECT id,role_id, first_name, last_name FROM users where role_id != 1 and role_id != 2 ORDER BY id desc limit 10";
                                    $result = mysqli_query($con, $select); // Changed $query to $select here

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $id = $row['id'];
                                        $role_id = $row['role_id'];
                                        $first_name = $row['first_name'];
                                        $first_character = substr($first_name, 0, 1);
                                        $last_name = $row['last_name'];
                                        $name = $first_name . " " . $last_name;
        
                                        $role_select = "SELECT role FROM roles WHERE id ='" . $role_id . "'";
                                        $role_result = mysqli_query($con, $role_select);
        
                                        // Since we expect only one row for each role_id, we can use mysqli_fetch_assoc once here
                                        $roles = mysqli_fetch_assoc($role_result);
                                        $role = $roles['role'];
                                    ?>
                                        <li>
                                            <div class="icon b"><?php echo $first_character; ?></div><a style="color:grey;" href="view_account.php?id=<?php echo $id; ?>" > <?php echo $name; ?></a><span><?php echo $role; ?></span>
                                        </li>
                                    <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Live Crypto Price area end -->
                    
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

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <?php
    $query = "SELECT created_at, COUNT(*) as count FROM users where role_id = 1 or role_id = 2 GROUP BY created_at";
    $result = mysqli_query($con, $query);
    
    // Check if the query was successful
    if ($result) {
        // Fetch the results and store them in an array
        $dateCounts = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $dateCounts[$row['created_at']] = $row['count'];
        }
    
        // Separate dates and counts into arrays
        $dates = array_keys($dateCounts);
        $counts = array_values($dateCounts);
    
        // Convert counts to integers
        $counts = array_map('intval', $counts);
    
        // Convert arrays to JSON format
        $dates = json_encode($dates);
        $counts = json_encode($counts);
    }
    ?>
    <script>
    if ($('#coin_sales1').length) {
    var ctx = document.getElementById("coin_sales1").getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',
        // The data for our dataset
        data: {
            labels: <?php echo $dates; ?>,
            datasets: [{
                label: "Users",
                backgroundColor: "rgba(117, 19, 246, 0.1)",
                borderColor: '#0b76b6',
                data: <?php echo $counts; ?>,
            }]
        },
        // Configuration options go here
        options: {
            legend: {
                display: false
            },
            animation: {
                easing: "easeInOutBack"
            },
            scales: {
                yAxes: [{
                    display: !1,
                    ticks: {
                        fontColor: "rgba(0,0,0,0.5)",
                        fontStyle: "bold",
                        beginAtZero: !0,
                        maxTicksLimit: 5,
                        padding: 0
                    },
                    gridLines: {
                        drawTicks: !1,
                        display: !1
                    }
                }],
                xAxes: [{
                    display: !1,
                    gridLines: {
                        zeroLineColor: "transparent"
                    },
                    ticks: {
                        padding: 0,
                        fontColor: "rgba(0,0,0,0.5)",
                        fontStyle: "bold"
                    }
                }]
            }
        }
    });
}
<?php
    $query = "SELECT created_at, COUNT(*) as count FROM users where role_id != 1 and role_id != 2 GROUP BY created_at";
    $result = mysqli_query($con, $query);
    
    // Check if the query was successful
    if ($result) {
        // Fetch the results and store them in an array
        $dateCounts = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $dateCounts[$row['created_at']] = $row['count'];
        }
    
        // Separate dates and counts into arrays
        $dates = array_keys($dateCounts);
        $counts = array_values($dateCounts);
    
        // Convert counts to integers
        $counts = array_map('intval', $counts);
    
        // Convert arrays to JSON format
        $dates = json_encode($dates);
        $counts = json_encode($counts);
    }
    ?>
if ($('#coin_sales2').length) {
    var ctx = document.getElementById("coin_sales2").getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',
        // The data for our dataset
        data: {
            labels: <?php echo $dates; ?>,
            datasets: [{
                label: "Users",
                backgroundColor: "rgba(117, 19, 246, 0.1)",
                borderColor: '#0b76b6',
                data: <?php echo $counts; ?>,
            }]
        },
        // Configuration options go here
        options: {
            legend: {
                display: false
            },
            animation: {
                easing: "easeInOutBack"
            },
            scales: {
                yAxes: [{
                    display: !1,
                    ticks: {
                        fontColor: "rgba(0,0,0,0.5)",
                        fontStyle: "bold",
                        beginAtZero: !0,
                        maxTicksLimit: 5,
                        padding: 0
                    },
                    gridLines: {
                        drawTicks: !1,
                        display: !1
                    }
                }],
                xAxes: [{
                    display: !1,
                    gridLines: {
                        zeroLineColor: "transparent"
                    },
                    ticks: {
                        padding: 0,
                        fontColor: "rgba(0,0,0,0.5)",
                        fontStyle: "bold"
                    }
                }]
            }
        }
    });
}
</script>
    <script src="assets/js/scripts.js"></script>
</body>
</html>
