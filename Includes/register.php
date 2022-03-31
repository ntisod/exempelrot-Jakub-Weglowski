<html>

<head>
<style>
    input[type="password"] {
        background-color: #000000;
}
</style>
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
    //redirect to another page
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
<img src="https://i.ibb.co/MVLXwKS/imgonline-com-ua-Replace-Color-z-Jjn-Z4ki4x-Y1-removebg-preview.png" alt="Avatar" style="width:200px">
</div>
<br>
  <input type="text" required="required" name="username" placeholder="Username">
  <br>
  <input required="required" type="email" name="email" placeholder="Email">
  <br>
  <input type="checkbox" onclick="ShowPasswordFunction()"><p1>Show password</p1>
  <input required="required" type="password" name="password" placeholder="Password" id="ShowPassword">   
  <br> <br>               
  <button name="submit" type="submit">Register</button>
  </form>
  
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