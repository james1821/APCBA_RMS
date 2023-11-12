<?php require_once "fp-process.php"; ?>
<?php 
	require 'validation.php';
$email = $_SESSION['email'];

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
   
}

if (isset($_SESSION['otp']) && isset($_SESSION['otpfrompost'])) {
    $onetime = $_SESSION['otp'];
    $otpfrompost = $_SESSION['otpfrompost'];

    if ($onetime != $otpfrompost) {
        header('Location: login.php');
    }
} else {
    header('Location: reset-code.php');

}


?>
<!DOCTYPE html>
<html lang="en">

    <head>
    <title>Create a New Password</title>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Reset your Password</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/layout.css">
        <link rel="stylesheet" href="assets/css/form-design.css">
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">  
</head>

</html>


<body class="wrapper">
        
        <!--Start area-->
        <section class="area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="form-area login-form">
                           
                            <div class="form-content">
                            <Center><h2>Record Management System</h2></Center> 

                            <div class ="LOGO">

                            <Center><img src="img/school.png"  width="200" 
                              height="200"></Center>
                              
                                            </div>
                                           
                             </div>
                            <div class="form-input">
                           
                              
                            <form action="new-password.php" method="POST" autocomplete="off">
                    <h2 class="text-center">Enter a New Password</h2>
                    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Create new password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="cpassword" placeholder="Confirm your password" required>
                    </div>
                    <div class="button">
                        <input class="btn" type="submit" name="change-password" value="Change">
                    </div>
                </form>

                            
          

                            </div>
                        
                        </div>
                    </div>
                </div>
              
            </div>
       
        </section><!--End area-->
        <!-- jquery  -->
        <script src="assets/js/jquery-1.12.4.min.js"></script>
        <!-- Bootstrap js  -->
        <script src="assets/css/bootstrap/js/bootstrap.min.js"></script>
    </body>