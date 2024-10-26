<?php
/**
 * This PHP block manages the session.
 */
use uf1pt1utils as utils;
include "utils/utils.php";

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
        <title>DemoEvents - Buy Results</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/main.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php include_once "topmenu.php";?>
        <div class="container-fluid">
            
            <div class="container">

                <?php
                /**
                 * This block will print an error message if the user is not registered.
                 */
                
                 //We print it
                 if ($isRegistered == false) {
                    echo "<p style='color: red;'>You need to be logged in to buy tickets. Please <a href='login.php'>login</a>, or <a href='register.php'>register</a> if you don't have an account.</p>";
                    exit();
                 } 
                ?>

                <h2 style="margin-bottom: 20px">Buy results</h2>

                <?php
                /**
                 * This block manages the form action and
                 * attributes.
                 */

                //Attributes
                $formMethod = "POST";
                $categoryFile = "utils/categories.txt";
                $eventFile = "utils/events.txt";

                //We retrieve the data
                if ($formMethod == "POST") { 
                    if (isset($_POST["events"])) {
                        $event = $_POST["events"]; 
                    }
                    if (isset($_POST["tickets"])) {
                        $tickets = filter_input(INPUT_POST, "tickets", FILTER_SANITIZE_NUMBER_INT); 
                    }
                } else {
                    if (isset($_GET["events"])) {
                        $event = $_GET["events"];
                    }
                    if (isset($_GET["tickets"])) {
                        $tickets = filter_input(INPUT_GET, "tickets", FILTER_SANITIZE_NUMBER_INT);
                    }
                }
        
                ?>

                <?php
                /**
                 * This PHP block will print an error message if no event is selected.
                 */

                 //We print it
                 if ($event == null) {
                    echo "<p style='color: red;'>You didn't select an event. Return to the event list and select one.</p>";
                    echo "<div style='margin-bottom: 20px'>
                            <a href='events.php' class='btn btn-danger'>Return to events table</a>
                        </div>";
                    exit();
                 }
                 
                ?>

                <div id="results">
                    <div style="margin-bottom: 20px">
                        <p>You have selected to buy tickets for event ID <strong><?php echo $event; ?></strong>.</p>
                    </div>
                    <form method="<?= $formMethod ?>">
                        <div style="margin-bottom: 20px">
                            <label>How many tickets? </label>
                            <input type="number" name="tickets" min="1">
                            <input type="hidden" name="events" value="<?php echo htmlspecialchars($event); ?>"> 
                        </div>
                        <div style="margin-bottom: 20px">
                            <button type="submit" name="buy">Buy tickets!</button>
                        </div>
                        <div style="margin-bottom: 20px">
                            <a href="events.php" class="btn btn-danger">Cancel operation</a>
                        </div>
                    </form>
                    

                    <?php
                    /**
                    * This PHP block manages the total price for the tickets.
                    */

                    //We create a div for format and the total price
                    if ($tickets != null and $event !=null) {
                        echo "<div class='totalprice'>";
                        echo utils\printTotalPrice($eventFile, $event, $tickets);
                        echo "</div>";
                    } 

                    ?>

                </div>
            </div>
        </div>
        <?php include_once "footer.php";?>
    </body>
</html>