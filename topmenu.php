<?php
/**
* This PHP block manages the attributes for the top menu/header.
*/

//Attributes
$isRegistered = false;
$isAdmin = false;

//We check if the user is registered
if (isset($_SESSION["username"]) and isset($_SESSION["role"])) {
    $isRegistered = true;
    $user = $_SESSION["username"];
    if ($_SESSION["role"] == "admin") {
        $isAdmin = true;
    }
}

?>

<nav class="navbar navbar-default">
    <div class="container col-md-10">
        <div class="navbar-header">
            <a class="navbar-brand" href="https://github.com/cacara82">DemoEvents</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href='index.php'>Home</a></li>
            <li><a href='events.php'>Events</a></li>
            <?php if ($isRegistered == true) {
                echo "<li><a>Welcome, <strong>$user</strong>!</a></li>";
                echo "<li><a href='logout.php'>Logout</a></li>";
            }
            ?>
            <?php if ($isRegistered == false) {
                echo "<li><a href='register.php'>Register</a></li>";
                echo "<li><a href='login.php'>Login</a></li>";
            }
            ?>
        </ul>
    </div>
</nav>