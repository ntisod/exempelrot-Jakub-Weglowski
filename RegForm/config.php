<?php
$dsn = 'mysql:dbname=register;host=localhost';
$user = 'PHP-User';
$password = 'qh[x)I5vacu3rjZ_';

try
{
	$pdo = new PDO($dsn,$user,$password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo "PDO error".$e->getMessage();
	die();
}
?>