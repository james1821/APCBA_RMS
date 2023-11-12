<?php
include('connection.php');

	
$csrf =	$connect->real_escape_string($_POST["csrf"]);


if ($csrf == $_SESSION["token"]) {
    $email	= $connect->real_escape_string($_POST['username']);
	$username	= $connect->real_escape_string($_POST['username']);
	$password	= $connect->real_escape_string($_POST['password']);                                                                 

	
		
		
			
	/* Check Username and Password */
    $query = db_query("SELECT * FROM user WHERE (username='".$username."' OR email='".$email."') AND password='".$password."'");
	

	$resuser = mysqli_num_rows($query);
	if($resuser > 0){
		$row = mysqli_fetch_array($query);
        $_SESSION['id'] 	= $row['user_id'];
		$_SESSION['email'] 	= $row['email'];
		$_SESSION['secret'] = $row['googlecode'];
        $_SESSION['user'] 	= $row['user_id'];
        $_SESSION['status'] = $row['status'];
        $_SESSION['firstname'] = $row['firstname'];
        $_SESSION['mobile'] = $row['mobile'];
        $_SESSION['status'] = $row['status'];
        $_SESSION['gender'] = $row['gender'];
        $_SESSION['Middlename'] = $row['Middlename'];
        $_SESSION['address'] = $row['address'];
        $_SESSION['lastname'] = $row['lastname'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['password'] = $row['password'];

	

		
         header('Location:device_confirmations.php');
		exit();
	}else{
		$msg="Invalid Username or Password";												
		header('Location:login.php?error=1');
		exit();
	}
	
}

/* print message */
$msg = $connect->real_escape_string($_GET["error"]);
if($msg == 1){ $strmsg = "Invalid Username or Password"; }


?>
<!doctype html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login/ Registration Form</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/layout.css">
        <link rel="stylesheet" href="assets/css/form-design.css">
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">  
</head>

    <body class="wrapper">
        
        <!--Start area-->
        <section class="area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="form-area login-form">
                           
                        <Center> <div class="form-content">
                            <h2>Asia Pacific College of Business and Arts</h2>
                           
                            <div class ="LOGO">

                           <img src="img/school.png"  width="200" 
                              height="200">
                              
                                            </div>
                             </div>
                            <div class="form-input">
                          <h2>Record Management System (Demo)</h2>
                              <p><b>Username:</b> UserDemo</p>
                              <p><b>Password: </b>PasswordDemo2023</p>
								<span class="error"><?php print $strmsg; ?></span>
                                <form name="reg" action="login.php" method="POST">
                               

								<input type="hidden" name="csrf" 	 value="<?php print $_SESSION["token"]; ?>" >
								<input type="hidden" name="passcode" value="<?php echo $passcode; ?>" >
                                    <div  class="form-group">
										<input type="text" name="username" id="username"  value="" required>
                                        <label >Username or Email</label>
                                    </div>
                                    <div class="form-group">
										<input type="password" name="password" id="password"  value="" required>
                                        <label>Password</label>
                                    </div>
                                   
                               
                                    <div class="button">
                                        <button name="login" class="btn">Login</button>
                                    </div>
									
									
                                    <a class="forgot" href="forgot-password.php">Forgot Password?</a>
                                </form>
                               
                              
                            </div>
                        
                        </div>
</Center>
                    </div>
                </div>
              
            </div>
       
        </section><!--End area-->
        <!-- jquery  -->
        <script src="assets/js/jquery-1.12.4.min.js"></script>
        <!-- Bootstrap js  -->
        <script src="assets/css/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>