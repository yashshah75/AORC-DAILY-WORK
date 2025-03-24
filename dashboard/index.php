<?php
    session_start();
    include('database/db.php');
    // include('sidebar.php');
    // include('header.php');
    ?>

  <?php
      // error_reporting(0);
      $user_profile = $_SESSION['user_name'];

      if($user_profile == TRUE)
      {
        // echo "session";
          // header('Location: register.php');
      }
      else
      {
          header('Location: login.php');
          
      }

      $query = "SELECT * FROM register";
      
      $data = mysqli_query($conn, $query);

      $total = mysqli_num_rows($data); //it will presents how many number of rows are present in the table

      if($total != 0)
      { 
  ?>

<!DOCTYPE html>
<html lang="en">
  <!-- [Head] start -->
  
  
  <!-- Mirrored from themewagon.github.io/Mantis-Bootstrap/dashboard/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Mar 2025 13:10:11 GMT -->
  <!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
  <head>
    <title>Home | Mantis Bootstrap 5 Admin Template</title>
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
<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
  
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>



  <!-- [ Pre-loader ] End -->
  <!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
  <!-- [ Main Content ] start -->
  <div class="pc-container">
    <div class="pc-content">
      <!-- [ Main Content ] start -->
     
<div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <div class="page-header-title">
                <h5 class="m-b-10">Home</h5>
              </div>
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Home</li>
              </ul>
            </div>
          </div>
        </div>
      </div>


      <!-- =============================================================================================== -->
                                        <!-- CRUD TABLE  -->
      <!-- =============================================================================================== -->
      <table style="text-align: center" class="table table-bordered">
      <thead>
        <tr>
          <th >ID</th>
          <th >IMAGE</th>
          <th>USER NAME</th>
          <th>EMAIL</th>
          <th>PASSWORD</th>
          <th>CONFIRM_PASSWORD</th>
          <th>MOBILE</th>
          <th>ACTIONS</th>
        </tr>
      </thead>
      <tbody>
<?php 
// error_reporting(0);
    while($result = mysqli_fetch_assoc($data))
    {
        echo "<tr>
          <td>".$result['ID']."</td>
          <td><img src = '".$result['photo']."' height='50px' width='50px' alt='image'></td>
          <td>".$result['username']."</td>
          <td>".$result['email']."</td>
          <td>".$result['password']."</td>
          <td>".$result['confirm_password']."</td>
          <td>".$result['mobile']."</td>
          
          <td>
            <a href='update_profile.php'> <button type='submit' class='btn btn-success'>UPDATE </button> </a><br><br>
            <button type='submit' class='btn btn-danger'>DELETE </button>

          </td>
        </tr>";
        // echo "<br>";
    }
    }

    else
    {
      echo "No records found";
    }
?>
      
        
      </tbody>
    </table>
    </div>
  </div>
  <!-- [ Main Content ] end -->
  
  <!-- [Page Specific JS] start -->
  <script src="../assets/js/plugins/apexcharts.min.js"></script>
  <script src="../assets/js/pages/dashboard-default.js"></script>
  <!-- [Page Specific JS] end -->
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

<?php
include('footer.php');

?>
  
</body>
<!-- [Body] end -->


<!-- Mirrored from themewagon.github.io/Mantis-Bootstrap/dashboard/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Mar 2025 13:10:17 GMT -->
</html>