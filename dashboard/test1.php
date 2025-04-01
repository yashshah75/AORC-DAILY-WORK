<?php
session_start();
$_SESSION['test'] = 'Hello, World!';
echo "Session has been set.";
?>
<a href="test2.php">Check Session</a>
