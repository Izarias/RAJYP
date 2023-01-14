<?php
	if(isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response'] != ''){
		$google =  $_POST['g-recaptcha-response'];
	} else {
		goToIndex('0');
		return;
	}

	$secret = "6LdygjgUAAAAAFEJ1dURCZ8vOzKhpIgO-EaBNbFt";
	$resposta = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$google."&remoteip=".$_SERVER["REMOTE_ADDR"]), true);

	if(!$resposta["success"]){
		goToIndex('0');
		return;
	}

	if(!isset($_POST["primeiroNome"])){
		header('Location: index.php');
	} else {
		include 'conexao.php';

		$dir = registrarFoto();
		if($dir == ''){
			$dir = "users/unknown.png";
		}

		echo $dir;
		$primeiroNome = $_POST['primeiroNome'];
		$segundoNome = $_POST['segundoNome'];
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		$nascimento = $_POST['nascimento'];
		$estado = $_POST['estado'];
		$cidade = $_POST['cidade'];
		$sexo = $_POST['sexo'];

		echo $nascimento;

		$q = $conn->query("SELECT * FROM Usuario WHERE EMAIL = '" . $email . "';");
		if($q->num_rows > 0){
			goToIndex('3');
			return;
		} else {
			$sql = "INSERT INTO Usuario(primeiroNome,sobrenome, email, senha, dataDeNascimento, estado, cidade, sexo, foto) " .
				"values('$primeiroNome', '$segundoNome', '$email', '$senha', '$nascimento', '$estado', '$cidade', '$sexo', '$dir');";
			if($conn->query($sql)){
				criarSessao($email);
				header("Location: main.php");
			} else {
				echo "<br>". $conn->error . "<br>";
			}
		}
	}

	function criarSessao($email) {
		session_start();
		$_SESSION['email'] = $email;
	}

	function registrarFoto() {
		$target_dir = 'users/' . $_POST['email'] . '/';
		if(!is_dir($target_dir)){
			mkdir($target_dir, 0777, true);
		}
		$imageFileType = pathinfo($target_dir . basename($_FILES["foto"]["name"]), PATHINFO_EXTENSION);
		$target_file = $target_dir . 'profile.' . $imageFileType;
		$uploadOk =  1;


		if ($_FILES["foto"]["size"] > 500000) {
			goToIndex('1');
			$uploadOk = 0;
		} else if ($imageFileType != 'png' && $imageFileType != 'jpg') {
			$uploadOk = 0;
		}

		if ($uploadOk == 0) {
			goToIndex('2');
			return;
		} else {
			clearDir($target_dir);
			if (!move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
				goToIndex('2');
				return;
			} else {
				return $target_file;
			}
		}
	}

	function clearDir($dir){
		if(is_file($dir . 'profile.jpg')) {
			unlink($dir . 'profile.jpg');
		} else if (is_file($dir . 'profile.png')) {
			unlink($dir . 'profile.png');
		}
	}

	function goToIndex($error = '') {
		if($error != '') {
			header("Location: index.php?erro=$error");
		} else {
			header("Location: index.php");
		}
	}

?>
