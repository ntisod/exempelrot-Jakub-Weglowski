<?php
    session_start();
?>

<html>
    
<head>
<link rel="stylesheet" type="text/css" href="style.css">

</head>
<?php
define('BASEPATH', true); //access connection script if you omit this line file will be blank
require('../Pform/db.php'); //require connection script

if(isset($_POST['submit'])){  
        // try {
            $dsn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //ensure fields are not empty
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;
    
    //Retrieve the user account information for the given username.
    $sql = "SELECT id, username, password FROM admin WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    
    //Bind value.
    $stmt->bindValue(':username', $username);
    
    //Execute.
    $stmt->execute();
    
    //Fetches information.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
    //If $row is false statement.
    if($user == false){
       echo '<script>alert("invalid username")</script>';
    } else{
         
        //Compare and decrypt passwords.
        $validPassword = password_verify($passwordAttempt, $user['password']);
        
        //If validPassword is true.
        if($validPassword){

            //Re-directs user.

            $_SESSION['admin'] = $username;
           //Removed something here temporaraly (Do not tinker with this u stupid elias, u will ruin it.)

           $v1 = $_POST['username'];
           $v2 = $_POST['password'];
           $v3 = $_POST['username'];
           $v4 = $_POST['password'];
           if ($v1 == $v3 && $v2 == $v4) {
               $_SESSION['luser'] = $v1;
               $_SESSION['start'] = time(); // Taking now logged in time.
               // Ending a session in 1 minutes from the starting time.
               $_SESSION['expire'] = $_SESSION['start'] + (1 * 60);
               echo '<script>window.location.replace("index.php");</script>';
           } else {
               echo "Please enter the username or password again!";
           }

            exit;

        } else{
            //If password false, then print this message..
            echo '<script>alert("invalid password")</script>';
        }
    }
    }
?>

<body>
<form action="login.php" method="post">  
<div class="img-box">
<img src="https://i.ibb.co/SKSn7Tj/heracles.png" alt="Avatar" style="width:200px" class="center">
</div>
<div class="header">
    <div class="input-group">
        <label>Username</label>
        <input type="username" name="username" placeholder="Username">
    </div>

    <div class="input-group">
  		<label>Password</label>
        <input type="password" name="password" placeholder="Password" id="ShowPassword">   
  	</div>
      <input type="checkbox" onclick="ShowPasswordFunction()"><p1>Show password</p1>
  	<div class="input-group">
      <button name="submit" type="submit">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
</div>
  </form>

 <script>
function ShowPasswordFunction() {
  var x = document.getElementById("ShowPassword");
  if (x.type === "password") {
    x.type = "text";
  } 
  else {
    x.type = "password";
  }
}
</script>

</body>
 </html>