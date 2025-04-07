<?php
    session_start();
    // $_SESSION['user_name'] = $username;

    if(!isset($_SESSION['user_name']))
    {
      header('Location: login.php');
      exit();
    }
?>

<?php 
    include('database/db.php');
    include('sidebar.php');
    include('header.php');

      $query = "SELECT * FROM post";
      
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
        <div class="loader-fill">
            </div>
        </div>
    </div>
    
    
    
    <!-- [ Pre-loader ] End -->
    <!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            
            <!-- [ Main Content ] start -->
            
            <!-- =============================================================================================== -->
                                                    <!-- CRUD TABLE  -->
            <!-- =============================================================================================== -->
            <a href="newpost.php">
                  <button class="btn btn-primary" style="margin-left:1100px; margin-bottom:10px">NEW POST</button>
                </a>
            <table style="text-align: center" class="table table-bordered">
                <thead><th colspan="7" style="font-size:30px">ALL THE POST</th>
                <tr>
                    <th>ID</th>
                    <th>Post_title</th>
                    <th>post_Description</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th>IMAGE</th>
                    <th>ACTIONS</th>
                    
                </tr>
            </thead>
            <tbody>
                
                <?php 
// error_reporting(0);
while($result = mysqli_fetch_assoc($data))
{
    echo "<tr>
    <td>".$result['id']."</td>
    <td>".$result['post_title']."</td>
    <td>".$result['post_description']."</td>
    <td>".$result['created_at']."</td>
    <td>".$result['updated_at']."</td>
    <td><img src = '".$result['image']."' height='50px' width='50px' alt='image'></td>
    <td>
    <a href='update_post.php?id=$result[id]'> <button class='btn btn-success'>UPDATE </button> </a>
    
    <a href='delete_post.php?id=$result[id]'> <button class='btn btn-danger'>DELETE </button>

    
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