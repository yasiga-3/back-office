<?php
session_start();
if(!isset($_SESSION['id'])){
  header('Location:index.php');
}
ob_start();
include_once('con.php');
$id = $_GET['id'];
$query = "select * from users where id = '".$id."'";
$execute = mysqli_query($con, $query);
while($row = mysqli_fetch_assoc($execute)){
    $id = $row['id'];
    $role_id = $row['role_id'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $email = $row['email'];
    $phone = $row['phone'];
    $dob = $row['dob'];
    $address = $row['address'];
    $city = $row['city'];
    $state = $row['state'];
    $country = $row['country'];
    $zipcode = $row['zip_code'];
    $account_no = $row['account_no'];
    $capital_amount = $row['capital_amount'];
    $proof = $row['proof'];
    $scheme_id = $row['scheme_id'];
    $PLB = $row['PLB'];
    $note = $row['note'];
    $status_id = $row['status_id'];
}  
$query = "select role from roles where id='".$role_id."'";
$execute = mysqli_query($con, $query);
while($row = mysqli_fetch_assoc($execute)){
    $role = $row['role'];
}
$query = "select status from status where id='".$status_id."'";
$execute = mysqli_query($con, $query);
while($row = mysqli_fetch_assoc($execute)){
    $status = $row['status'];
}
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sharkfin ventures - Edit user</title>
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
    <script language="JavaScript" src="https://code.jquery.com/jquery-1.11.1.min.js" type="text/javascript"></script>
    
    <script>
        function populateStates(country,state){
            $.ajax({
                url: "get_state.php",
                data:{country: country,state: state},
                type: "POST",
                success:function(data){
                    $("#stateDropdownList").html(data);
                },
                error:function (){}
            });
        }
        function toggleStateDropdown() {
            var countryDropdown = document.getElementById("country");
            var stateDropdown = document.getElementById("stateDropdown");
            var singleTextBox = document.getElementById("singleTextBox");

            if (countryDropdown.value === "186") {
                stateDropdown.style.display = "block";
                singleTextBox.style.display = "none";
                var state = "<?php echo"$state"?>";
                populateStates("186",state); // Populate the states dropdown for US
            } else if (countryDropdown.value === "77") {
                stateDropdown.style.display = "block";
                singleTextBox.style.display = "none";
                var state = "<?php echo"$state"?>";
                populateStates("77",state); // Populate the states dropdown for India
            } else {
                stateDropdown.style.display = "none";
                singleTextBox.style.display = "block";
            }
        }
        $(document).ready(function () {
            toggleStateDropdown(); // Call the function to set initial state
        });
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
                            <h4 class="page-title pull-left">Edit User</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="user_management.php">User Management</a></li>
                                <li><span>Edit User</span></li>
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
                                        <form role="form" action="edit_user.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                                            <div class="row">
    			                                <div class="col-xs-12 col-sm-6 col-md-6">
					                                <div class="form-group">
					                                    <label class="col-form-label">First name</label>
                                                        <input type="text" name="first_name" id="first_name" value="<?php echo $first_name; ?>" class="form-control" placeholder="first Name" tabindex="1" required>
					                                </div>
				                                </div>
				                                <div class="col-xs-12 col-sm-6 col-md-6">
					                                <div class="form-group">
					                                    <label class="col-form-label">Last name</label>
						                                <input type="text" name="last_name" id="last_name" value="<?php echo $last_name; ?>" class="form-control " placeholder="last Name" tabindex="2" required>
					                                </div>
				                                </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-form-label">Email</label>
				                                <input type="email" name="email" id="email" class="form-control" value="<?php echo $email; ?>" placeholder="name@example.com" onInput="checkUseremail()" tabindex="3" required>
			                                    <div id="avalability_email"></div>
			                                </div>
			                                <div class="row">
				                                <div class="col-xs-12 col-sm-6 col-md-6">
					                                <div class="form-group">
					                                    <label class="col-form-label">Phone</label>
						                                <input type="tel" name="phone" id="phone" class="form-control" value="<?php echo $phone; ?>" placeholder="9876543210" pattern="[0-9]{10}" tabindex="5" required>
					                                </div>
				                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6">
					                                <div class="form-group">
					                                    <label class="col-form-label">Date of Birth</label>
						                                <input type="date" name="dob" id="dob" value="<?php echo $dob; ?>" class="form-control" tabindex="6" required>
					                                </div>
				                                </div>
                                            </div>      
                                            <div class="form-group">
                                                <label class="col-form-label">Address</label>
				                                <input type="text" name="address" id="address" class="form-control" value="<?php echo $address; ?>" placeholder="address lane" tabindex="7" required>
			                                </div>   
                                            <div class="row">
                                            <div class="col-xs-12 col-sm-6 col-md-6">
					                            <div class="form-group">
					                                <label class="col-form-label">Country</label>
				                                    <select type="text" name="country" id="country" onchange="toggleStateDropdown()" class="custom-select" tabindex="8" required>
                                                        <option>Select a country</option>
                                                    <?php 
                                                        $query = "select id,country from countries";
                                                        $execute = mysqli_query($con, $query);
                                                        while($row = mysqli_fetch_assoc($execute)){
                                                    ?>
                                                        <option value="<?php echo $row['id'];?>" <?php if($row['country'] == $country) echo 'selected="selected"'; ?> ><?php echo $row['country'];?></option>
                                                    <?php }  ?>
                                                    </select>
			                                    </div>
				                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <label class="col-form-label">State</label>
                                                <div class="form-group" id="singleTextBox" style="display: none;">
						                            <input type="text" name="state" id="state" class="form-control " placeholder="state" tabindex="9">
					                            </div>
					                            <div class="form-group" id="stateDropdown" style="display: block;">
                                                    <select id="stateDropdownList" type="text" name="state" class="custom-select" tabindex="9">
                                                        <!-- States options will be dynamically added here -->
                                                    </select>
                                                </div>
				                            </div>
                                        </div>  
                                        <div class="row">
				                            <div class="col-xs-12 col-sm-6 col-md-6">
					                            <div class="form-group">
					                                <label class="col-form-label">City</label>
						                            <input type="text" name="city" id="city" class="form-control" value="<?php echo $city; ?>" placeholder="city"  tabindex="10" required>
					                            </div>
				                            </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
					                        <div class="form-group">
					                            <label class="col-form-label">Zip code</label>
						                        <input type="number" name="zipcode" id="zipcode" value="<?php echo $zipcode; ?>" class="form-control " placeholder="zip code" tabindex="11" required>
					                        </div>
				                        </div>
                                    </div>
                                    <div class="row">
				                        <div class="col-xs-12 col-sm-6 col-md-6">
					                        <div class="form-group">
					                            <label class="col-form-label">Account no</label>
						                        <input type="number" name="account_no" id="account_no" value="<?php echo $account_no; ?>" class="form-control " placeholder="account no"  tabindex="12" required>
					                        </div>
				                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
					                        <div class="form-group">
					                            <label class="col-form-label">Capital</label>
						                        <input type="number" name="capital_amount" id="capital_amount" value="<?php echo $capital_amount; ?>" class="form-control " placeholder="capital amount" tabindex="13" required>
					                        </div>
				                        </div>
                                    </div>
                                    <div class="row">
				                        <div class="col-xs-12 col-sm-6 col-md-6">
			                                <div class="form-group">
			                                    <label>Update proof image</label>
				                                <input type="file" name="proof" id="proof" class="form-control" accept=".jpg, .jpeg" tabindex="14">
				                            </div>
				                        </div>
				                        <div class="col-xs-12 col-sm-6 col-md-6">
				                            <label>Current proof image</label>
			                                <div class="form-group">
			                                    <img src="<?php echo $proof; ?>" alt="Profile Image" width="100"><br>
			                                </div>
			                             </div>
			                        </div>  
			                        <div class="form-group">
			                            <label class="col-form-label">Role</label>
				                        <select type="text" name="role" id="role" class="custom-select"  tabindex="15" required>
                                        <?php 
                                        $query = "select id,role from roles where status='Active'";
                                        $execute = mysqli_query($con, $query);
                                        while($row = mysqli_fetch_assoc($execute)){
                                        ?>
                                            <option value="<?php echo $row['id'];?>" <?php if($row['role'] == $role) echo 'selected="selected"'; ?>><?php echo $row['role'];?></option>
                                        <?php }  ?>
                                        </select>
			                        </div> 
			                        <div class="row">
				                        <div class="col-xs-12 col-sm-6 col-md-6">
			                        <div class="form-group">
			                            <label class="col-form-label">Scheme</label>
				                        <select type="number" name="scheme" id="scheme" class="custom-select"  tabindex="16" required>
                                        <?php 
                                        $query = "select id,name from scheme";
                                        $execute = mysqli_query($con, $query);
                                        while($row = mysqli_fetch_assoc($execute)){
                                        ?>
                                            <option value="<?php echo $row['id'];?>" <?php if($row['id'] == $scheme_id) echo 'selected="selected"'; ?>><?php echo $row['name'];?></option>
                                        <?php }  ?>
                                        </select>
			                        </div>
			                        </div>
			                        <div class="col-xs-12 col-sm-6 col-md-6">
			                            <label tabindex="17">Applicable for PLB</label>
			                           <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="plb_yes" value="yes" name="plb" <?php echo ($PLB =='yes')? 'checked':'' ?> class="custom-control-input">
                                                <label class="custom-control-label" for="plb_yes">Yes</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="plb_no" value="no" name="plb" <?php echo ($PLB =='no')? 'checked':'' ?> class="custom-control-input">
                                            <label class="custom-control-label" for="plb_no">No</label>
                                        </div>
			                        </div>
			                        </div>
			                        <div class="form-group">
			                            <label class="col-form-label">Note</label>
			                            <textarea id="note" name="note" rows="4" class="form-control" placeholder="Note" tabindex="18" required><?php echo $note; ?></textarea>
			                        </div>      
			                        <div class="form-group">
			                            <label class="col-form-label">Status</label>
				                        <select type="number" name="status" id="status" class="custom-select"  tabindex="19" required>
                                        <?php 
                                        $query = "select id,status from status";
                                        $execute = mysqli_query($con, $query);
                                        while($row = mysqli_fetch_assoc($execute)){
                                        ?>
                                            <option value="<?php echo $row['id'];?>" <?php if($row['status'] == $status) echo 'selected="selected"'; ?>><?php echo $row['status'];?></option>
                                        <?php }  ?>
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
    <!-- main wrapper start -->
    <script>
        function checkUseremail() {
            jQuery.ajax({
                url: "email_validation.php",
                data:{email:$("#email").val()},
                type: "POST",
                success:function(data){
                    $("#avalability_email").html(data);
                },
                error:function (){}
            });
        }
    </script>
    
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
    $id = $_POST['id'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$dob = $_POST['dob'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$country_id = $_POST['country'];
	$zipcode = $_POST['zipcode'];
	$account_no = $_POST['account_no'];
	$capital_amount = $_POST['capital_amount'];
	$scheme_id = $_POST['scheme'];
	$PLB = $_POST['plb'];
	$note = $POST['note'];
    $role_id = $_POST['role'];
    $status = $_POST['status'];

    $query = "select country from countries where id = '".$country_id."'";
	$execute = mysqli_query($con, $query);
	while($row=mysqli_fetch_assoc($execute)){
	    $country = $row['country'];
	}
    
    if(basename($_FILES["proof"]["name"])){
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["proof"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an actual image or a fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["proof"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if the file already exists
        if (file_exists($target_file)) {
            echo "Sorry, the file already exists.";
            $uploadOk = 0;
        }

        // Check file size (adjust as per your requirement)
        if ($_FILES["proof"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow only specific file formats (you can add more if needed)
        if ($imageFileType != "jpg" && $imageFileType != "jpeg") {
            echo "Sorry, only JPG, JPEG files are allowed.";
            $uploadOk = 0;
        }
    
        // If everything is OK, save the image to the "uploads" directory
        if ($uploadOk == 1) {
            move_uploaded_file($_FILES["proof"]["tmp_name"], $target_file);
        }
        
        $query = "update users set role_id = '".$role_id."', first_name = '".$first_name."', last_name = '".$last_name."', email = '".$email."', phone = '".$phone."', dob = '".$dob."', address = '".$address."', city = '".$city."', state = '".$state."', country = '".$country."', zip_code = '".$zipcode."', account_no = '".$account_no."', capital_amount = '".$capital_amount."', proof = '".$target_file."', scheme_id = '".$scheme_id."',PLB = '".$PLB."',note = '".$note."', status_id = '".$status."' where id='".$id."'";
	    $execute = mysqli_query($con, $query);
    }else{
        $query = "update users set role_id = '".$role_id."', first_name = '".$first_name."', last_name = '".$last_name."', email = '".$email."', phone = '".$phone."', dob = '".$dob."', address = '".$address."', city = '".$city."', state = '".$state."', country = '".$country."', zip_code = '".$zipcode."', account_no = '".$account_no."', capital_amount = '".$capital_amount."', scheme_id = '".$scheme_id."',PLB = '".$PLB."',note = '".$note."', status_id = '".$status."' where id='".$id."'";
	    $execute = mysqli_query($con, $query);    
    }
    
	if($execute){
		if(isset($_SESSION['id'])){
            $_SESSION['success_message'] = 'Success! User altered successfully.';
			header('Location:user_management.php');
		}
	}else{
		echo $query;
	}
}
?>