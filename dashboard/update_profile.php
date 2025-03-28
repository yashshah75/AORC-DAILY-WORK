<?php 
  session_start();
  require_once('database/db.php');
  $uid = $_GET['id'];

  // $user_profile = $_SESSION['user_name'];

  // if($use_profile == true)
  // {

  // }
  // else
  // {
  //   header('Location: login.php');

  // }

  $query = "SELECT * FROM register WHERE ID='$uid'";
  $data = mysqli_query($conn, $query);

  $result = mysqli_fetch_assoc($data);
?>


<?php 
  if(isset($_POST['update']))
  {
    $folder = $result['photo'];
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['mobile']);
    if (!empty($_FILES['photo']['name'])) {
      $filename = $_FILES['photo']['name'];
      $tempname = $_FILES['photo']['tmp_name'];
      $folder = "images/".$filename;
      
      if(!move_uploaded_file($tempname, $folder))
      {
          die("File Upload Failed");
      }
  }

      if(empty($username) || empty($email) || empty($phone)) {
          die("All fields are required!");
      }

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          die("Invalid email format!");
      }

      if (strlen($username) < 3) {
        die("<p style='color:red;'>Username must be at least 3 characters long.</p>");
      }

      if (!preg_match('/^\+?[0-9]{10,15}$/', $phone)) {
        die("<p style='color:red;'>Invalid phone number format! (10-15 digits, optional + at the start).</p>");
      }

      $query = "UPDATE register SET photo = '$folder', username='$username', email='$email', mobile='$phone' WHERE id='$uid'";

        $data = mysqli_query($conn,$query);
    
        if(!$data)
        {
            echo "Record not Updated";
        }
        else
        {   
          ?>
        <meta http-equiv = "refresh" content = "2; url = http://localhost/1.%20AORC%20TECHNOLOGIES/PRACTICE/7.crud_html/Mantis-Bootstrap/dashboard/index.php" />
        
        <?php
            echo "";
          
        $message = "Record Updated Successfully!";
        echo "<div style='padding: 10px; background-color: green; color: white; text-align: center;  position: relative; z-index: 999;'>$message</div>";
        }

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
            
          
            <div class="d-flex justify-content-between align-items-end mb-4">
              <h3 class="mb-0"><b>Update Profile</b></h3>
            </div>

            <form action="" method="POST" enctype="multipart/form-data">
            <!-- <div class="row"> -->
              <div class="col-md-12">  
                <div class="form-group mb-3">
                <img src="<?php echo $result['photo']; ?>" alt="Profile Image" width="100"><br>

                  <label class="form-label">Your Photo: </label>
                  <input type="file" id="imageInput" name="photo" value="<?php echo $result['photo'] ?>" accept=".jpg, .jpeg, .png" class="form-control" >
                  <span class="span" style="color:red;"> Only JPG, JPEG, and PNG files are allowed</span>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group mb-3">
                  <label class="form-label">Username</label>
                  <input type="text" class="form-control" value="<?php echo $result['username']?>" name="username">
                </div>
              </div>
            
            <!-- </div> -->
            <div class="form-group mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" placeholder="Enter Your Email" value="<?php echo $result['email']?>" name="email">
            </div>

              <div class="col-md-12">
                <div class="form-group mb-3">
                  <label class="form-label">Phone Number</label>
                  <input type="text" class="form-control" value="<?php echo $result['mobile']?>" name="mobile" placeholder="10-15 digits, optional + at the start">
                  <span style="color:red"> Number Should be 10-15 digits, optional + at the start</span>
                </div>
              </div>

            <!-- <p class="mt-4 text-sm text-muted">By Signing up, you agree to our <a href="#" class="text-primary"> Terms of Service </a> and <a href="#" class="text-primary"> Privacy Policy</a></p> -->
            <div class="d-grid mt-3">
              <a href="index.php"><button type="submit" class="btn btn-primary" name = "update">UPDATE</button></a>
              <br>
              <a href="index.php">Back</a>
            </div>
            
          </div>
        </div>
      </form>
        <div class="auth-footer row">
          <!-- <div class=""> -->
            <div class="col my-1">
              <p class="m-0">Copyright © <a href="#">YASH SHAH</a> Distributed by <a href="https://themewagon.com/">ThemeWagon</a></p>
            </div>
            <div class="col-auto my-1">
              <ul class="list-inline footer-link mb-0">
                <li class="list-inline-item"><a href="index.php">Home</a></li>
                <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                <li class="list-inline-item"><a href="#">Contact us</a></li>
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
  
  
  
  
  <script>change_box_container('false');       </script>
  
  
  
  <script>layout_rtl_change('false');</script>
  
  
  <script>preset_change("preset-1");</script>
  
  
  <script>font_change("Public-Sans");</script>
  
    
 <div class="offcanvas pct-offcanvas offcanvas-end" tabindex="-1" id="offcanvas_pc_layout">
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
</div>
</body>
<!-- [Body] end -->


<!-- Mirrored from themewagon.github.io/Mantis-Bootstrap/pages/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 20 Mar 2025 07:03:19 GMT -->
</html>



