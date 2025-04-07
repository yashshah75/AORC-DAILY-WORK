<?php
session_start();

$_SESSION["user_name"] = "Yash";
// $_SESSION['photo'] = "user-image";
$_SESSION['user_photo'] = $user['photo']; // Save image file name in session


// echo $_SESSION["user_name"];

// session_unset();

// echo $_SESSION["user_name"];


// session_start();
// $_SESSION['user_name'] = "Yash";
// session_destroy(); // Ends the session and clears session data

// echo isset($_SESSION['user']) ? "Variable exists" : "Session destroyed"; // Output: Session destroyed

?>      