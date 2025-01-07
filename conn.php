<?php 
	$servername="localhost";
	$dbname="atmamaha_atma";
	$username="root";
	$password="";
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	date_default_timezone_set('Asia/Kolkata');
?>