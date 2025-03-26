<?php
session_start();
session_unset(); // Unset session variables
session_destroy(); 
header("Location: login.php");
exit();
?>