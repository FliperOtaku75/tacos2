<?php

    include("config/database.php");

    $sentenciaSQL = $conexion->prepare("SELECT * FROM guisados");
    $sentenciaSQL->execute();
    $listaGuisados = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);





?>

<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>La Canastera</title>
    <link rel="icon" href="css/media/logo.ico">
    <link rel="stylesheet" href="css/fonts/fonts.css">
    <link rel="stylesheet" href="css/formulary.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body id="cuerpoformularios">
    <!-- barra de navegacion -->
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
    
    
    <!-- formulario -->
    <form class="formularios">
        <h2>Pedido grande</h2>
        <br>
        <br>

            <div class="formulario__grupo">
                <label class="formulario__label">Cantidad:</label>
                    <input type="number" class="formulario__input" name="valor1" id="valor1" placeholder="Numero de tacos:">
            </div>

        <br>

            <div class="">
            <?php foreach ($listaGuisados as $guisado) {?>
                <label class=""><?php echo $guisado['nombre_guisado'];?></label>
                <input type="checkbox" name="guiso<?php echo $guisado['id_guisado'];?>" id="guiso<?php echo $guisado['id_guisado'];?>">
            <?php } ?>
            </div>

            <br><br>
            <input class="formulario__btn" type="button" value="Realizar pedido">
        
        </form>









<!-- footer -->
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


</body>
</html>