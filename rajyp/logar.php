<?php
	include "conexao.php";
	
	$login = $_POST["login"]; 
	$pass = $_POST["pass"];
	
	$sql = "SELECT * FROM Usuario WHERE email = '" . $login . "' AND senha = '" . $pass . "';";
	$resultado = $conn->query($sql);
	if($resultado->num_rows > 0) {
		session_start();
		$_SESSION["email"] = $login;
		header("Location: main.php");
	} else {
		header("Location: index.php?erro=4");
	}
?>
