<?php
/**
 * This PHP block manages the session and imports the utils.
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
        <title>DemoEvents - Event Table</title>
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
                <h2>Events</h2>

                <?php
                /**
                 * This block manages the form action and
                 * attributes.
                 */
                

                //Attributes
                $formMethod = "POST";
                $categoryFile = "utils/categories.txt";
                $eventFile = "utils/events.txt";
        

                //We check if the form has been submitted
                if ($_SERVER["REQUEST_METHOD"] == $formMethod) {

                    //We retrieve the data
                    if ($formMethod == "POST") {
                        $category = $_POST["categories"];
                    } else {
                        $category = $_GET["categories"];
                    }
        
                }
                ?>

                <div id="forms">
                    <form method="<?= $formMethod ?>">
                        <label>Select a category: </label>

                        <?php
                        /**
                        * This PHP block prints the select for the category of events.
                        */
                    
                        //We print the select and the table
                        echo utils\getCategorySelect($categoryFile);

                        ?>

                        <?php
                        /**
                         * This PHP block prints the table for the events.
                         */

                        //We print the table
                        echo utils\printTable($eventFile, $category);

                        ?>
                    </form>

                    <form method="<?= $formMethod ?>" action="buy_results.php"> 
                        <div style="margin-bottom: 20px">
                        <label>Which event do you wanna buy tickets for?: </label>

                            <?php
                            /**
                            * This PHP block prints the select for the events.
                            */

                            //We print the select
                            echo utils\getEventSelect($eventFile, $category);

                            ?>

                        </div>
                        
                        <div style="margin-bottom: 20px;">
                            <button type="submit" class="btn btn-primary">Continue with the selection</button>
                        </div>
                    </form>        
                </div>
            </div>  
        </div>
        <?php include_once "footer.php";?>
    </body>
</html>