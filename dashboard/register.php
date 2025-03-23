<?php 
  require_once('database/db.php');

  if(isset($_POST['register']))
  {
    $allowed_extensions = ['jpg', 'jpeg', 'png'];

      // Get the file name and extension
      $filename = $_FILES["photo"]["name"];
      $temp_name = $_FILES["photo"]["tmp_name"];
      $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION)); // Extract extension

      // Validate file extension
      if (!in_array($file_ext, $allowed_extensions)) {
          echo "<p style='color:red;'>Only JPG, JPEG, and PNG files are allowed.</p>";
      } else {
          // Move the file if valid
          $folder = "images/" . $filename;
          if (!move_uploaded_file($temp_name, $folder)) {
              echo "<p style='color:red;'>File upload failed!</p>";  
          }
      }
      //for upload the file

      // $filename =  $_FILES["upload_file"]["name"];
      // $temp_name = $_FILES["upload_file"]["tmp_name"];
      $folder = "images/".$filename;
      move_uploaded_file($temp_name, $folder);

      $username = trim($_POST['username']);
      $email = trim($_POST['email']);
      $password = trim($_POST['password']);
      $confirmpassword = trim($_POST['confirm_password']);
      $phone = trim($_POST['mobile']);
      

      if ($password !== $confirmpassword) {
          die("Passwords do not match!");
      }    

      if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{5,}$/', $password)) 
      {        
          die("Password is not in correct format");
      }    
        
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format!");
    }    
    

    // Insert user into the database
    $sql = "INSERT INTO register (username, email, password, confirm_password, mobile) VALUES (?,?, ?, ?, ?)";
    $stmtinsert = $conn->prepare($sql);

    $stmtinsert->bind_param("sssss", $username, $email, $password, $confirmpassword, $phone);    // bind_param() : bind_param() is a function in PHP used with MySQLi prepared statements
    
    // to bind actual values to placeholders (?) in an SQL query
    
    if ($stmtinsert->execute()) {
      echo "INSERTED";  
      header("Location: login.php"); // Redirect to login page
        // exit;
    } else {
        echo "Error: " .$conn->error;
    }

    $stmtinsert->close(); //closing the statement after the execution
    $conn->close(); // closing the database

      // $sql = "INSERT INTO register (photo, username, email, password, confirm_password, mobile) VALUES (?,?, ?, ?, ?, ?)";
      // header("Location:login.php");
      // echo "SUBMITTED";
  }

?>

<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->


