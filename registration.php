<?php
session_start();
ob_start();
include_once('con.php');
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sharkfin ventures - User registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script language="JavaScript" src="https://code.jquery.com/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6Ld19s8mAAAAAHQvJaDoVXPFx7D9sUw3sKFMKywR"></script>
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
    <!-- main wrapper start -->
    <div class="horizontal-main-wrapper">
        <!-- header area start -->
      <?php if(!isset($_SESSION['id'])){ ?>
        
            <div class="text-center">
                <img src="logo.jpg" style="width: 100px; height: 100px; border-radius: 30px; margin-top: 15px;" class="mx-auto" />
            </div>
<?php } ?>
        <!-- header area end -->
    
        <!-- page title area end -->
        <?php if (isset($_SESSION['success_message'])): ?>
                <div id="msg" style="margin-top:2%;margin-bottom:-2%;" class="alert alert-success">
                    <?php echo $_SESSION['success_message']; ?>
                </div>
                <script>
                    $("#msg").fadeOut(3000);
                </script>
        <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>
        <h2 style="text-align:center;margin-top:2%;margin-bottom:-1.5%;">Sharkfin Ventures New Signup!</h2>
        <div class="main-content-inner" style="width:78%;margin-left:11%;">
            <div class="row">
                <!-- data table start -->
                <div class="col-12">
                        <div class="row">
                            <!-- Textual inputs start -->
                            <div class="col-12 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                    <form role="form" action="registration.php" method="post" enctype="multipart/form-data">  
                                        <input type="hidden" id="g-token" name="g-token" />
                                        <div class="row">
    			                            <div class="col-xs-12 col-sm-6 col-md-6">
					                            <div class="form-group">
					                                <label class="col-form-label">First name</label>
                                                    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="first name" tabindex="1" required>
					                            </div>
				                            </div>
				                            <div class="col-xs-12 col-sm-6 col-md-6">
					                            <div class="form-group">
					                                <label class="col-form-label">Last name</label>
						                            <input type="text" name="last_name" id="last_name" class="form-control " placeholder="last name" tabindex="2" required>
					                            </div>
				                            </div>
			                            </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Email</label>
				                            <input type="email" name="email" id="email" class="form-control " placeholder="name@example.com" onInput="checkUseremail()" tabindex="3" required>
			                                <div id="avalability_email"></div>
			                            </div>
			                            <div class="row">
			                	            <div class="col-xs-12 col-sm-6 col-md-6">
					                            <div class="form-group">
					                                <label class="col-form-label">Phone</label>
						                            <input type="tel" name="phone" id="phone" class="form-control " placeholder="9876543210" pattern="[0-9]{10}" tabindex="5" required>
					                            </div>
				                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6">
					                            <div class="form-group">
					                                <label class="col-form-label">Date of birth</label>
						                            <input type="date" name="dob" id="dob" class="form-control " tabindex="6" required>
					                            </div>
				                            </div>
                                        </div>      
                                        <div class="form-group">
                                            <label class="col-form-label">Address</label>
				                            <input type="text" name="address" id="address" class="form-control " placeholder="address lane" tabindex="7" required>
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
                                                        <option value="<?php echo $row['id'];?>"><?php echo $row['country'];?></option>
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
                                                        <option>State</option>
                                                        <!-- States options will be dynamically added here -->
                                                    </select>
                                                </div>
				                            </div>
                                        </div>  
                                        <div class="row">
				                            <div class="col-xs-12 col-sm-6 col-md-6">
					                            <div class="form-group">
					                                <label class="col-form-label">City</label>
						                            <input type="text" name="city" id="city" class="form-control " placeholder="city"  tabindex="10" required>
					                            </div>
				                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6">
					                            <div class="form-group">
					                                <label class="col-form-label">Zip code</label>
						                            <input type="number" name="zipcode" id="zipcode" class="form-control" placeholder="zip code" tabindex="11" required>
					                            </div>
				                            </div>
                                        </div>
                                        <div class="row">
				                            <div class="col-xs-12 col-sm-6 col-md-6">
					                            <div class="form-group">
					                                <label class="col-form-label">Account no</label>
						                            <input type="number" name="account_no" id="account_no" class="form-control" placeholder="account no"  tabindex="12" required>
					                            </div>
				                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6">
					                            <div class="form-group">
					                                <label class="col-form-label">Capital</label>
						                            <input type="number" name="capital_amount" id="capital_amount" class="form-control" placeholder="capital amount" tabindex="13" required>
					                            </div>
				                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Proof</label>
				                            <input type="file" name="proof" id="proof" accept=".jpg, .jpeg" class="form-control" tabindex="14" required>
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
                                            <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                                        <?php }  ?>
                                        </select>
			                        </div>
			                        </div>
			                        <div class="col-xs-12 col-sm-6 col-md-6">
			                            <label tabindex="17">Applicable for PLB</label>
			                           <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="plb_yes" value="yes" name="plb" class="custom-control-input">
                                                <label class="custom-control-label" for="plb_yes">Yes</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="plb_no" value="no" name="plb" class="custom-control-input">
                                            <label class="custom-control-label" for="plb_no">No</label>
                                        </div>
			                        </div>
			                        </div>
			                        <div class="form-group">
			                            <label class="col-form-label">Note</label>
			                            <textarea id="note" name="note" rows="4" class="form-control" placeholder="Note" tabindex="17" required></textarea>
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
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6Ld19s8mAAAAAHQvJaDoVXPFx7D9sUw3sKFMKywR', {action: 'homepage'}).then(function(token) {
		        document.getElementById("g-token").value = token;
            });
        });
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
        function populateStates(country){
            $.ajax({
                url: "get_state.php",
                data:{country: country},
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
                populateStates("186"); // Populate the states dropdown for US
            } else if (countryDropdown.value === "77") {
                stateDropdown.style.display = "block";
                singleTextBox.style.display = "none";
                populateStates("77"); // Populate the states dropdown for India
            } else {
                stateDropdown.style.display = "none";
                singleTextBox.style.display = "block";
            }
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
function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
if(isset($_POST) && isset($_POST["submit"]))
{
	$secretKey 	= '6Ld19s8mAAAAAC_THo5X5eSLE7zQUhOvSsDUWVzP';
	$token 		= $_POST["g-token"];
	$ip			= $_SERVER['REMOTE_ADDR'];
	
	$url = "https://www.google.com/recaptcha/api/siteverify";
	$data = array('secret' => $secretKey, 'response' => $token, 'remoteip'=> $ip);
 
	// use key 'http' even if you send the request to https://...
	$options = array('http' => array(
		'method'  => 'POST',
		'content' => http_build_query($data)
	));
	$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $responseData = json_decode($response);
	if($responseData && $responseData->success){
	    $captcha_success = true;
	    $first_name = $_POST['first_name'];
	    $last_name = $_POST['last_name'];
	    $email = $_POST['email'];
	    $password = randomPassword();
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
    $plb = $_POST['plb'];
    $note = $_POST['note'];
    $status = $_POST['status'];
    
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
    
	    if(!isset($_POST['role'])){
		    $query = "select id from roles where role='user'";
		    $execute = mysqli_query($con, $query);
		    while($row = mysqli_fetch_assoc($execute)){
			    $role_id = $row['id'];
		    }
		    
		    $query = "select id from status where status='To approve'";
		    $execute = mysqli_query($con, $query);
		    while($row = mysqli_fetch_assoc($execute)){
			    $status_id = $row['id'];
		    }
		    
	    }
	    $query = "select country from countries where id = '".$country_id."'";
	    $execute = mysqli_query($con, $query);
	    while($row=mysqli_fetch_assoc($execute)){
	        $country = $row['country'];
	    }
	    
	    if($captcha_success){
	        $query = "insert into users (role_id, first_name, last_name, email, password, phone, dob, address, city, state, country, zip_code, account_no, capital_amount, proof, scheme_id, PLB, note, status_id, created_at) values('".$role_id."', '".$first_name."', '".$last_name."', '".$email."', '".$password."', '".$phone."', '".$dob."','".$address."', '".$city."', '".$state."', '".$country."', '".$zipcode."', '".$account_no."', '".$capital_amount."', '".$target_file."', '".$scheme_id."', '".$plb."', '".$note."', '".$status_id."', NOW())";
	        $execute = mysqli_query($con, $query);

	        if($execute){
		       if(isset($_SESSION['id'])){
                    $_SESSION['success_message'] = 'Success! User added successfully.';
			        header('Location:user_management.php');
		        }else{
		            $_SESSION['success_message'] = 'Success! User added successfully.';
		            header('Location:registration.php');
		        }
	        }else{
		        echo "check";
	        }
	    }
    }
	else
	{
		$_SESSION['success_message'] = 'Captcha failed try again';
	}    
}
?>