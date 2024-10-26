<?php
/**
 * Utils file for the UF1PT1 webpage.
 * Created by Carlos Carvajal Ramos, 12/10/2024.
 */

namespace uf1pt1utils;

//Methods

/**
 * This method reads the category file and returns a select
 * with its options. It prints a red error message if it can't
 * access the file correctly.
 * @param filename as the file path to read
 * @return select if read correctly
 */
function getCategorySelect($filename) {

    //We check if file exists and is readable
    if (file_exists($filename) and is_readable($filename)) {

        //We try to open the file and read it
        if (($file = fopen($filename, "r")) !== FALSE) {

            //We init the select, flag to skip first line and read line by line
            $select = "<select name='categories' onchange='this.form.submit()'>";
            $firstLineSkipped = false;
            while(($line = fgetcsv($file, 0, ";")) !== FALSE) {
                if ($firstLineSkipped == true) {
                    $id = $line[0];
                    $desc = $line[1];
                    $select .= "<option value='$id'>$desc</option>";
                } else {
                    $select .= "<option>(Select an option)</option>"; //We add an empty option
                    $firstLineSkipped = true;
                }
            }

            //We close the file
            fclose($file);

            //We close the select and return it
            $select .= "</select>";
            return $select;

        } else {
            echo "<p style='color: red;'>File could not be readed.</p>";
        }

    } else {
        echo "<p style='color: red;'>File wasn't found or isn't readable.</p>";
    }

}

/**
 * This function reads the events file and returns a select
 * with the events its category matches with the id of the one selected
 * from the user. If the file isn't read, it displays a red error message.
 * @param filename as the file path
 * @param catSelected as the category selected
 * @return select if read correctly
 */
function getEventSelect($filename, $catSelected) {

    //We check if the file is readable and exists
    if (file_exists($filename) and is_readable($filename)) {

        //We try to open the file and read it
        if (($file = fopen($filename, "r")) !== FALSE) {
            
            //We init the select, create a flag to skip first line and read line by line
            $select = "<select name='events'>";
            $firstLineSkipped = false;
            while (($line = fgetcsv($file, 0, ";")) !== FALSE) {
                if ($firstLineSkipped == true) {
                    if ($line[1] == $catSelected) { //If categories match
                        $id = $line[0];
                        $name = $line[2];
                        $select .= "<option value='$id'>$name</option>";
                    }
                } else {
                    $firstLineSkipped = true;
                }
            }

            //We close the file
            fclose($file);

            //We close the select and return it
            $select .= "</select>";
            return $select;

        } else {
            echo "<p style='color: red;'>File could not be read.</p>";
        }

    } else {
        echo "<p style='color: red;'>File was not found or isn't readable.</p>";
    }

}

/**
 * This function prints a table with the events corresponding to
 * the category selected by the user. If the file can't be read, it prints a
 * red error message.
 * @param filename as the file path
 * @param catSelected as the category selected
 * @return table if read correctly
 */
function printTable($filename, $catSelected) {

    //We check if the file exist and is readable
    if (file_exists($filename) and is_readable($filename)) {

        //We try to open the file
        if (($file = fopen($filename, "r")) !== FALSE) {

            //We init the table and create a flag to skip the first line
            $table = "<table style='width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; margin: 20px 0; border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);'>";
            $table .= "<tr>";
            $table .= "<td style='background-color: #df4700; padding: 10px; text-align: center'><strong>Event</strong></td>";
            $table .= "<td style='background-color: #df4700; padding: 10px; text-align: center'><strong>Price (€)</strong></td>";
            $table .= "</tr>";
            $firstLineSkipped = false;
            while (($line = fgetcsv($file, 0, ";")) !== FALSE) {
                if ($firstLineSkipped == true) {
                    if ($line[1] == $catSelected) {
                        $name = $line[2];
                        $price = $line[3];
                        $table .= "<tr>";
                        $table .= "<td style='padding: 10px; text-align: center; background-color: #f2f2f2'>$name</td>";
                        $table .= "<td style='padding: 10px; text-align: center; background-color: #f2f2f2'>$price</td>";
                        $table .= "</tr>";
                    }
                } else {
                    $firstLineSkipped = true;
                }
            }
            
            //We close the file
            fclose($file);

            //We close the table and return it
            $table .= "</table>";
            return $table;

        } else {
            echo "<p style='color: red;'>File could not be read.</p>";
        }

    } else {
        echo "<p style='color: red;'>File was not found or isn't readable.</p>";
    }

}

