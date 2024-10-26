<!DOCTYPE html>
<html lang="es">
<head>
  <title>DemoEvents -Register</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

  <?php
  /**
   * This PHP block manages the form validation to register a new user.
   */
  use uf1pt1utils as utils;
  include "utils/utils.php";

  //Attributes
  $formMethod = "POST";
  $userFile = "utils/users.txt";

  //We retrieve the data
  if ($formMethod == "POST") {
    if (isset($_POST["username"]) and isset($_POST["password"]) and isset($_POST["name"]) and isset($_POST["surname"])) {
      $username = htmlspecialchars($_POST["username"]);
      $password = htmlspecialchars($_POST["password"]);
      $name = htmlspecialchars($_POST["name"]);
      $surname = htmlspecialchars($_POST["surname"]);
    }
  } else {
    if (isset($_GET["username"]) and isset($_GET["password"]) and isset($_GET["name"]) and isset($_GET["surname"])) {
      $username = htmlspecialchars($_GET["username"]);
      $password = htmlspecialchars($_GET["password"]);
      $name = htmlspecialchars($_GET["name"]);
      $surname = htmlspecialchars($_GET["surname"]);
    }
  }

  ?>

<?php include_once "topmenu.php";?>
<div class="container-fluid">
  <div class="container">
    <div class="form">
      <h2>Registration form</h2>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="<?= $formMethod ?>">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
        </div>
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
        </div>
        <div class="form-group">
          <label for="surname">Surname:</label>
          <input type="text" class="form-control" id="surname" placeholder="Enter surname" name="surname">
        </div>
        <div style="margin-bottom: 20px">
          <button type="submit" name="registersubmit" class="btn btn-primary">Register!</button>
        </div>
        <div style="margin-bottom: 20px">
          <a href="index.php" class="btn btn-danger">Return to home page</a>
        </div>
      </form>
    </div>
  </div>

  <?php
  /**
   * This block tries to register the user. If succeeded, it prints a message to the user.
   * Else, it prints an error message.
   */

   //We try to register the user
   if ($username != null and $password != null and $name != null and $surname != null) {
      $result = utils\registerNewUser($userFile, $username, $password, $name, $surname);
      if ($result == true) {
        echo "<p style='color: green;'>User <strong>$username</strong> was registered succesfully!</p>";
      }
   } 
  ?>

  

</div>
<?php include_once "footer.php";?>
</body>
</html>