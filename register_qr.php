<?php
include('validation.php');
include('connection.php');
session_start();

$secret = $_SESSION['newsecret'];
$user 	= $_SESSION['email'];
$email = isset($_GET['email']) ? $_GET['email'] : '';







$query		= db_query("select * from  user where username='".$username."'");	
	$resuser = mysqli_num_rows($query);
            
        require_once 'googleLib/GoogleAuthenticator.php';
        $ga 		= new GoogleAuthenticator();
        $qrCodeUrl 	= $ga->getQRCodeGoogleUrl($email, $secret,'APCBA_Rizal');
  

        include('sidebar.php');
?>

<!doctype html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Google Two Factor Authentication Login with PHP</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/layout.css">
        <link rel="stylesheet" href="assets/css/form-design.css">
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">  
        <link rel="stylesheet" type="text/css" href="assets/css/user.css">
		
		
</head>

    <body >
  

        
       
    <div class="container">
  <table>
    <tr>
      <th>
        <td>
          <center>
            <h2>Please Save this QR code for this User</h2>
          </center>
         
            <div class="form-group">
              <center>
                <img src="<?php echo $qrCodeUrl; ?>" />
              </center>
            </div>
          
       
         
        </td>
      </th>
    </tr>
  </table>
</div>

    </body>
</html>