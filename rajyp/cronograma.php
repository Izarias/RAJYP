<?php
	session_start();
	if(!isset($_SESSION["email"])){
		header("Location: index.php");
	}
?>
<!DOCTYPE html>
<html class="a">
	<head>
		<meta charset="utf-8">
		<title>Projeto</title>
		<link rel="stylesheet" type="text/css" href="style/estilo.css">
		<script src="script/jquery-3.2.1.min.js";></script>
		<script src="script/jspdf.min.js"></script>
		<script src="script/html2canvas.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style>
			.colorize {
				background-image: none;
				background-color: rgba(0,0,0);
			}
		</style>
		<!--<link href='https://fonts.googleapis.com/css?family=Aladin' rel='stylesheet'>-->

	</head>
	
	<body class="body100 colorize" onkeydown="ctrlizer(event, 1)" onkeyup="ctrlizer(event, 0)">
		<div class="row">
			<div class="spacer">
				<table class="cronograma" id="renderPDF">
					<tr class="header">
						<th>Mês</th>
						<th>Jan</th>
						<th>Fev</th>
						<th>Mar</th>
						<th>Abr</th>
						<th>Mai</th>
						<th>Jun</th>
						<th>Jul</th>
						<th>Ago</th>
						<th>Set</th>
						<th>Out</th>
						<th>Nov</th>
						<th>Dez</th>
					</tr>
					<tr>
						<th onclick="colorize(this)"><input type="color" name="color0" id="color0" onchange="change(this)" style="display: none;">Análise de Viabilidades</th>
						<td onclick="marcar(this, 0, 0)"></td>
						<td onclick="marcar(this, 0, 1)"></td>
						<td onclick="marcar(this, 0, 2)"></td>
						<td onclick="marcar(this, 0, 3)"></td>
						<td onclick="marcar(this, 0, 4)"></td>
						<td onclick="marcar(this, 0, 5)"></td>
						<td onclick="marcar(this, 0, 6)"></td>
						<td onclick="marcar(this, 0, 7)"></td>
						<td onclick="marcar(this, 0, 8)"></td>
						<td onclick="marcar(this, 0, 9)"></td>
						<td onclick="marcar(this, 0, 10)"></td>
						<td onclick="marcar(this, 0, 11)"></td>
					</tr>
					<tr>
						<th onclick="colorize(this)"><input type="color" name="color1" id="color1" onchange="change(this)" style="display: none;">Definição de objetivo</th>
						<td onclick="marcar(this, 1, 0)"></td>
						<td onclick="marcar(this, 1, 1)"></td>
						<td onclick="marcar(this, 1, 2)"></td>
						<td onclick="marcar(this, 1, 3)"></td>
						<td onclick="marcar(this, 1, 4)"></td>
						<td onclick="marcar(this, 1, 5)"></td>
						<td onclick="marcar(this, 1, 6)"></td>
						<td onclick="marcar(this, 1, 7)"></td>
						<td onclick="marcar(this, 1, 8)"></td>
						<td onclick="marcar(this, 1, 9)"></td>
						<td onclick="marcar(this, 1, 10)"></td>
						<td onclick="marcar(this, 1, 11)"></td>
					</tr>
					<tr>
						<th onclick="colorize(this)"><input type="color" name="color2" id="color2" onchange="change(this)" style="display: none;">Planejamento</th>
						<td onclick="marcar(this, 2, 0)"></td>
						<td onclick="marcar(this, 2, 1)"></td>
						<td onclick="marcar(this, 2, 2)"></td>
						<td onclick="marcar(this, 2, 3)"></td>
						<td onclick="marcar(this, 2, 4)"></td>
						<td onclick="marcar(this, 2, 5)"></td>
						<td onclick="marcar(this, 2, 6)"></td>
						<td onclick="marcar(this, 2, 7)"></td>
						<td onclick="marcar(this, 2, 8)"></td>
						<td onclick="marcar(this, 2, 9)"></td>
						<td onclick="marcar(this, 2, 10)"></td>
						<td onclick="marcar(this, 2, 11)"></td>
					</tr>
					<tr>
						<th onclick="colorize(this)"><input type="color" name="color3" id="color3" onchange="change(this)" style="display: none;">Elicitação dos Requisitos</th>
						<td onclick="marcar(this, 3, 0)"></td>
						<td onclick="marcar(this, 3, 1)"></td>
						<td onclick="marcar(this, 3, 2)"></td>
						<td onclick="marcar(this, 3, 3)"></td>
						<td onclick="marcar(this, 3, 4)"></td>
						<td onclick="marcar(this, 3, 5)"></td>
						<td onclick="marcar(this, 3, 6)"></td>
						<td onclick="marcar(this, 3, 7)"></td>
						<td onclick="marcar(this, 3, 8)"></td>
						<td onclick="marcar(this, 3, 9)"></td>
						<td onclick="marcar(this, 3, 10)"></td>
						<td onclick="marcar(this, 3, 11)"></td>
					</tr>
					<tr>
						<th onclick="colorize(this)"><input type="color" name="color4" id="color4" onchange="change(this)" style="display: none;">Especificação dos Requisitos</th>
						<td onclick="marcar(this, 4, 0)"></td>
						<td onclick="marcar(this, 4, 1)"></td>
						<td onclick="marcar(this, 4, 2)"></td>
						<td onclick="marcar(this, 4, 3)"></td>
						<td onclick="marcar(this, 4, 4)"></td>
						<td onclick="marcar(this, 4, 5)"></td>
						<td onclick="marcar(this, 4, 6)"></td>
						<td onclick="marcar(this, 4, 7)"></td>
						<td onclick="marcar(this, 4, 8)"></td>
						<td onclick="marcar(this, 4, 9)"></td>
						<td onclick="marcar(this, 4, 10)"></td>
						<td onclick="marcar(this, 4, 11)"></td>
					</tr>
					<tr>
						<th onclick="colorize(this)"><input type="color" name="color5" id="color5" onchange="change(this)" style="display: none;">Gerenciamento dos Requisitos</th>
						<td onclick="marcar(this, 5, 0)"></td>
						<td onclick="marcar(this, 5, 1)"></td>
						<td onclick="marcar(this, 5, 2)"></td>
						<td onclick="marcar(this, 5, 3)"></td>
						<td onclick="marcar(this, 5, 4)"></td>
						<td onclick="marcar(this, 5, 5)"></td>
						<td onclick="marcar(this, 5, 6)"></td>
						<td onclick="marcar(this, 5, 7)"></td>
						<td onclick="marcar(this, 5, 8)"></td>
						<td onclick="marcar(this, 5, 9)"></td>
						<td onclick="marcar(this, 5, 10)"></td>
						<td onclick="marcar(this, 5, 11)"></td>
					</tr>
					<tr>
						<th onclick="colorize(this)"><input type="color" name="color6" id="color6" onchange="change(this)" style="display: none;">Design</th>
						<td onclick="marcar(this, 6, 0)"></td>
						<td onclick="marcar(this, 6, 1)"></td>
						<td onclick="marcar(this, 6, 2)"></td>
						<td onclick="marcar(this, 6, 3)"></td>
						<td onclick="marcar(this, 6, 4)"></td>
						<td onclick="marcar(this, 6, 5)"></td>
						<td onclick="marcar(this, 6, 6)"></td>
						<td onclick="marcar(this, 6, 7)"></td>
						<td onclick="marcar(this, 6, 8)"></td>
						<td onclick="marcar(this, 6, 9)"></td>
						<td onclick="marcar(this, 6, 10)"></td>
						<td onclick="marcar(this, 6, 11)"></td>
					</tr>
					<tr>
						<th onclick="colorize(this)"><input type="color" name="color7" id="color7" onchange="change(this)" style="display: none;">Modelagem do Sistema</th>
						<td onclick="marcar(this, 7, 0)"></td>
						<td onclick="marcar(this, 7, 1)"></td>
						<td onclick="marcar(this, 7, 2)"></td>
						<td onclick="marcar(this, 7, 3)"></td>
						<td onclick="marcar(this, 7, 4)"></td>
						<td onclick="marcar(this, 7, 5)"></td>
						<td onclick="marcar(this, 7, 6)"></td>
						<td onclick="marcar(this, 7, 7)"></td>
						<td onclick="marcar(this, 7, 8)"></td>
						<td onclick="marcar(this, 7, 9)"></td>
						<td onclick="marcar(this, 7, 10)"></td>
						<td onclick="marcar(this, 7, 11)"></td>
					</tr>
					<tr>
						<th onclick="colorize(this)"><input type="color" name="color8" id="color8" onchange="change(this)" style="display: none;">Codificação</th>
						<td onclick="marcar(this, 8, 0)"></td>
						<td onclick="marcar(this, 8, 1)"></td>
						<td onclick="marcar(this, 8, 2)"></td>
						<td onclick="marcar(this, 8, 3)"></td>
						<td onclick="marcar(this, 8, 4)"></td>
						<td onclick="marcar(this, 8, 5)"></td>
						<td onclick="marcar(this, 8, 6)"></td>
						<td onclick="marcar(this, 8, 7)"></td>
						<td onclick="marcar(this, 8, 8)"></td>
						<td onclick="marcar(this, 8, 9)"></td>
						<td onclick="marcar(this, 8, 10)"></td>
						<td onclick="marcar(this, 8, 11)"></td>
					</tr>
					<tr>
						<th onclick="colorize(this)"><input type="color" name="color9" id="color9" onchange="change(this)" style="display: none;">Testes</th>
						<td onclick="marcar(this, 9, 0)"></td>
						<td onclick="marcar(this, 9, 1)"></td>
						<td onclick="marcar(this, 9, 2)"></td>
						<td onclick="marcar(this, 9, 3)"></td>
						<td onclick="marcar(this, 9, 4)"></td>
						<td onclick="marcar(this, 9, 5)"></td>
						<td onclick="marcar(this, 9, 6)"></td>
						<td onclick="marcar(this, 9, 7)"></td>
						<td onclick="marcar(this, 9, 8)"></td>
						<td onclick="marcar(this, 9, 9)"></td>
						<td onclick="marcar(this, 9, 10)"></td>
						<td onclick="marcar(this, 9, 11)"></td>
					</tr>
					<tr>
						<th onclick="colorize(this)"><input type="color" name="color10" id="color10" onchange="change(this)" style="display: none;">Implantação</th>
						<td onclick="marcar(this, 10, 0)"></td>
						<td onclick="marcar(this, 10, 1)"></td>
						<td onclick="marcar(this, 10, 2)"></td>
						<td onclick="marcar(this, 10, 3)"></td>
						<td onclick="marcar(this, 10, 4)"></td>
						<td onclick="marcar(this, 10, 5)"></td>
						<td onclick="marcar(this, 10, 6)"></td>
						<td onclick="marcar(this, 10, 7)"></td>
						<td onclick="marcar(this, 10, 8)"></td>
						<td onclick="marcar(this, 10, 9)"></td>
						<td onclick="marcar(this, 10, 10)"></td>
						<td onclick="marcar(this, 10, 11)"></td>
					</tr>
					<tr class="colorRow">
						<th class="colorContainer" colspan="13" onclick="colorize(this)"><input type="color" onchange="change(this)" value="#252525"><th>
					</tr>
				</table>
				<div class="col-2 hiddenerConteiner" >
					<input type="text" class="hiddener" style="width: 0%;display:none;opacity: 0.5" onchange="verifyword(this.value)">
				</div>
			</div>
		</div>
		<div class="row spacer">
			<button class="botinha" onclick="getPDF()">Salvar</button>
		</div>
	
		<script>
			window.onload = function() {
				vetor = [
					[0,0,0,0,0,0,0,0,0,0,0,0],
					[0,0,0,0,0,0,0,0,0,0,0,0],
					[0,0,0,0,0,0,0,0,0,0,0,0],
					[0,0,0,0,0,0,0,0,0,0,0,0],
					[0,0,0,0,0,0,0,0,0,0,0,0],
					[0,0,0,0,0,0,0,0,0,0,0,0],
					[0,0,0,0,0,0,0,0,0,0,0,0],
					[0,0,0,0,0,0,0,0,0,0,0,0],
					[0,0,0,0,0,0,0,0,0,0,0,0],
					[0,0,0,0,0,0,0,0,0,0,0,0],
					[0,0,0,0,0,0,0,0,0,0,0,0]
				];
				ctrlkey = 0;
				shiftkey = 0;
				inputFocused = false;
				aaa = null;;
				change(document.getElementsByClassName("colorContainer")[0].firstElementChild);
				
				cache_width = $('#renderPDF').width();
				a4  =[ 595.28,  841.89]; 
				
			};
			
			function show(bool) {
				if(bool){
					document.getElementsByClassName("hiddener")[0].style.display = "inline-block";
					$(".hiddener").animate({'width': '100%'}, "slow");
					
				} else if(!bool){
					$(".hiddener").animate({'width': '0%'}, "slow",function(){
						document.getElementsByClassName("hiddener")[0].style.display = "none";
					});
					
				}
			}
			
			function marcar(td, posy, posx, clear='no'){
				
				if(ctrlkey) {
					document.getElementsByClassName("colorContainer")[0].style.backgroundColor = td.style.backgroundColor;
					return;
				}
				
				if(shiftkey || clear=='yes') {
					td.style.backgroundColor = '';
					vetor[posy][posx] = 0;
				} else {				
					td.style.backgroundColor =  document.getElementsByClassName("colorContainer")[0].style.backgroundColor.length > 0 ? document.getElementsByClassName("colorContainer")[0].style.backgroundColor : 'black';
					vetor[posy][posx] = 1;
				}
			}
			
			function colorize(th) {
				th.firstElementChild.click();
			}
			
			function change(inp) {
				inp.parentElement.style.backgroundColor = inp.value;
			}
			
			function ctrlizer(evt, n) {
				if(evt.keyCode == 17) {
					ctrlkey = n;
				}else if (evt.keyCode == 16){
					shiftkey = n;
				}else if(evt.keyCode == 72 && shiftkey){
					show(true);
				}
			}
			
			function verifyword(palavra){
				if(palavra == 'rainbow'){
					arcoiris();
				} else if(palavra == 'clear'){
					clear();
				} else {
					show(false);
				}
			}
			
			function arcoiris() {
				arco_colors = ["rgb(255,132,132)", "rgb(255,227,132)", "rgb(179,255,132)", "rgb(132,225,163)", "rgb(132,225,252)", "rgb(132,159,255)", "rgb(156,132,255)", "rgb(211,132,255)", "rgb(255,132,237)", "rgb(255,85,166)", "rgb(255,132,141)"];
				inner_colors = ["rgb(240,100,132)", "rgb(240,200,132)", "rgb(150,255,132)", "rgb(110,200,163)", "rgb(110,200,252)", "rgb(100,140,255)", "rgb(136,100,255)", "rgb(200,100,255)", "rgb(240,100,220)", "rgb(230,85,146)", "rgb(230,132,121)"];
				for(x = 0; x < vetor.length; x++) {
					document.getElementsByClassName("colorContainer")[0].style.backgroundColor = arco_colors[x];
					document.getElementById("color"+x).parentElement.style.backgroundColor = inner_colors[x];
					for(xz = 0; xz < vetor[x].length; xz++) {
						marcar(document.getElementsByTagName("td")[parseInt(xz)+(parseInt(x)*12)],parseInt(x),parseInt(xz)); 
					}
				}
				
				show(false);
			}
			
			function clear() {
				for(x = 0; x < vetor.length; x++) {
					for(xz = 0; xz < vetor[x].length; xz++) {
						marcar(document.getElementsByTagName("td")[parseInt(xz)+(parseInt(x)*12)],parseInt(x),parseInt(xz),'yes'); 
					}
					document.getElementById("color"+x).parentElement.style.backgroundColor = 'white';
				}
				show(false);
			}
			
			function getPDF(){
				$("#renderPDF").width((a4[0]*1.33333) -80).css('max-width','none');
				html2canvas($('#renderPDF'), {
				  onrendered: function(canvas) {
					var img = canvas.toDataURL("image/png",1.0);  
					var doc = new jsPDF({unit:'px', format:'a4'});
					
					var dados = new FormData();
					
					doc.addImage(img, 'JPEG', 20, 20);
					doc.save("<?php echo $_SESSION["email"] . '/' . $_SESSION["id"]?>/cronograma.pdf");
					
					var pdf = doc.output('blob');
					dados.append('data', pdf);
					$('#renderPDF').width(cache_width);
					
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
	</body>
</html>