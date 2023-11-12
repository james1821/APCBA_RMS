<?php
	require 'validation.php';
require 'functions.php';
session_start();
require 'conn.php';

include('sidebar.php');
$title = "UPDATE USER PROFILE";
include('navbar.php');

// Assign session variables

?>
 
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update User Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/layout.css">
    <link rel="stylesheet" href="assets/css/form-design.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/register.css">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>

    <div class="row-container update justify-content-center">
        <div class="tab col-md-7 border mx-auto mt-5shadow-lg">
            <div class="row-logo">
                <div class="">
                    <img src="img/school.jpg" alt="">
                </div>
                <div class="">
                    <h1>Update User Profile</h1>
                </div>
            </div>
            <hr style="border-top: 2px solid black; margin: 20px 0;">

            <form id="updateForm" name="reg" action="update-user-process.php" method="POST">
                <!-- Add the user ID input field -->
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="firstname" class="form-label fw-bold">Firstname</label>
                        <div class="input-group">
                            <input value="<?php echo $_SESSION['firstname']; ?>" type="text" class="form-control" name="firstname" placeholder="Firstname" required>
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="Middlename" class="form-label fw-bold">Middlename</label>
                        <div class="input-group">
                            <input value="<?php echo $_SESSION['Middlename']; ?>" type="text" class="form-control" name="Middlename" placeholder="Middlename" required>
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="lastname" class="form-label fw-bold">Lastname</label>
                        <div class="input-group">
                            <input value="<?php echo $_SESSION['lastname']; ?>" type="text" class="form-control" name="lastname" placeholder="Lastname" required>
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <div class="input-group">
                            <input value="<?php echo $_SESSION['email']; ?>" type="email" class="form-control" name="email" placeholder="Email" required>
                            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="mobile" class="form-label fw-bold">Mobile</label>
                        <div class="input-group">
                            <input value="<?php echo $_SESSION['mobile']; ?>" type="text" class="form-control" name="mobile" placeholder="Mobile" required>
                            <span class="input-group-text"><i class="bi bi-phone-fill"></i></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="gender" class="form-label fw-bold">Gender</label>
                        <div class="input-group">
                            <select class="form-select" name="gender" required>
                                <option value="Male" <?php if ($_SESSION['gender'] === 'Male') echo 'selected'; ?>>Male</option>
                                <option value="Female" <?php if ($_SESSION['gender'] === 'Female') echo 'selected'; ?>>Female</option>
                            </select>
                            <span class="input-group-text"><i class="bi bi-gender-male"></i></span>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="address" class="form-label fw-bold">Address</label>
                        <div class="input-group">
                            <input value="<?php echo $_SESSION['address']; ?>" type="text" class="form-control" name="address" placeholder="Address" required>
                            <span class="input-group-text"><i class="bi bi-house-fill"></i></span>
                        </div>
                    </div>

                 
                    <div class="col-md-6">
                        
                        <div class="input-group">
                           
                        </div>
                 </div>


                    <!-- Add the remaining form fields -->

                </div>

                <div class="row-button">
                  
                        <button type="button" style="width: fit-content;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmationModal">Update Profile</button>
            
                </div>
            </form>
        </div>
    </div>


<!-- Confirmation Modal -->
<div id="confirmationModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Profile Update Confirmation</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="password" class="form-label fw-bold">Enter Your Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="modal-footer">
             
                <button id="updateProfileBtn" type="button" style="width: 100%;" class="btn btn-primary" data-bs-dismiss="modal">Update Profile</button>
            </div>
        </div>
    </div>
</div>

<!-- Add the confirmation form and assign the id attribute -->
<form id="confirmationForm" style="display: none;"></form>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>


<script>
   document.addEventListener('DOMContentLoaded', function() {
  var updateProfileBtn = document.getElementById('updateProfileBtn');
  updateProfileBtn.addEventListener('click', function() {
    var passwordInput = document.getElementById('password');
    if (passwordInput) {
      var password = passwordInput.value;
      passwordInput.value = ""; // Clear the password input field
      
      // Create a hidden input field dynamically
      var passwordField = document.createElement('input');
      passwordField.setAttribute('type', 'hidden');
      passwordField.setAttribute('name', 'password');
      passwordField.setAttribute('value', password);
      
      // Append the hidden input field to the update form
      var updateForm = document.getElementById('updateForm');
      updateForm.appendChild(passwordField);
      
      // Submit the update form
      updateForm.submit();
    } else {
      alert('Please enter your password.');
    }
  });
});


</script>








</body>

</html>
