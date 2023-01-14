<?php
	include 'conexao.php';

	session_start();
	if(isset($_GET["id"]) && isset($_SESSION["email"])){
		$id = $_GET["id"];
		$sql = "DELETE FROM Projeto where id = " . $id . ";";
		if($conn->query($sql)){
			clearDir('users/' . $_SESSION["email"] . "/" . $id . "/");
			echo "Projeto deletado com sucesso!";
		} else {
			echo "Um erro ocorreu. Tente novamente mais tarde!";
		}
	} else {
		header("Location: main.php");
		return;
	}

	function clearDir($dir){
		if(!is_dir($dir) && !is_file($dir)){
			return;
		} else if (!is_dir($dir) && is_file($dir)){
			unlink($dir);
			return;
		}

		foreach(scandir($dir) as $file){
			if($file == '.' || $file == '..'){
				continue;
			}

			unlink($dir . '/' . $file);
		}
		rmdir($dir);

	}
?>
