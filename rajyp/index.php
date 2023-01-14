<?php
	session_start();
	if(isset($_SESSION["email"])) {
		header("Location: main.php");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style/estilo.css">
		<script src="script/jquery-3.2.1.min.js";></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>RAJYP - Sistema de Auxílio à Criação de Projetos de DPS</title>
		<link href='https://fonts.googleapis.com/css?family=Aladin' rel='stylesheet'>
	</head>

	<body>
		<div class="row">
			<div class="col-12 navbar">
				<a href="index.php"><img src="images/logo/logo2.png" id="logo" width="125px" height="100px"></img></a>
				<div class="formLogin">
					<form action="logar.php" method="POST">
						<div class="campoRight">
							<input type="text" name="login" id="login" placeholder="Login"/>
						</div>
						<div class="campoRight">
							<input type="password" name="pass" id="pass" placeholder="Senha"/>
						</div>
						<div class="button">
							<input type="submit" value="Logar"/>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12 backlayer">
				<div class="fundo">
					<div class="col-6 sobre">
						<center><p>Seja bem-vindo ao RAJYP</p></center>
						<p> O RAJYP - Software de Auxílio à Criação de Projetos de DPS é uma aplicação web responsável por auxiliar na criação de projetos da disciplina DPS.</p>
					</div>
					<div class="col-6 cadastroForm" >
						<form id='registrabson' action="registrar.php" method="POST" enctype="multipart/form-data">
							<center><h1>Registre-se</h1></center>

							<div class="row">
								<div class="col-12 inputContainer">
									<div class="photoChooser tooltipCont">
										<img src="users/unknown.png" id="photoShow" width="100" height="100" onclick="document.getElementById('profileSelecter').click();"></img>
										<input onchange='changePhoto();' name="foto" accept='image/*' type="file" id='profileSelecter'></input>
										<div class="fixedTooltip">Selecione a foto de perfil</div>
									</div>
									<?php
										if(isset($_GET["erro"]) && $_GET["erro"] == '1'){
											echo '<p style="color: red;">A imagem escolhida é muito grande!</p>';
										} else if (isset($_GET["erro"]) && $_GET["erro"] == '2') {
											echo '<p style="color: red;">Por favor, selecione outra imagem!</p>';
										} else if (isset($_GET["erro"]) && $_GET["erro"] == '3') {
											echo '<p style="color: red;">Email já registrado!</p>';
										}
									?>
								</div>
							</div>


							<div class="row">
								<div class="col-4 inputContainer">
									<input maxlength="50" type="text" name="primeiroNome" id="primeiroNome" placeholder="Primeiro Nome" required/>
								</div>
								<div class="col-4 inputContainer">
									<input maxlength="200" type="text" name="segundoNome" id="segundoNome" placeholder="Segundo Nome" required/>
								</div>
							</div>

							<div class="row">
								<div class="col-4 inputContainer">
									<input maxlength="50" type="text" name="email" id="email" placeholder="E-mail" onchange='verificarEmail();' required/>
								</div>
							</div>

							<div class="row">
								<div class="col-4 inputContainer">
									<input maxlength="200" type="password" name="senha" id="senha" placeholder="Senha" required/>
								</div>
								<div class="col-4 inputContainer" id="senhaContainer">

								</div>

							</div>

							<div class="row">
								<div class="col-4 inputContainer tooltipCont">
									<input type="date" name="nascimento" id="nascimento" required/>
									<div class="tooltip">Data de Nascimento</div>
								</div>
							</div>

							<div class="row">
								<div class="col-4 inputContainer tooltipCont">
									<select name='estado' id="estado" required>
									</select>
									<div class="tooltip">Selecione seu estado</div>
								</div>
							</div>

							<div class="row">
								<div class="col-4 inputContainer tooltipCont">
									<select name='cidade' id="cidade" required>
									</select>
									<div class="tooltip">Selecione sua cidade</div>
								</div>
							</div>

							<div class="row">
								<div class="col-12 inputContainer">
									<input type="radio" name="sexo" value="Masculino" id="Masculino" checked required/>
									<label for='Masculino' class='labelRadio'>Masculino</label>
									<input type="radio" name="sexo" value="Feminino" id="Feminino" required/>
									<label for='Feminino' class='labelRadio'>Feminino</label>
								</div>
							</div>

							<div class="row">
								<div class="col-12 inputContainer captchaContainer">
									<div class="g-recaptcha" data-sitekey="6LdygjgUAAAAAF5uphRghE6pMOIPEU3JNyLFNRqI"></div>
									<?php
										if(isset($_GET['erro']) && $_GET['erro']==0){
											echo '<p style="color: red;">O captcha não foi devidamente preenchido!</p>';
										}
									?>
								</div>
							</div>

							<div class="row">
								<div class="col-12 inputContainer">
									<button class='botinha'>Enviar</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php if(isset($_GET["erro"]) && $_GET["erro"] == '4'){
			echo "<div class='erro'><p style='color: red;'>Login ou senha incorretos</p></div>";
		}?>
		<script>
			var cidadeXML;
			$().ready(function(){

				listaDeEstados = document.getElementById("estado");
				firstTime = 1;
				created = 0;
				carregarXML();


				$('#estado').on('change', function() {
					mudarCidades();
				});

				setInterval(function(){
					var senha = document.getElementById('senha').value;
					if(senha.length > 0 && created == 0) {
						var confirmar = document.createElement('input');
						$(confirmar).attr({type: 'password', id: 'confirmarSenha', onchange: 'verificarIgualdade();', placeholder: 'Confirme sua Senha', style: 'width: 0%', required: 'required'}).appendTo('#senhaContainer')
							.animate({width: '100%'}, 'slow');
						created = 1;
					} else if (senha.length == 0) {
						$('#confirmarSenha ').animate({width:'0%'},'slow', function(){$('#confirmarSenha').remove();});
						created = 0;
					}

				}, 200);

			});

			function carregarXML() {
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function(){
					if(xhttp.readyState == 4 && xhttp.status == 200) {
						carregarEstados(xhttp.responseXML);
						cidadeXML = xhttp.responseXML;
						if(firstTime == 1) {
							mudarCidades();
							firstTime = 0;
						}
					}
				};

				xhttp.open("POST", "script/xml/cidades.xml", true);
				xhttp.send();
			}

			function carregarEstados(xml) {
				var c =  xml.getElementsByTagName('estado');

				for(var i = 0; i < c.length; i++) {
					var ufAtual = xml.getElementsByTagName('estado')[i].children[2].childNodes[0].nodeValue;
					var nomeAtual = xml.getElementsByTagName('estado')[i].children[1].childNodes[0].nodeValue;

					var estado = document.createElement("option");
					$(estado).attr({value: ufAtual}).html(nomeAtual).appendTo("#estado");
				}

			}

			function mudarCidades() {
				//Limpar options
				var cidades = document.getElementById("cidade");
				if(cidades.length > 0){
					for(var counter = cidades.length-1; counter >= 0; counter--){
						cidades[counter].remove();
					}
				}

				var listaDeEstados = document.getElementById("estado");
				for(var check = 0; check < listaDeEstados.length; check++) {
					if(listaDeEstados[check].selected == true) {
						var uf = listaDeEstados[check].value;
						var id;
						for(var idCheck = 0; idCheck < listaDeEstados.length; idCheck++){
							if(cidadeXML.getElementsByTagName('estado')[idCheck].children[2].childNodes[0].nodeValue == uf){
								id = cidadeXML.getElementsByTagName('estado')[idCheck].children[0].childNodes[0].nodeValue;
							}
						}

						var cidades = cidadeXML.getElementsByTagName('cidade');
						for(var i = 0; i < cidades.length; i++) {
							if(cidades[i].children[2].childNodes[0].nodeValue == id) {

								var option = document.createElement("option");
								$(option).attr({value: cidades[i].children[1].childNodes[0].nodeValue}).html(cidades[i].children[1].childNodes[0].nodeValue).appendTo("#cidade");
							}
						}
					}
				}
			}

			function changePhoto() {
				var prof = document.getElementById('profileSelecter');
				if(prof.files && prof.files[0]) {
					var reader = new FileReader();

					reader.onload = function(e) {
						$img = $('#photoShow').attr('src', e.target.result);
					}

					reader.readAsDataURL(prof.files[0]);
				}

			}

			function verificarIgualdade() {
				if(document.getElementById('senha').value != document.getElementById('confirmarSenha').value){
					document.getElementById('confirmarSenha').value = '';
				}
			}

		</script>
	</body>
</html>
