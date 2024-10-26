<?php
/**
 * This PHP block manages the session.
 */

//We start the session
session_start();

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

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>DemoEvents - Home</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/main.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    </head>
    <body>
        <?php include_once "topmenu.php";?>
        <div class="container-fluid">
            <div class="container">
                <h1 style="font-weight: bold; margin-bottom: 20px; font-size: 40px;">DEMO EVENTS</h1>
                <h2 style="font-weight: bold; margin-bottom: 40px; font-size: 30px;">Welcome to the home page of DemoEvents!</h2>
                <p style="margin-bottom: 35px; font-size: 15px;">With DemoEvents, you can simulate the purchase of tickets for different events of different categories.</p>

                <?php
                /**
                 * This block prints a message if user is not registered.
                 */
                
                if ($isRegistered == false) {
                    echo "<p style='margin-bottom: 40px;'>Try to <a href='register.php'>register</a> or <a href='login.php'>login</a> to get started.</p>";
                }

                ?>

                <!-- Image carousel with flickity lib -->
                <div class="carousel" data-flickity='{ "imagesLoaded": true, "percentPosition": false, "wrapAround": true, "autoPlay": true }' style="margin-bottom: 20px;">
                    <img src="images/ysysmo.jpg" alt="YSYSMO show at Razzmatazz" />
                    <img src="images/comedyclub.jpg" alt="Comedy Club" />
                    <img src="images/barça.jpg" alt="Barça Matchday LaLiga" />
                    <img src="images/girona.jpg" alt="GironaMatchday LaLiga" />
                    <img src="images/cruillacomedy.jpg" alt="Cruilla Comedy" />
                    <img src="images/carlitosalacaraz.jpeg" alt="Carlos Alcaraz Roland Garros Matchday" />
                </div>

            </div>
        </div>
        <?php include_once "footer.php";?>
    </body>
</html>