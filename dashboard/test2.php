<?php
session_start();
if (isset($_SESSION['test'])) {
    echo "Session value: " . $_SESSION['test'];
} else {
    echo "Session not found!";
}
?>
