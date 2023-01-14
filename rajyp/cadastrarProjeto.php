<?php
	
	include 'conexao.php';
	include 'script/projetoApi.php';
	session_start();
	
	$titulo = $_POST["titulo"];
	$descricao = $_POST["descricao"];
	$orientador = $_POST["orientador"];
	$participantes = $_POST["participantes"];
	
	$sql = "insert into Projeto(titulo, descricao, orientador, participantes, usuario_email) values ('$titulo', '$descricao','$orientador','$participantes', '" . $_SESSION["email"] . "');";
	if($conn->query($sql)){
		header("Location: projeto.php?id=" . getId() . "&reload=true");		
	} else {
		header("Location: cadastroProjeto.php?erro=" . $conn->error);
	}
	
?>