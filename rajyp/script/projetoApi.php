<?php
	function getId(){
		
		include 'conexao.php';

		$sql = "select id from Projeto where usuario_email = '" . $_SESSION["email"] . "';";
		$resultado = $conn->query($sql);
		$maior = 0;
		while($linha = $resultado->fetch_assoc()){
			if($linha["id"] > $maior) {
				$maior = $linha["id"];
			}
		}
		
		return $maior;
	}
?>