<?php

require_once "fp-process.php";
?>
<!doctype html>
<html lang="en">
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
                              
							
                                <form name="reg" action="forgot-password.php" method="POST">
                               
                                <?php
                        if(count($errors) > 0){
                            ?>
                            <div class="alert alert-danger text-center">
                                <?php 
                                    foreach($errors as $error){
                                        echo $error;
                                    }
                                ?>
                            </div>
                            <?php
                        }
                    ?>
                                 
                            
                                    <div  class="form-group">
                               
										<input type="email" name="email" id="email"  value="" required>
                                        <label >Enter your email</label>
                                    </div>
                                   
                                   
                               
                                    <div class="button">
                                        <Center><button name="check-email" class="btn">Reset Password</button></Center>
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
</html>