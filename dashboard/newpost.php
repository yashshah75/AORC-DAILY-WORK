<?php 
  // session_start();
  require_once('database/db.php');

  if(isset($_POST['add_post']))
  {
    $allowed_extensions = ['jpg', 'jpeg', 'png'];

      // Get the file name and extension
      $filename = $_FILES["photo"]["name"];
      $temp_name = $_FILES["photo"]["tmp_name"];
      $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION)); // Extract extension
      

      // Validate file extension
      if (!in_array($file_ext, $allowed_extensions)) {
         die("<p style='color:red;'>Only JPG, JPEG, and PNG files are allowed.</p>");
      } else {
          // Move the file if valid
          $folder = "images/" . $filename;
          if (!move_uploaded_file($temp_name, $folder)) {
              echo "<p style='color:red;'>File upload failed!</p>";  
          }
      }

      $post_title = trim($_POST['post_title']);
      $post_description = trim($_POST['post_description']);
      
    // Insert user into the database
    $sql = "INSERT INTO post(post_title, post_description, image ) VALUES (?,?,?)";
    $stmtinsert = $conn->prepare($sql);

    $stmtinsert->bind_param("sss", $post_title, $post_description, $folder);    // bind_param() : bind_param() is a function in PHP used with MySQLi prepared statements
    
    // to bind actual values to placeholders (?) in an SQL query
    
    if ($stmtinsert->execute()) {
      // echo "INSERTED";  
      header("Location: allpost.php"); // Redirect to login page
        exit();
    } else {
        echo "Error: " .$conn->error;
    }

    $stmtinsert->close(); //closing the statement after the execution
    $conn->close(); // closing the database
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
              <h3 class="mb-0"><b>New Post</b></h3>
              <!-- <a href="login.php" class="link-primary">Already have an account?</a> -->
            </div>

            <!-- <div class="row"> -->
            <div class="col-md-12">  
              <div class="form-group mb-3">
                <label class="form-label">Post Photo: </label>
                <input type="file" id="imageInput" name="photo" accept=".jpg, .jpeg, .png" class="form-control" Required>
                <span class="span" style="color:red;"> Only JPG, JPEG, and PNG files are allowed</span>
              </div>
            </div>


            <div class="col-md-12">
              <div class="form-group mb-3">
                <label class="form-label">Post Title</label>
                <input type="text" class="form-control" placeholder="Enter Your Username" name="post_title" minlength="3" Required>
              </div>
            </div>
            
            <div class="form-group mb-3">
              <label class="form-label">Post Description</label>    
              <input type="text" class="form-control" placeholder="Description" name="post_description" Required>

            </div>
            
            <!-- <p class="mt-4 text-sm text-muted">By Signing up, you agree to our <a href="#" class="text-primary"> Terms of Service </a> and <a href="#" class="text-primary"> Privacy Policy</a></p> -->
            <div class="d-grid mt-3">
              <button type="submit" class="btn btn-primary" name="add_post">Add Post</button>
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
  
</body>
<!-- [Body] end -->
</html>







<!-- ============================================================  -->
                        <!-- PHP CODE  -->
<!-- ============================================================ -->
