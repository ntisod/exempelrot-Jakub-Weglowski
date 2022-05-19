<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    
</head>
<body>
    

<?php
$arrFiles = array();
$handle = opendir('C:\WSP1\exempelrot-Jakub-Weglowski\Uppgifter-Lista');
 
if ($handle) {
    while (($entry = readdir($handle)) !== FALSE) {
        $arrFiles[] = $entry;
    }
}
 
closedir($handle);
?>



</body>
</html>