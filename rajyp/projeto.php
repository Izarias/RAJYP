<?php
	session_start();
	if(!isset($_SESSION["email"])){
		header("Location: index.php");
		return;
	} else {
		include 'conexao.php';		

		$email = $_SESSION["email"];
		$sql = "SELECT * FROM Projeto WHERE usuario_email = '$email';";
		$result = $conn->query($sql);
		if($result->num_rows == 0){
			header("Location: cadastroProjeto.php");
			return;
		} else {
			if(!isset($_GET["id"])) {
				include 'script/projetoApi.php';
				header("Location: projeto.php?id=" . getId());
				return;
			} else {
				$_SESSION["id"] = $_GET["id"];
			}
		}	
	}
	
	if(isset($_GET["reload"]) && $_GET["reload"] == 'true') {
		echo "<script>self.parent.location.reload();</script>";
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
	</head>
	
	<body class="body100">
		<div class="row imageLinks">
			<div class="col-3 imager whiter">
				<p><span class="spanred"><b>Titulo:</b></span> <?php 
					$sql = "select * from Projeto where id = " . $_GET["id"] . ";";
					$result = $conn->query($sql);
					$result = $result->fetch_assoc();
					echo $result["titulo"];
				?></p>
				<p><span class="spanred"><b>Orientador:</b></span> <?php echo $result["orientador"]?></p>
				<p><span class="spanred"><b>Descrição:</b></span> <?php echo $result["descricao"] ?></p>
				<p><span class="spanred"><b>Participantes:</b></span> <?php echo $result["participantes"];?></p>
			</div>
		
			<div class="col-3 imager">
				<a href="cronograma.php"><img src="images/icons/cronograma.jpg" width="300px" height="600px"></img></a>
			</div>
			
			<div class="col-3 imager">
				<a href="checklist.php"><img src="images/icons/checklists.jpg" width="300px" height="600px"></img></a>
			</div>
		</div>
	</body>
</html>