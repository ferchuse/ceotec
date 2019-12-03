<?php 
session_start();
if (isset($_SESSION['usuario'])) {
}
else{
	header("location:login/main_login.php");
}
?>
