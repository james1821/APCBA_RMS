<?php
include('validation.php');
include('connection.php');
session_start();
$passcode = $connect->real_escape_string($_POST["passcode"]);
$csrf = $connect->real_escape_string($_POST["csrf"]);

require_once 'googleLib/GoogleAuthenticator.php';
$ga = new GoogleAuthenticator();
$secret = $ga->createSecret();

if ($csrf == $_SESSION["token"]) {
    $googlecode = $connect->real_escape_string($_POST['googlecode']);
    $firstname = $connect->real_escape_string($_POST['firstname']);
    $lastname = $connect->real_escape_string($_POST['lastname']);
    $email = $connect->real_escape_string($_POST['email']);
    $username = $connect->real_escape_string($_POST['username']);
    $password = $connect->real_escape_string($_POST['password']);
    $mobile = $connect->real_escape_string($_POST['mobile']);
    $gender = $connect->real_escape_string($_POST['gender']);
    $address = $connect->real_escape_string($_POST['address']);
    $Middlename = $connect->real_escape_string($_POST['Middlename']);
    $stat = $connect->real_escape_string($_POST['stat']);
    $status = 1;

    /* Check IF Username or email used Before */
    $query = db_query("select * from  user where email='" . $email . " ");
    $resuser = mysqli_num_rows($query);
    if ($resuser > 0) {
        echo '<script>alert(" Email is Taken!, Please Use Another Email");</script>';
        header('Location:register.php?error=2');
        exit();
    } else {
        $mysql = db_query("insert into user set firstname='" . $firstname . "',
                                            Middlename='" . $Middlename . "',
                                            mobile='" . $mobile . "',
                                            gender='" . $gender . "',
                                            address='" . $address . "',
                                            lastname='" . $lastname . "',
                                            email='" . $email . "',
                                            username='" . $username . "',
                                            password='" . $password . "',
                                            status='" . $stat . "',
                                            googlecode='" . $googlecode . "'");
      
        echo '<script>alert("User created successfully!");</script>';
        $_SESSION['newsecret']=$googlecode;
        header('Location: register_qr.php?email=' . urlencode($email));
        exit();
    }
}

include('sidebar.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add New User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/layout.css">
    <link rel="stylesheet" href="assets/css/form-design.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/register.css">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>

    <div class="row justify-content-center " style="margin-left: 250px;">
        <div class="tab col-md-7 border mx-auto mt-5 p-2 shadow-lg">
            <div class="row">
                <div class="col-md-4">
                    <img src="img/school.jpg" alt="">
                </div>
                <div class="col-md-8 align-self-center">
                    <h1>User Credentials</h1>
                </div>
            </div>
            <hr style="border-top: 2px solid black; margin: 20px 0;">

            <form name="reg" action="register.php" method="POST">
                <input type="hidden" name="csrf" value="<?php print $_SESSION["token"]; ?>">
                <input type="hidden" name="googlecode" value="<?php echo $secret; ?>">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="firstname" class="form-label fw-bold">Firstname</label>
                        <div class="input-group">
                            <input value="" type="text" class="form-control" name="firstname" placeholder="Firstname" required>
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <div class="input-group">
                            <input value="" type="email" class="form-control" name="email" placeholder="Email" required>
                            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="Middlename" class="form-label fw-bold">Middlename</label>
                        <div class="input-group">
                            <input value="" type="text" class="form-control" name="Middlename" placeholder="Middlename" required>
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="gender" class="form-label fw-bold">Gender</label>
                        <div class="input-group">
                            <select name="gender" class="form-select" required>
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <span class="input-group-text"><i class="bi bi-gender-ambiguous"></i></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="lastname" class="form-label fw-bold">Lastname</label>
                        <div class="input-group">
                            <input value="" type="text" class="form-control" name="lastname" placeholder="Lastname" required>
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="stat" class="form-label fw-bold">Role</label>
                        <div class="input-group">
                            <select required name="stat" class="form-select" required>
                                <option value="">Select a Role</option>
                                <option value="Head-Admin">Head-Admin</option>
                                <option value="Assistant-Admin">Assistant-Admin</option>
                            </select>
                            <span class="input-group-text"><i class="bi bi-people"></i></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="mobile" class="form-label fw-bold">Mobile Number</label>
                        <div class="input-group">
                            <input value="" type="number" class="form-control" name="mobile" placeholder="Mobile Number" required>
                            <span class="input-group-text"><i class="bi bi-phone-fill"></i></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="username" class="form-label fw-bold">Username</label>
                        <div class="input-group">
                            <input value="" type="text" class="form-control" name="username" placeholder="Username" required>
                            <span class="input-group-text"><i class="bi bi-person-square"></i></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="address" class="form-label fw-bold">Address</label>
                        <div class="input-group">
                            <input value="" type="text" class="form-control" name="address" placeholder="Address" required>
                            <span class="input-group-text"><i class="bi bi-building"></i></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <div class="input-group">
                            <input value="" type="password" class="form-control" name="password" placeholder="Password" required>
                            <span class="input-group-text"><i class="bi bi-shield-lock-fill"></i></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" style="width: 100%;" class="btn btn-primary">Create User</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="assets/js/jquery-1.12.4.min.js"></script>
    <script src="assets/css/bootstrap/js/bootstrap.min.js"></script>
    <script>
        function showAlert() {
            alert("User Added successfully, proceed to the next step!");
        }

        document.querySelector("form").addEventListener("submit", showAlert);
    </script>
</body>

</html>
