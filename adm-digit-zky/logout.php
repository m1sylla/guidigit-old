<?php
if (isset($_POST['submit'])) {
	session_start();
	session_unset();
	session_destroy();
	header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/adm-digit-zky/gui-signin.php");
    exit();
	
}
?>