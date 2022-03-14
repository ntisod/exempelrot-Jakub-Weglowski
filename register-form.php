<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: red;}

*,
        *:before,
        *:after {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }
        /* This is a scrollbar design */
        
         ::-webkit-scrollbar {
            width: 13px;
            height: 13px;
        }
        
         ::-webkit-scrollbar-thumb {
            background: linear-gradient(13deg, #820263 14%, #820263 64%);
            border-radius: 10px;
        }
        
         ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(13deg, #820263 14%, #820263 64%);
        }
        
         ::-webkit-scrollbar-track {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: inset 7px 10px 12px #f0f0f0;
        }
        /* h1 style (design) */
        
        h1 {
            font-size: 36px;
            background: -webkit-linear-gradient(13deg, #820263 14%, #820263 62%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        /* This code changes the appearance of the body (the page itself) */
        
        body {
            font-family: 'Nunito', sans-serif;
            color: #384047;
        }

        button {
            padding: 19px 39px 18px 39px;
            color: #FFF;
            font-size: 18px;
            text-align: center;
            font-style: normal;
            border-radius: 5px;
            width: 100%;
             
        }
        button, input[type="submit"]{
          background: #820263;
          color: white;
          border-style: outset;
          border-color: #820263;
          height: 35px;
          width: 70px;
          font: bold 14px arial,sans-serif;
          text-shadow:#384047 ;
          margin-bottom: 10px;
          border-width: 1px 1px 3px;
          text-align: center;
        }

        /* This code changes the appearance of h1 */
        
        h1 {
            margin: 0 0 30px 0;
            text-align: center;
        }
        p {
          text-align: center;
        }
        /* This code changes the appearance / placment of the area where everything is displayed */
        textarea,
        select {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            font-size: 16px;
            height: auto;
            margin: 0;
            outline: 0;
            padding: 15px;
            width: 100%;
            background-color: #e8eeef;
            color: #8a97a0;
            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.03) inset;
            margin-bottom: 30px;
        }
        
        input[type="radio"],
        input[type="checkbox"] {
            margin: 0 4px 8px 0;
        }
        /* This code changes the appearance of the select command */
        
        select {
            padding: 6px;
            height: 32px;
            border-radius: 2px;
        }
        /* This code changes the appearance of the button command */
        
        
        /* This code changes the appearance of the fieldset command */
        
        fieldset {
            margin-bottom: 30px;
            border: none;
        }
        /* This code changes the appearance of the legend command */
        
        legend {
            font-size: 1.4em;
            margin-bottom: 10px;
        }
        /* This code changes the appearance of the label command */
        
        label {
            display: block;
            margin-bottom: 8px;
        }
        /* his code changes the appearance of the label choice command */
        
        label.CHOICE2 {
            font-weight: 300;
            display: inline;
        }
        /* This code changes the appearance of the numbers that are displayed in legends / span */
        
        .number {
            background-color: #78f5ea;
            color: #fff;
            height: 30px;
            width: 30px;
            display: inline-block;
            font-size: 0.8em;
            margin-right: 4px;
            line-height: 30px;
            text-align: center;
            text-shadow: 0 1px 0 rgba(255, 255, 255, 0.2);
            border-radius: 100%;
        }
        /* This code changes the placment of the application on screen */
        
        @media screen and (min-width: 480px) {

          /* This code changes the appearance of the form */
          form {
            max-width: 500px;
            margin: 0px auto;
            padding: 10px 20px;
            background: #f4f7f8;
        }
        }
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-pmail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
    
  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Invalid URL";
    }    
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h1>PHP Form Example</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  <p1 class="fr">Name: </p> <input type="text" name="name">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  <p1 class="fr">E-mail: </p> <input type="text" name="email">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  <p1 class="fr">Website: </p> <input type="text" name="website">
  <span class="error"><?php echo $websiteErr;?></span>
  <br><br>
  <p1 class="fr">Comment: </p> <textarea name="comment" rows="5" cols="40"></textarea>
  <br><br>
  Gender:
  <input type="radio" name="gender" value="female">Female
  <input type="radio" name="gender" value="male">Male
  <input type="radio" name="gender" value="other">Other
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<form method="POST" action="">
<?php 
echo "<h1>Your Input:</h1>";
echo "<p> Name: $name </p>";
echo "<br>";
echo "<p> E-mail: $email </p>";
echo "<br>";
echo "<p> Website: $website </p>";
echo "<br>";
echo "<p> Comment: $comment </p>";
echo "<br>";
echo "<p> Gender: $gender </p>";
?>
</form>

</body>
</html>