<?php
  if(!isset($_GET["email"]) && !isset($_GET["id"]) && !isset($_GET["tipo"])) {
      header("Location: projeto.php");
  } else {
    $email = $_GET["email"];
    $id = $_GET["id"];
    $tipo = $_GET["tipo"];

    if($tipo == 'cronograma') {
      if (is_file("users/" . $email . "/" . $id . "/cronograma.pdf")) {
        header("Location: " . "users/" . $email . "/" . $id . "/cronograma.pdf");
      } else {
        header("Location: projeto.php");
      }
    } else if ($tipo == 'checklist') {
      if (is_file("users/" . $email . "/" . $id . "/checklist.pdf")) {
        header("Location: " . "users/" . $email . "/" . $id . "/checklist.pdf");
      } else {
        header("Location: projeto.php");
      }
    } else {
      header('Location: index.php');
      return;
    }
  }
?>
