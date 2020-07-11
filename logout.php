<?php
	session_start();
	unset($_SESSION["prisijunges"]);
	unset($_SESSION["vartotojo_vardas"]);
	unset($_SESSION["teises"]);
	unset($_SESSION["id"]);
    header('Location: index.php');

?>