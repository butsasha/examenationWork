<?php
include 'class/database.php'; 
$username = 'but';
$password = '3105044';
$host	  = '94.244.128.42';
$base	  = 'cw';

$db = new Database(array(
		'host' => $host,
		'username' => $username, 
		'password' => $password,
		'db'=> $base,
		'charset' => 'utf8'));
?>