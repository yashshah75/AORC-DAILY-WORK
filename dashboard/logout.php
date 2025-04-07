<?php
session_start();
session_unset(); // Unset session variables
session_destroy(); //destroy all the sessions
header("Location: login.php");
exit();
?>