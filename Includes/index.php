<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">

</head>
<?php 
  session_start();

  if (!isset($_SESSION['luser'])) {
      echo "Please Login";
      echo "<br>";
      echo "<a href='login.php'> Click Here to Login </a>";
      echo "<br>";
      echo "<a href='register.php'> Or Here to Register / Add Users </a>";
  }
  else {
      $now = time(); // Checking the time now when home page starts.

      if ($now > $_SESSION['expire']) {
          session_destroy();
          echo "Your session has expired!";
          echo "<br>"; 
          echo "<a href='login.php'> Login here </a>";
      }
      else { //Starting this else one [else1]
?>
</html>
          <!-- From here all HTML coding can be done -->
          <html>
            <head>
              <link rel="stylesheet" type="text/css" href="style.css">
            </head>
              Welcome
              <?php
                    echo $_SESSION['luser'];
                    echo "<br>";
                    echo "<a href='logout.php'> Log out </a>";
              ?>
              <body>
                
              </body>
        </html>
<?php
      }
  }
?>