<!-- Mirrored from themewagon.github.io/Mantis-Bootstrap/pages/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 20 Mar 2025 07:03:16 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
  <title>Sign up | Mantis Bootstrap 5 Admin Template</title>
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
          
          <form method="POST" action="" enctype="multipart/form-data">
            
            <div class="d-flex justify-content-between align-items-end mb-4">
              <h3 class="mb-0"><b>Sign up</b></h3>
              <a href="login.php" class="link-primary">Already have an account?</a>
            </div>

            <!-- <div class="row"> -->
            <div class="col-md-12">  
              <div class="form-group mb-3">
                <label class="form-label">Your Photo: </label>
                <input type="file" id="imageInput" name="photo" accept=".jpg, .jpeg, .png" class="form-control">
                <span class="span" style="color:red;"> Only JPG, JPEG, and PNG files are allowed</span>
              </div>
            </div>


            <div class="col-md-12">
              <div class="form-group mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" placeholder="Enter Your Username" name="username">
              </div>
            </div>
            
            <!-- </div> -->
            <!-- <div class="form-group mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" placeholder="Enter Your Email">
            </div> -->
            
            <div class="form-group mb-3">
              <label class="form-label">Email Address</label>
              <input type="email" class="form-control" placeholder="Email Address" name="email">
            </div>
            
            <div class="form-group mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" placeholder="Password" name="password">
              <span style="color:red";> Password should be in this format: Abc@123 <br>
               Password must be at least 5 characters long</span>
            </div>

            <div class="col-md-12">
                <div class="form-group mb-3">
                  <label class="form-label">Confirm Password</label>
                  <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password">
                  <span style="color:red";> Password should be in this format: Abc@123</span>
                  <span style="color:red";> Password must be at least 5 characters long</span>
                </div>
            </div>

            <div class="col-md-12">
              <div class="form-group mb-3">
                <label class="form-label">Phone Number</label>
                <input type="tel" class="form-control" placeholder="Mobile should be 10 digits" name="mobile">
              </div>
            </div>

            <!-- <p class="mt-4 text-sm text-muted">By Signing up, you agree to our <a href="#" class="text-primary"> Terms of Service </a> and <a href="#" class="text-primary"> Privacy Policy</a></p> -->
            <div class="d-grid mt-3">
              <button type="submit" class="btn btn-primary" name="register">Register</button>
            </div>
            <!-- <div class="saprator mt-3">
              <span>Sign up with</span>
            </div> -->
            <!-- <div class="row">
              <div class="col-4">
                <div class="d-grid">
                  <button type="button" class="btn mt-2 btn-light-primary bg-light text-muted">
                    <img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/authentication/google.svg" alt="img"> <span class="d-none d-sm-inline-block"> Google</span>
                  </button>
                </div>
              </div>
              <div class="col-4">
                <div class="d-grid">
                  <button type="button" class="btn mt-2 btn-light-primary bg-light text-muted">
                    <img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/authentication/twitter.svg" alt="img"> <span class="d-none d-sm-inline-block"> Twitter</span>
                  </button>
                </div>
              </div>
              <div class="col-4">
                <div class="d-grid">
                  <button type="button" class="btn mt-2 btn-light-primary bg-light text-muted">
                    <img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/authentication/facebook.svg" alt="img"> <span class="d-none d-sm-inline-block"> Facebook</span>
                  </button>
                </div>
              </div>
            </div> -->
            
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
                <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                <li class="list-inline-item"><a href="#">Contact us</a></li>
              </ul>
            </div>
          <!-- </div> -->
        </div>
      </div>
      </form>
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
  
    
 <!-- <div class="offcanvas pct-offcanvas offcanvas-end" tabindex="-1" id="offcanvas_pc_layout">
  <div class="offcanvas-header bg-primary">
    <h5 class="offcanvas-title text-white">Mantis Customizer</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="pct-body" style="height: calc(100% - 60px)">
    <div class="offcanvas-body">
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse1">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-xs bg-light-primary">
                  <i class="ti ti-layout-sidebar f-18"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">Theme Layout</h6>
                <span>Choose your layout</span>
              </div>
              <i class="ti ti-chevron-down"></i>
            </div>
          </a>
          <div class="collapse show" id="pctcustcollapse1">
            <div class="pct-content">
              <div class="pc-rtl">
                <p class="mb-1">Direction</p>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" role="switch" id="layoutmodertl">
                  <label class="form-check-label" for="layoutmodertl">RTL</label>
                </div>
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse2">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-xs bg-light-primary">
                  <i class="ti ti-brush f-18"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">Theme Mode</h6>
                <span>Choose light or dark mode</span>
              </div>
              <i class="ti ti-chevron-down"></i>
            </div>
          </a>
          <div class="collapse show" id="pctcustcollapse2">
            <div class="pct-content">
              <div class="theme-color themepreset-color theme-layout">
                <a href="#!" class="active" onclick="layout_change('light')" data-value="false"
                  ><span><img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/customization/default.svg" alt="img"></span><span>Light</span></a
                >
                <a href="#!" class="" onclick="layout_change('dark')" data-value="true"
                  ><span><img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/customization/dark.svg" alt="img"></span><span>Dark</span></a
                >
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse3">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-xs bg-light-primary">
                  <i class="ti ti-color-swatch f-18"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">Color Scheme</h6>
                <span>Choose your primary theme color</span>
              </div>
              <i class="ti ti-chevron-down"></i>
            </div>
          </a>
          <div class="collapse show" id="pctcustcollapse3">
            <div class="pct-content">
              <div class="theme-color preset-color">
                <a href="#!" class="active" data-value="preset-1"
                  ><span><img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 1</span></a
                >
                <a href="#!" class="" data-value="preset-2"
                  ><span><img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 2</span></a
                >
                <a href="#!" class="" data-value="preset-3"
                  ><span><img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 3</span></a
                >
                <a href="#!" class="" data-value="preset-4"
                  ><span><img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 4</span></a
                >
                <a href="#!" class="" data-value="preset-5"
                  ><span><img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 5</span></a
                >
                <a href="#!" class="" data-value="preset-6"
                  ><span><img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 6</span></a
                >
                <a href="#!" class="" data-value="preset-7"
                  ><span><img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 7</span></a
                >
                <a href="#!" class="" data-value="preset-8"
                  ><span><img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 8</span></a
                >
                <a href="#!" class="" data-value="preset-9"
                  ><span><img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 9</span></a
                >
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item pc-boxcontainer">
          <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse4">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-xs bg-light-primary">
                  <i class="ti ti-border-inner f-18"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">Layout Width</h6>
                <span>Choose fluid or container layout</span>
              </div>
              <i class="ti ti-chevron-down"></i>
            </div>
          </a>
          <div class="collapse show" id="pctcustcollapse4">
            <div class="pct-content">
              <div class="theme-color themepreset-color boxwidthpreset theme-container">
                <a href="#!" class="active" onclick="change_box_container('false')" data-value="false"><span><img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/customization/default.svg" alt="img"></span><span>Fluid</span></a>
                <a href="#!" class="" onclick="change_box_container('true')" data-value="true"><span><img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/customization/container.svg" alt="img"></span><span>Container</span></a>
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse5">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-xs bg-light-primary">
                  <i class="ti ti-typography f-18"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">Font Family</h6>
                <span>Choose your font family.</span>
              </div>
              <i class="ti ti-chevron-down"></i>
            </div>
          </a>
          <div class="collapse show" id="pctcustcollapse5">
            <div class="pct-content">
              <div class="theme-color fontpreset-color">
                <a href="#!" class="active" onclick="font_change('Public-Sans')" data-value="Public-Sans"
                  ><span>Aa</span><span>Public Sans</span></a
                >
                <a href="#!" class="" onclick="font_change('Roboto')" data-value="Roboto"><span>Aa</span><span>Roboto</span></a>
                <a href="#!" class="" onclick="font_change('Poppins')" data-value="Poppins"><span>Aa</span><span>Poppins</span></a>
                <a href="#!" class="" onclick="font_change('Inter')" data-value="Inter"><span>Aa</span><span>Inter</span></a>
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <div class="collapse show">
            <div class="pct-content">
              <div class="d-grid">
                <button class="btn btn-light-danger" id="layoutreset">Reset Layout</button>
              </div>              
            </div>
          </div>     
        </li>
      </ul>
    </div>
  </div>
</div> -->
</body>
<!-- [Body] end -->


<!-- Mirrored from themewagon.github.io/Mantis-Bootstrap/pages/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 20 Mar 2025 07:03:19 GMT -->
</html>



