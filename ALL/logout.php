<?php
session_start(); // Start the session

// Unset the user session variable
unset($_SESSION['user']);

// Redirect to the index page
header("Location: index.php");
exit(); // Ensure no further code is executed after redirection
?>
