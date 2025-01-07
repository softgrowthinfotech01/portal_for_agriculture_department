<?php 
session_start();
$name=$_POST['name'];
$value=$_POST['value'];
$_SESSION[$name]=$value;
?>
