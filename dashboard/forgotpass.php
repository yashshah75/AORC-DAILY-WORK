<?php 
  session_start();
  include('database/db.php');

  require 'vendor/autoload.php'; // If installed via Composer
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  

  if (isset($_POST['pwd_reset'])) {
    $email = $_POST['email'];

    // Check if email exists
    $query = "SELECT * FROM register WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($result)) 
    {
        // Generate a unique token
         $token = bin2hex(random_bytes(50));

        // Store token in the database
        $updateQuery = "UPDATE register SET reset_token=? WHERE email=?";  
        $stmt = mysqli_prepare($conn, $updateQuery);
        
        if (!$stmt) 
            die("Update query preparation failed: " . mysqli_error($conn));
        {
        }
          
       // $stmt = mysqli_prepare($conn, $updateQuery);
        mysqli_stmt_bind_param($stmt, "ss", $token, $email);
        mysqli_stmt_execute($stmt);

        // Send reset link to user's email
        $reset_link = "http://localhost/1. AORC TECHNOLOGIES/PRACTICE/7.crud_html/Mantis-Bootstrap/dashboard/reset_password.php?token=$token";

        $mail = new PHPMailer(true);
        try 
        {
            // Server settings
            $mail->isSMTP();                                  
            $mail->Host = 'smtp.gmail.com';  
            $mail->SMTPAuth = true;                       
            $mail->Username = 'yashphp.aorc@gmail.com';    
            $mail->Password = 'lzsfzuncktimswwm';      
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;                           

            // Recipients
            $mail->setFrom('yashphp.aorc@gmail.com', 'PHPmailer');
            $mail->addAddress($email);                  

            // Content
            $mail->isHTML(true);                         
            $mail->Subject = 'Password Reset Request';
            $mail->Body    = "Click the link below to reset your password: <a href='$reset_link'>$reset_link</a>";

            // Send the email
            $mail->send();
            echo "<h4 style='color:red;'> Password reset link has been sent to your email.</h4>";
        } 
        catch (Exception $e) 
        {
            echo "Failed to send email. Mailer Error: {$mail->ErrorInfo}";
        }
    } 
    else 
    {
        echo "Email not found!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->


<!-- Mirrored from themewagon.github.io/Mantis-Bootstrap/pages/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 20 Mar 2025 06:40:49 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
  <title>Login | Mantis Bootstrap 5 Admin Template</title>
  <!-- [Meta] -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
  <meta name="keywords" content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
  <meta name="author" content="CodedThemes">

  <!-- [Favicon] icon -->
  <link rel="icon" href="https://themewagon.github.io/Mantis-Bootstrap/assets/images/favicon.svg" type="image/x-icon"> <!-- [Google Font] Family -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&amp;display=swap" id="main-font-link">
<!-- [Tabler Icons] https://tablericons.com -->
<link rel="stylesheet" href="../assets/fonts/tabler-icons.min.css" >
<!-- [Feather Icons] https://feathericons.com -->
<link rel="stylesheet" href="../assets/fonts/feather.css" >
<!-- [Font Awesome Icons] https://fontawesome.com/icons -->
<link rel="stylesheet" href="../assets/fonts/fontawesome.css" >
<!-- [Material Icons] https://fonts.google.com/icons -->
<link rel="stylesheet" href="../assets/fonts/material.css" >
<!-- [Template CSS Files] -->
<link rel="stylesheet" href="../assets/css/style.css" id="main-style-link" >
<link rel="stylesheet" href="../assets/css/style-preset.css" >

</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body>
<form action="#" method="POST">
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <!-- [ Pre-loader ] End -->

  <div class="auth-main">
    <div class="auth-wrapper v3">
      <div class="auth-form">
        <div class="auth-header">
          <a href="#"><img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/logo-dark.svg" alt="img"></a>
        </div>
        <div class="card my-5">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-end mb-4">
              <h3 class="mb-0"><b>Forgot Password</b></h3>
              <a href="register.php" class="link-primary">Don't have an account?</a>
            </div>
            <div class="form-group mb-3">
              <label class="form-label">Email Address</label>
              <input type="email" class="form-control" placeholder="Email Address" name="email">
            </div>
            <!-- <div class="form-group mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" placeholder="Password">
            </div> -->
            <!-- <div class="d-flex mt-1 justify-content-between">
              <a href="forgot"><h5 class="text-secondary f-w-400">Forgot Password?</h5></a>
            </div> -->
            <div class="d-grid mt-4">
              <button type="submit" class="btn btn-primary" name="pwd_reset">SEND</button><br>
              <a href="login.php">Back</a>
            </div>
			</div>
        </div>
        
		<div class="auth-footer row">
          <!-- <div class=""> -->
            <div class="col my-1">
              <p class="m-0">Copyright © <a href="#">YASH SHAH</a> Distributed by <a href="https://themewagon.com/">ThemeWagon</a></p>
            </div>
            <div class="col-auto my-1">
              <ul class="list-inline footer-link mb-0">
                <li class="list-inline-item"><a href="#">Home</a></li>
                <!-- <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                <li class="list-inline-item"><a href="#">Contact us</a></li> -->
              </ul>
            </div>
          <!-- </div> -->
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
  <!-- Required Js -->
  <script src="../assets/js/plugins/popper.min.js"></script>
  <script src="../assets/js/plugins/simplebar.min.js"></script>
  <script src="../assets/js/plugins/bootstrap.min.js"></script>
  <script src="../assets/js/fonts/custom-font.js"></script>
  <script src="../assets/js/pcoded.js"></script>
  <script src="../assets/js/plugins/feather.min.js"></script>

  
  
  
  
  <script>layout_change('light');</script>
  
  
  
  
  <script>change_box_container('false');</script>
  
  
  
  <script>layout_rtl_change('false');</script>
  
  
  <script>preset_change("preset-1");</script>
  
  
  <script>font_change("Public-Sans");</script>
  
</form>
 
</body>
<!-- [Body] end -->


<!-- Mirrored from themewagon.github.io/Mantis-Bootstrap/pages/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 20 Mar 2025 06:40:54 GMT -->
</html>