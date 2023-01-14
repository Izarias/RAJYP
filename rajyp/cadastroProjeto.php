<?php
	session_start();
	if(!isset($_SESSION["email"])){
		header("Location: index.php");
	} else {
		include 'conexao.php';

		$email = $_SESSION["email"];
		$sql = "SELECT * FROM Projeto WHERE usuario_email = '$email';";
		$result = $conn->query($sql);
		$msg = "Cadastrar novo projeto!";
		if($result->num_rows == 0){
			$msg = "Ops, você não tem nenhum projeto cadastrado! Cadastre um novo!";
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Projeto</title>
		<link rel="stylesheet" type="text/css" href="style/estilo.css">
		<script src="script/jquery-3.2.1.min.js";></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--<link href='https://fonts.googleapis.com/css?family=Aladin' rel='stylesheet'>-->
		<style>
			body {
				padding: 15% 10%;
			}
		</style>

	</head>
	
	<body class="body100">
		<div class="row">
			<div class="col-9 mensagemRegistro">
				<?php 
					echo $msg;
				?>
			</div>
		</div>
		
		<div class="row">
			<form method="POST" action="cadastrarProjeto.php">
				<div class="row">
					<div class="col-3 inputContainer">
						<input type="text" placeholder="Titulo" name="titulo" required>
					</div>
				</div>
					
				<div class="row">
					<div class="col-3 inputContainer">
						<input type="text" placeholder="Descrição" name="descricao" required>
					</div>
				</div>
					
				<div class="row">
					<div class="col-3 inputContainer">
						<input type="text" placeholder="Orientador" name="orientador" required>
					</div>
				</div>
				
				<div class="row">
					<div class="col-3 inputContainer">
						<input type="text" placeholder="Participantes" name="participantes" required>
					</div>
				</div>
				
				<div class="row">
					<div class="col-3 inputContainer">
						<input type="submit" value="Registrar" id="border"> 
						<?php
							if(isset($_GET["erro"])) {
								if($_GET["erro"] == 0){
									echo "<p style='color: red;'>Ocorreu um erro: code " . rand(0,9999) ."</p>";
								} else {
									echo $_GET["erro"];
								}
							}	
						?>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>