<?php

	session_start();
	if(!isset($_SESSION["email"])) {
		header("Location: index.php");
	} else {
		include "conexao.php";
		$sql = "SELECT * FROM Usuario WHERE email = '" . $_SESSION["email"] . "';";
		$resultado = $conn->query($sql);
		$nome = $resultado->fetch_assoc();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style/estilo.css">
		<script src="script/jquery-3.2.1.min.js";></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>RAJYP - Sistema de Auxílio à Criação de Projetos de DPS</title>
		<!--<link href='https://fonts.googleapis.com/css?family=Aladin' rel='stylesheet'>-->
	</head>

	<body class="body100">
		<div class="row">
			<div class="col-12 navbar">
				<a href="index.php"><img src="images/logo/logo2.png" id="logo" width="125px" height="100px"></img></a>
					<div class="userRight sair">
						<a href="sair.php" class="botinha">Sair</a>
					</div>
					<div class="col-1 userRight">
						<p style="color: white;">Bem-vindo, <?php echo $nome["primeiroNome"];?></p>
					</div>
					<div class="userRight">
						<img src="<?php echo $nome["foto"]?>" width="50px" height="50px"></img>
					</div>
				</div>
			</div>
		</div>

		<div class="col-2 lateralBar">
			<form action="pesquisar.php" method="post" target="frame">
				<div class="row">
					<input type="text" name="q" id="search" placeholder="Pesquisar">
				</div>

				<div class="row" style="margin-top: 2%;">
					<button class="botinha">Enviar</button>
				</div>
			</form>

			<div class="row">
				<p class="shineBack">Meus projetos</p>
				<?php
					$sql = "SELECT * FROM Projeto WHERE usuario_email = '" . $_SESSION["email"] . "';";
					$result = $conn->query($sql);
					if($result->num_rows > 0){
						while($linha = $result->fetch_assoc()){
							echo '<p class="shineBack" style="background-color: yellow;color: black;"><a href="projeto.php?id=' . $linha["id"] . '" target="frame" style="text-decoration: none;">' . $linha["titulo"];
							echo '</a><a href="#" onclick="excluir(\'' . trim($linha["id"]) . '\');" class="spanred">x</a>' . '</p>';
						}
					} else {
						echo '<p class="shineBack">Nenhum projeto encontrado!</p>';
					}
				?>
				<a href="cadastroProjeto.php" class="botinha" target="frame">Cadastrar projeto</a>
			</div>
		</div>
		<div class="col-10 center">
			<iframe src="projeto.php" name="frame" ></iframe>
		</div>
		<script>

			function excluir(id) {
				if(confirm("Tem certeza que deseja apagar este projeto?")){
					var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function () {
						if(this.status == 200 && this.readyState == 4){
							alert(this.responseText);
							window.location.reload();
						}
					}
					xhttp.open("GET", "excluir.php?id="+id, true);
					xhttp.send();
				}
			}
		</script>
	</body>
</html>
