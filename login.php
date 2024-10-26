<?php
/**
 * This PHP block manages the session and imports the utils.
 */
use uf1pt1utils as utils;
include "utils/utils.php";

//We start the session
session_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>DemoEvents - Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

  <?php
  /**
   * This PHP block manages the retrieval of login data.
   */

  //Attributes
  $formMethod = "POST";
  $userFile = "utils/users.txt";

  //We retrieve the data
  if ($formMethod == "POST") {
    if (isset($_POST["username"]) and isset($_POST["password"])) {
      $username = htmlspecialchars($_POST["username"]);
      $password = htmlspecialchars($_POST["password"]);
    }
  } else {
    if (isset($_GET["username"]) and isset($_GET["password"])) {
      $username = htmlspecialchars($_GET["username"]);
      $password = htmlspecialchars($_GET["password"]);
    }
  }

  ?>

  <?php include_once "topmenu.php";?>
  <div class="container-fluid">
    <div class="container">
      <div class="form">
      <h2>Login form</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
          <div class="form-group">
            <label for="username">Username:</label>
            <input type="username" class="form-control" id="username" placeholder="Enter username" name="username">
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
          </div>
          <div style="margin-bottom: 20px">
            <button type="submit" name="loginsubmit" class="btn btn-primary">Submit</button>
          </div>
          <div style="margin-bottom: 20px">
            <a href="index.php" class="btn btn-danger">Return to home page</a>
          </div>
        </form>
      </div>
    </div>

    <?php
    /**
     * This PHP block manages the validation to login the user.
     */
    
     //Attributes
     $role = utils\validateLogin($userFile, $username, $password);
    
     //We create the session and log in the user
     if ($role != null) {
      $_SESSION["username"] = $username;
      $_SESSION["role"] = $role;
      header("Location: index.php");
     }

    ?>

  </div>
  <?php include_once "footer.php";?>
</body>
</html>