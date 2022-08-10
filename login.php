<?php
    session_start();

    include("config/database.php");
    if(isset($_POST['confirmar'])){
        $query = $conexion->prepare(
            "SELECT * FROM usuarios WHERE correo = :correo"
        );
        $query->bindParam(":correo",$_POST["correo"]);
        $query->execute();
        $usuario=$query->fetch(PDO::FETCH_LAZY);
        if($usuario!=NULL){
            if($usuario["password"]==$_POST["password"]){
                $_SESSION["usuario"]="autenticado";
                $_SESSION["nombre"]=$usuario["nombre"];
                $_SESSION["id_usuario"]=$usuario["id_user"];
                header('Location:sesioniniciada.html');
            }
            else {echo '<script language="javascript">document.getElementById("formulario__mensaje").classList.add("formulario__mensaje-activo");</script>';}
        }
        else {echo '<script language="javascript">document.getElementById("formulario__mensaje").classList.add("formulario__mensaje-activo");</script>';}
    }

?>



<!DOCTYPE html>
<html lang="span">
    <head>
        <title>La Canastera</title>
        <link rel="icon" href="css/media/logo.ico">
        <link rel="stylesheet" href="css/fonts/fonts.css">
        <link rel="stylesheet" href="css/formulary.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    </head>

    <body id="cuerpoformularios">
        
    <nav class="barra">
        <h2>MENU</h2><img class="menuicon" src="css/media/menuicon.png" alt="menuicon">
        <ul>
            <li><a href="index.html">INICIO</a></li>
            <li><a href="menu.html">MENÚ</a></li>
            <li><a href="registro.php">REGISTRATE</a></li>
            </li>
        </ul>
    </nav>
<br><br><br><br>
    <form method="POST" class="formularios" id="formulario">
            <h2>Inicia Sesion</h2>
            <br>
            <br>
            <!-- Grupo: Correo Electronico -->
			<div class="formulario__grupo" id="grupo__correo">
				<label for="correo" class="formulario__label">Correo Electrónico:</label>
				<div class="formulario__grupo-input">
					<input type="email" class="formulario__input" name="correo" id="correo" placeholder="correo@correo.com">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El correo solo puede contener letras, numeros, puntos, guiones y guion bajo.</p>
			</div>

            <!-- Grupo: Contraseña -->
			<div class="formulario__grupo" id="grupo__password">
				<label for="password" class="formulario__label">Contraseña:</label>
				<div class="formulario__grupo-input">
				<input type="password" class="formulario__input" name="password" id="password" placeholder="Inserte su contraseña:">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La contraseña tiene que ser de 4 a 12 dígitos.</p>
			</div>

            <!-- Grupo: Terminos y Condiciones -->
			
			<div class="formulario__grupo" id="grupo__terminos">
				<br>
				<p><a href="registro.php">¿No tienes Cuenta? Registrate</a></p>
			</div>
				<br>
			<div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Correo o contraseña erroneos</p>
			</div>
				<br>
			<div class="formulario__grupo formulario__grupo-btn-enviar">
				<input type="submit" class="formulario__btn" name="confirmar" value="Iniciar"></input>
				<br>
				<p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
			</div>
    </form>

<footer id="footer">
<div class="contenedorfooter">
                <div class="filas">
                    <div class="footercol">
                        <h4>Correos</h4>
                        <ul>
                            <li><a href="#">Inserte link de correo</a></li>
                            <li><a href="#">Inserte link de correo</a></li>
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
             <!-- <script src="js/login.js"></script> -->
</body>
</html>