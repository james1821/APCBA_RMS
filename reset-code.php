<?php require_once "fp-process.php"; ?>
<?php 
$email = $_SESSION['email'];
if($email == false){
  header('Location: login.php');
}

?>
<!DOCTYPE html>

<head>
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
                            <Center><h2>Password Reset</h2></Center>
                              
							<form action="reset-code.php" method="POST" autocomplete="off">
                    <h2 class="text-center">Code Verification</h2>
                    <?php 
                    if(isset($_SESSION['info'])){
                       
                        ?>
                        

                        <div class="alert alert-success text-center" style="padding: 0.4rem 0.4rem">
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
                        <input class="form-control" type="number" name="otp" placeholder="Enter code" required>
                    </div>
                    <div class="button">
                                        <Center><button name="check-reset-otp" class="btn">Submit</button></Center>
                                    </div>
                  
                </form>
                            
                               
                        
                        </div>
                    </div>
                </div>
              
            </div>
       
        </section>
       
        <script src="assets/js/jquery-1.12.4.min.js"></script>
     
        <script src="assets/css/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>