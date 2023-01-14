<?php
	session_start();
	if(!isset($_SESSION["email"]) && !isset($_SESSION["id"])){
		header("Location: index.php");
	} else {
		include 'conexao.php';
		
		$sql = "SELECT * FROM Projeto WHERE id='" . $_SESSION["id"] . "';";
		$resultado = $conn->query($sql);
		if($resultado = $resultado->fetch_assoc()){
			$nome = $resultado["titulo"];
		}
	}
	
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Checklist</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style/estilo.css">
		<script src="script/jquery-3.2.1.min.js";></script>
		<script src="script/jspdf.min.js"></script>
		<script src="script/html2canvas.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style>
			body {
				background-image: none;
			}
			
			.header {
				background-color: black;
				color: white;
			}
		</style>
	</head>
	<body>
		<div class="row spacer">
			<table border="0px" class="checklist" id="renderPDF2">
				<tr class="header">
					<th>Cronograma:</th>
					<th><?php echo $nome ?></th>
				</tr>
				<tr>
					<th><label for="analise">Análise de Viabilidades</label></th>
					<td><input type="checkbox" class="checklistCheck" id='analise'><div class="loader"></div><div class="check"></div></td>
				</tr>
				<tr>
					<th><label for="definicao">Definição de objetivo</label></th>
					<td><input type="checkbox" class="checklistCheck"  id='definicao'><div class="loader"></div><div class="check"></div></td>
				</tr>
				<tr>
					<th><label for="planejamento">Planejamento</label></th>
					<td><input type="checkbox" class="checklistCheck"  id='planejamento'><div class="loader"></div><div class="check"></div></td>
				</tr>
				<tr>
					<th><label for="elicitacao">Elicitação dos Requisitos</label></th>
					<td><input type="checkbox" class="checklistCheck" id='elicitacao'><div class="loader"></div><div class="check"></div></td>
				</tr>
				<tr>
					<th><label for="especificacao">Especificação dos Requisitos</label></th>
					<td><input type="checkbox" class="checklistCheck" id='especificacao'><div class="loader"></div><div class="check"></div></td>
				</tr>
				<tr>
					<th><label for="gerenciamento">Gerenciamento dos Requisitos</label></th>
					<td><input type="checkbox" class="checklistCheck" id='gerenciamento'><div class="loader"></div><div class="check"></div></td>
				</tr>
				<tr>
					<th><label for="design">Design</label></th>
					<td><input type="checkbox" class="checklistCheck" id='design'><div class="loader"></div><div class="check"></div></td>
				</tr>
				<tr>
					<th><label for="modelagem">Modelagem do Sistema</label></th>
					<td><input type="checkbox" class="checklistCheck" id='modelagem'><div class="loader"></div><div class="check"></div></td>
				</tr>
				<tr>
					<th><label for="codificacao">Codificação</label></th>
					<td><input type="checkbox" class="checklistCheck" id='codificacao'><div class="loader"></div><div class="check"></div></td>
				</tr>
				<tr>
					<th><label for="testes">Testes</label></th>
					<td><input type="checkbox" class="checklistCheck" id='testes'><div class="loader"></div><div class="check"></div></td>
				</tr>
				<tr>
					<th><label for="implantacao">Implantação</label></th>
					<td><input type="checkbox" class="checklistCheck" id='implantacao'><div class="loader"></div><div class="check"></div></td>
				</tr>
			</table>
		</div>
		
		<div class="row spacer">
			<button class="botinha" onclick="getPDF()">Salvar</button>
		</div>
	</body>
	
	<script>
		$().ready(function(){
			a = null;
			
			$("label").on("click", function(evt){
				a = evt.currentTarget.parentElement.parentElement.children[1].children[1];
				if(a.previousElementSibling.checked){
					a.style.visibility = 'hidden';
					a.style.display = 'inline-block';
					a.nextElementSibling.style.display = 'none';	
				} else {
					a.style.visibility = 'visible';
					animate(a);
				}
			});
			
			cache_width = $('#renderPDF2').width();
			a4  =[ 595.28,  841.89]; 
		});
		
		function animate(div){
				
			setTimeout(function(){
				div.style.display = 'none';
				div.nextElementSibling.style.display = 'inline-block';
			}, 1000);
		}
		
		function getPDF(){
			$("#renderPDF2").width((a4[0]*1.33333) -80).css('max-width','none');
			html2canvas($('#renderPDF2'), {
			  onrendered: function(canvas) {
				var img = canvas.toDataURL("image/png",1.0);  
				var doc = new jsPDF({unit:'px', format:'a4'});
				
				var dados = new FormData();
				
				doc.addImage(img, 'JPEG', 20, 20);
				doc.save("<?php echo $_SESSION["email"] . '/' . $_SESSION["id"]?>/checklist.pdf");
				
				var pdf = doc.output('blob');
				dados.append('checklist', pdf);
				$('#renderPDF2').width(cache_width);
				
				aaa = dados;
				
				upload(dados);		
			  }
			});
		}
		
		function upload(data) {
			var xhtml = new XMLHttpRequest();
			xhtml.onreadystatechange = function(){
				if(this.status == 200 && this.readyState == 4){
					alert(this.responseText);
				}
			};
			xhtml.open("POST", "uploadPDF.php", true);
			xhtml.send(data);
		}
	</script>
</html>