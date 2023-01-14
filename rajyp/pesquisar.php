<?php
	session_start();
	if(!isset($_SESSION["email"]) && !isset($_POST["q"])){
		header("Location: projeto.php");
		return;
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
    <style>
      body {
        background-image: none;
      }
    </style>
		<!--<link href='https://fonts.googleapis.com/css?family=Aladin' rel='stylesheet'>-->
	</head>

	<body class="body100">
    <div class="row clear">
      <?php
        include 'conexao.php';

        $q = $_POST["q"];

        $sql = "SELECT id, usuario_email, titulo FROM Projeto where titulo like '%". $q . "%';";
        $resultado = $conn->query($sql);
        if($resultado->num_rows > 0) {
          while($linha = $resultado->fetch_array()) {
            echo "<div class='row clear botinha'><a style='text-decoration: none; color: black;' href='navegar.php?email=" . $linha["usuario_email"] . "&id=" . $linha["id"] . "&tipo=cronograma'>" . $linha["titulo"] . " - Cronograma</a></div>";
            echo "<div class='row clear botinha'><a style='text-decoration: none; color: black;' href='navegar.php?email=" . $linha["usuario_email"] . "&id=" . $linha["id"] . "&tipo=checklist'>" . $linha["titulo"] . " - Checklist</a></div>";
          }
        } else {
          echo "<div class='row clear botinha'><h2>Nenhum resultado encontrado!</h2></div>";
        }
      ?>
    </div>
	</body>
</html>
