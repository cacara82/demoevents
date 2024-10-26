<?php
/**
 * This block destroys the session and redirects to the main page again. (Logout)
 */

//We start the session to destroy it later
session_start();

//We destroy the session
$_SESSION = [];
session_destroy();
header("Location: index.php");

?>