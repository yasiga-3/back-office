<?php
session_start();
if(isset($_SESSION['id'])){
   session_unset();
   session_destroy();
}
ob_start();
include_once('con.php');
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sharkfin ventures - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
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
    <!-- login area start -->
    <div class="login-area login-s2">
        <div class="container">
            <div class="login-box ptb--100">
                <form method="post" action="index.php">
                    <div class="login-form-head">
                        <img src="logo.jpg" style="width:100px;height:100px;margin-bottom:15px;"/>
                        <?php if (isset($_SESSION['success_message'])): ?>
                            <div id="msg" style="margin-top:2%;" class="alert alert-danger">
                                <?php echo $_SESSION['success_message']; ?>
                            </div>
                            <script>
                                $("#msg").fadeOut(3000);
                            </script>
                            <?php unset($_SESSION['success_message']); ?>
                        <?php endif; ?>
                        <h4>Sign In</h4>
                        <p>Hello there, Sign in and start managing your Admin Dashboard</p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" id="exampleInputEmail1" required>
                            <i class="ti-email"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" id="exampleInputPassword1" required>
                            <i class="ti-lock"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" name="submit" type="submit">Submit <i class="ti-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
    
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>
</html>
<?php
if(isset($_POST) && isset($_POST["submit"]))
{
		$email = $_POST['email'];
        $password = $_POST['password'];
        $query = "select email,password from users where email = '".$email."' and password = '".$password."' and role_id=1";
        $execute = mysqli_query($con, $query);
        while($row = mysqli_fetch_assoc($execute)){
            $check_email = $row['email'];
            $check_password = $row['password'];
        }
        if($email == $check_email){
            if($password == $check_password){
              $_SESSION['id'] = $email;
              header('Location:dashboard.php');
            }else{
                $_SESSION['success_message'] = 'Usermail or password is wrong.Check and try again';
                header('Location:index.php');
            }
            }else{
                $_SESSION['success_message'] = 'Usermail or password is wrong.Check and try again';
                header('Location:index.php');
            }
}
?>