<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>La Canastera</title>
	<link rel="icon" href="css/media/logo.ico">
	<link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	<link rel="stylesheet" href="css/formulary.css">

	
    
</head>
<body id="cuerpoformularios">
	<main>

		<nav class="barra">
			<h2>MENU</h2><img class="menuicon" src="css/media/menuicon.png" alt="menuicon">
			<ul>
				<li><a href="index.html">INICIO</a></li>
				<li><a href="menu.html">MENÚ</a></li>
				<li><a href="login.php">PEDIDOS</a></li>
				<li><a href="login.php">INICIA SESION</a>
				</li>
			</ul>
		</nav>
		<br><br><br><br>
		<form method="POST" class="formularios" id="formulario">
			
			<h2>Registrate</h2>
				<br>
			<!-- Grupo: Nombre -->
			<div class="formulario__grupo" id="grupo__nombre">
				<label for="nombre" class="formulario__label">Nombres:</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Inserte su nombre:" 
						value="<?php if (isset($_POST["nombre"])) echo ($_POST["nombre"])?>">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El usuario tiene que ser de 4 a 16 dígitos y solo puede contener letras.</p>
			</div>

			<!-- Grupo: Apellido Paterno -->
			<div class="formulario__grupo" id="grupo__apellidop">
				<label for="usuario" class="formulario__label">Apellido Paterno:</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="apellidop" id="apellidop" placeholder="Inserte su apellido paterno:"
					value="<?php if (isset($_POST["apellidop"])) echo ($_POST["apellidop"])?>">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El usuario tiene que ser de 4 a 16 dígitos y solo puede contener letras.</p>
			</div>

			<!-- Grupo: Apellido Materno -->
			<div class="formulario__grupo" id="grupo__apellidom">
				<label for="usuario" class="formulario__label">Apellido Materno:</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="apellidom" id="apellidom" placeholder="Inserte su apellido materno:"
					value="<?php if (isset($_POST["apellidom"])) echo ($_POST["apellidom"])?>">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El usuario tiene que ser de 4 a 16 dígitos y solo puede contener letras.</p>
			</div>

			<!-- Grupo: Contraseña -->
			<div class="formulario__grupo" id="grupo__password">
				<label for="password" class="formulario__label">Contraseña</label>
				<div class="formulario__grupo-input">
				<input type="password" class="formulario__input" name="password" id="password" placeholder="Inserte su contraseña:">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La contraseña tiene que ser de 4 a 12 dígitos.</p>
			</div>

			<!-- Grupo: Contraseña 2 -->
			<div class="formulario__grupo" id="grupo__password2">
				<label for="password2" class="formulario__label">Repetir Contraseña</label>
				<div class="formulario__grupo-input">
					<input type="password" class="formulario__input" name="password2" id="password2" placeholder="Confirme su contraseña:">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Ambas contraseñas deben ser iguales.</p>
			</div>

			<!-- Grupo: Correo Electronico -->
			<div class="formulario__grupo" id="grupo__correo">
				<label for="correo" class="formulario__label">Correo Electrónico</label>
				<div class="formulario__grupo-input">
					<input type="email" class="formulario__input" name="correo" id="correo" placeholder="correo@correo.com"
					value="<?php if (isset($_POST["correo"])) echo ($_POST["correo"])?>">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El correo solo puede contener letras, numeros, puntos, guiones y guion bajo.</p>
			</div>

			<!-- Grupo: Teléfono -->
			<div class="formulario__grupo" id="grupo__telefono">
				<label for="telefono" class="formulario__label">Teléfono</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="telefono" id="telefono" placeholder="4491234567"
					value="<?php if (isset($_POST["telefono"])) echo ($_POST["telefono"])?>">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El telefono solo puede contener numeros y el maximo son 14 dígitos.</p>
			</div>

			<!-- Grupo: Terminos y Condiciones -->
			
			<div class="formulario__grupo" id="grupo__terminos">
				<br>
				<p><a href="login.php">¿Ya tengo Cuenta?</a></p>
				<label class="formulario__label">
					<input class="formulario__checkbox" type="checkbox" name="terminos" id="terminos">
					Acepto los Terminos y Condiciones
				</label>
			</div>
				<br>
			<div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Datos incorrectos. </p>
			</div>
				<br>
			<div class="formulario__grupo formulario__grupo-btn-enviar">
				<input type="submit" class="formulario__btn" name="confirmar" id="confirmar" value="Confirmar"></input>
				<br>
				<p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Registro exito!</p>
			</div>

			<?php
				include("validacion.php")
			?>

		</form>
	</main>
	
	<footer id="footer">
		<div class="contenedorfooter">
					<div class="filas">
						<div class="footercol">
							<h4>Correos</h4>
							<ul>
								<li><a href="#">@Inserte link de correo</a></li>
								<li><a href="#">@Inserte link de correo</a></li>
							</ul>
						</div>
						<div class="footercol">
							<h4>Informacion de Desarrolladores</h4>
							<ul>
								<li><a href="#">Inserte link</a></li>
								<li><a href="#">Inserte link</a></li>
							</ul>
						</div>
						<div class="footercol">
							<h4>Redes Sociales</h4>
							<div class="social-links">
								<a href="#"><i class="fab fa-facebook-f"></i></a>
								<a href="#"><i class="fab fa-twitter"></i></a>
								<a href="#"><i class="fab fa-instagram"></i></a>
								<a href="#"><i class="fab fa-whatsapp"></i></a>
							</div>
						</div>
					</div>
		</div>
	</footer>



	<!-- <script type="module" src="js/register.js"></script> -->
	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
</body>
</html>