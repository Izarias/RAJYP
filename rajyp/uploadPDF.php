<?php
	if(!empty($_FILES["data"])){			
		upload('cronograma', 'data');
	} else if(!empty($_FILES["checklist"])){
		upload('checklist', 'checklist');
	} else {
		echo "Falha ao armazenar ficheiro!";
		header("Location: main.php");
		return;
	}
	
	function upload($fileName, $file) {
		session_start();
		$target_dir = 'users/' . $_SESSION["email"] . '/' . $_SESSION["id"] . '/';
		/*try {
			mkdir($target_dir, 0777, true);
		} catch (Exception $e){
			echo $e->getMessage() . '<br>';
		}*/
		
		if(!is_dir($target_dir)){
			mkdir($target_dir, 0777, true);
		}
		
		$target_file = $target_dir . $fileName . '.pdf';
		
		if(is_file($target_file)){
			unlink($target_file);
		}
		
		if (move_uploaded_file($_FILES[$file]["tmp_name"], $target_file)) {
			echo "Ficheiro armazenado com sucesso!";
			return;
		} else {
			echo "Falha ao armazenar ficheiro!";
			return;
		}
	}
?>