/**
 * This function prints the total price of the tickets selected by the user, depending
 * on the event. If the file can't be read, it prints a red error message.
 * @param mixed $filename as the file path
 * @param mixed $event as the id of the event selected
 * @param mixed $tickets as the quantity of tickets
 * @return html as the paragraph for total price
 */
function printTotalPrice($filename, $event, $tickets) {

    //We check if the file exists and is readable
    if (file_exists($filename) and is_readable($filename)) {

        //We try to open the file
        if (($file = fopen($filename, "r")) !== FALSE) {

            //We init the p and create a flag to skip the first line
            while (($line = fgetcsv($file, 0, ";")) !== FALSE) {
                if ($line[0] == $event) {
                    $name = $line[2];
                    $price = $line[3];
                    $total = $price * $tickets;
                    $html = "<p style='margin-top: 20px 0; font-size: 20px; font-weight: bold;'>You selected a total of $tickets tickets for $name.</p>";
                    $html .= "<p style='margin-top: 20px 0; font-size: 20px; font-weight: bold;'>The total price is: $total €</p>";
                    break;
                }
            }
            
            //We close the file
            fclose($file);

            //We return the html
            $html .= "<p style='margin-top: 20px 0; font-size: 15px; font-weight: bold;'>We hope you enjoy it!</p>";  
            return $html;

        } else {
            echo "<p style='color: red;'>File could not be read.</p>";
        }

    } else {
        echo "<p style='color: red;'>File was not found or isn't readable.</p>";
    }
}

/**
 * This function registers a new user in the users file if its username is not
 * already in use and the format is valid.
 * @param filename as the file path
 * @param username as the username to register
 * @param password as the password to register
 * @param name as the name to register
 * @param surname as the surname to register
 * @return true if succeeded, false if not
 */
function registerNewUser($filename, $username, $password, $name, $surname) {
    
    //We check if the file exists and is readable
    if (file_exists($filename) and is_writable($filename) and is_readable($filename)) {

        //We try to open the file
        if (($file = fopen($filename, "a+")) !== FALSE) {

            //We check if the username is already in use with a flag
            $userExists = false;
            while (($line = fgetcsv($file, 0, ";")) !== FALSE) {
                if ($line[0] == $username) {
                    $userExists = true;
                    break;
                }
            }

            //If not in use, we write the data
            if ($userExists == false) {
                $role = "registered";
                $newUser = [$username, $password, $role, $name, $surname];
                fputcsv($file, $newUser, ";");
                fclose($file);
                return true;
            } else {
                echo "<p style='color: red;'>Username already in use. Choose another one.</p>";
                return false;
            }
        
        } else {
            echo "<p style='color: red;'>User DB couldn't be accessed.</p>";
            return false;
        }

    } else {
        echo "<p style='color: red;'>User DB couldn't be found or accessed.</p>";
        return false;
    }

}

/**
 * This function validates the login of a user.
 * @param filename as the file path
 * @param username as the username to validate
 * @param password as the password to validate
 * @return role if succeeded as the role of that user
 */
function validateLogin($filename, $username, $password) {

    //We check if the file exists and is readable
    if (file_exists($filename) and is_readable($filename)) {

        //We try to open the file
        if (($file = fopen($filename, "r")) !== FALSE) {

            //We check if the username is already in use with a flag
            $login = false;
            while (($line = fgetcsv($file, 0, ";")) !== FALSE) {
                if ($line[0] == $username and $line[1] == $password) {
                    fclose($file);
                    return $line[2];
                    break;
                }
            }

            //If not, we alert the user
            echo "<p style='color: red;'>Username or password are incorrect. Check your inputs.</p>";
            return null;

        } else {
            echo "<p style='color: red;'>User DB couldn't be accessed.</p>";
            return null;
        }

    } else {
        echo "<p style='color: red;'>User DB couldn't be found or accessed.</p>";
        return null;
    }
}

?>