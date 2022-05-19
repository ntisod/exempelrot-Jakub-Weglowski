<html>

<head>
<link rel="stylesheet" type="text/css" href="style.css">

</head>
<?php
define('BASEPATH', true);
require('../Pform/db.php'); 

 if(isset($_POST['submit'])){  
        try {
            $dsn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
         $user = $_POST['username'];
         $email = $_POST['email'];
         $pass = $_POST['password'];
         
         //encrypt password
         $pass = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));
          
         //Check if username exists
         $sql = "SELECT COUNT(username) AS num FROM admin WHERE username =      :username";
         $stmt = $pdo->prepare($sql);

         $stmt->bindValue(':username', $user);
         $stmt->execute();
         $row = $stmt->fetch(PDO::FETCH_ASSOC);

         if($row['num'] > 0){
             echo '<script>alert("Username already exists")</script>';
        }
        
       else{

    $stmt = $dsn->prepare("INSERT INTO admin (username, email, password) 
    VALUES (:username,:email, :password)");
    $stmt->bindParam(':username', $user);    
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $pass);
    header("login.php");
    

   if($stmt->execute()){
    echo '<script>alert("New account created.")</script>';
    header('location: login.php');
    echo '<script>window.location.replace("index.php")</script>';
     
   }else{
       echo '<script>alert("An error occurred")</script>';
   }
}
}catch(PDOException $e){
    $error = "Error: " . $e->getMessage();
    echo '<script type="text/javascript">alert("'.$error.'");</script>';
}
     }    
?>

<form action="register.php" method="post">
<div class="img-box">
<img src="https://i.ibb.co/SKSn7Tj/heracles.png" alt="Avatar" style="width:200px" class="center">
</div>
<div class="header">
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="username" name="username">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password" id="ShowPassword">
  	</div>
    <input type="checkbox" onclick="ShowPasswordFunction()"><p1> Show password</p1>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="submit">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
</div>
</form>
</div>
<script>
function ShowPasswordFunction() {
  var x = document.getElementById("ShowPassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
  </html>