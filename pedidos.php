<?php
    session_start();
    include("config/database.php");

    $sentenciaSQL = $conexion->prepare("SELECT * FROM guisados");
    $sentenciaSQL->execute();
    $listaGuisados = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

    $query = $conexion->prepare(
            "SELECT id_guiso, nombre_guisado,precio_oferta,cantidad
                FROM guisados
                INNER JOIN compra
                    ON id_guisado=id_guiso
                INNER JOIN usuarios
                    ON id_user=id_cliente
                WHERE id_user = :id_usuario;");
    $query->bindParam(':id_usuario',$_SESSION['id_usuario']);
    $query->execute();
    $listaCarrito = $query->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_POST['submit'])){

        $idguiso = $_POST['id_guiso'];
        $idcliente = $_SESSION['id_usuario'];
        $cantidad = $_POST['cantidad'];
        $query = $conexion->prepare(
            "INSERT INTO compra (id_guiso,id_cliente,cantidad)
            VALUES (:idguiso,:idcliente,:cantidad)"
        );
        $query->bindParam(':idguiso',$idguiso);
        $query->bindParam(':idcliente',$idcliente);
        $query->bindParam(':cantidad',$cantidad);
        $query->execute();

        $query = $conexion->prepare(
            "SELECT id_guiso, nombre_guisado,precio_oferta,cantidad
                FROM guisados
                INNER JOIN compra
                    ON id_guisado=id_guiso
                INNER JOIN usuarios
                    ON id_user=id_cliente
                WHERE id_user = :id_usuario;");
        $query->bindParam(':id_usuario',$_SESSION['id_usuario']);
        $query->execute();
        $listaCarrito = $query->fetchAll(PDO::FETCH_ASSOC);
    }
    if(isset($_POST['eliminar'])){
        $id_guiso_eliminar = $_POST['id_guiso_eliminar'];
        $query = $conexion->prepare("DELETE FROM compra WHERE id_guiso = :id_guiso_eliminar");
        $query->bindParam(':id_guiso_eliminar',$id_guiso_eliminar);
        $query->execute();
        $query = $conexion->prepare(
            "SELECT id_guiso, nombre_guisado,precio_oferta,cantidad
                FROM guisados
                INNER JOIN compra
                    ON id_guisado=id_guiso
                INNER JOIN usuarios
                    ON id_user=id_cliente
                WHERE id_user = :id_usuario;");
        $query->bindParam(':id_usuario',$_SESSION['id_usuario']);
        $query->execute();
        $listaCarrito = $query->fetchAll(PDO::FETCH_ASSOC);
    }
    if(isset($_POST['vaciar_todo'])){
        $idUsuario = $_SESSION['id_usuario'];
        $query = $conexion->prepare("DELETE FROM compra WHERE id_cliente = :id_usuario");
        $query->bindParam(':id_usuario',$idUsuario);
        $query->execute();

        $query = $conexion->prepare(
            "SELECT id_guiso, nombre_guisado,precio_oferta,cantidad
                FROM guisados
                INNER JOIN compra
                    ON id_guisado=id_guiso
                INNER JOIN usuarios
                    ON id_user=id_cliente
                WHERE id_user = :id_usuario;");
        $query->bindParam(':id_usuario',$_SESSION['id_usuario']);
        $query->execute();
        $listaCarrito = $query->fetchAll(PDO::FETCH_ASSOC);
    }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pedido</title>
    <link rel="icon" href="css/media/logo.ico">
    <link rel="stylesheet" href="css/formulary.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/carrito.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body id="cuerpoformularios">
<!-- Grupo: Menu Lateral -->
<nav class="barra">
    <h2>MENU</h2><img class="menuicon" src="css/media/menuicon.png" alt="menuicon">
    <ul>
        <li><a href="index.html">INICIO</a></li>
        <li><a href="menu.html">MENÚ</a></li>
        <li><a href="registro.php">REGISTRATE</a></li>
        <li><a href="login.php">INICIA SESION</a>
        </li>
    </ul>
</nav>

<!-- Grupo: Header (menu superior) -->
<header>
    <div class="container">
        <p class="logo">TACOS LA CANASTERA!</p>
      
        <div class="two columns u-pull-right">
            <ul>
                <li class="submenu">
                        <img src="img/cart.png" id="img-carrito">
                        <div id="carrito">
                                
                                <table id="lista-carrito" class="u-full-width">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($listaCarrito as $producto) {?>
                                            <tr> 
                                                <td><?php echo $producto['nombre_guisado'];?></td>
                                                <td>$ <?php echo $producto['precio_oferta'];?></td>
                                                <td><?php echo $producto['cantidad'];?></td>
                                                <td>
                                                    <form method="POST">
                                                        <input type="hidden" name="id_guiso_eliminar" value="<?php echo $producto['id_guiso']?>" />
                                                        <input class="borrar-curso" type="submit" name="eliminar" value="X" />
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <br><br><br>
                                    <form method="POST">
                                        <input type="submit" name="vaciar_todo" value="Vaciar"  class="button u-full-width" id="vinputciar-carrito">
                                        <br><br>
                                        <input type="submit" value="Comprar" id="comprar" name="comprar" class="button u-full-width">
                                    </form>
                        </div>
                </li>
            </ul>                   
        </div>

    </div> 
</header>

<section id="separacion">
    <div class="container">      
    </div>
</section>

    <div id="lista-cursos" class="container">
        <br><br><br><br>
    <div class="row">
    <?php foreach($listaGuisados as $guisado) { ?>
        <div class="column">
            <div class="card">
                <div class="info-card">
                    <h4><?php echo $guisado ['nombre_guisado']; ?></h4>
                    <img src="css/media/tacos2.jpeg" class="imagen-curso u-full-width">
                    <p class="precio">$<?php echo $guisado ['precio_oferta']; ?> <span class="u-pull-right ">$<?php echo $guisado ['precio']; ?></span></p>
                        <form enctype="multipart/form-data" method="POST">
                            <label for="cantidad">Cantidad:</label>
                            <input type="number" min="1" name="cantidad" value="1"></input>
                            <input type="hidden" name="id_guiso" value="<?php echo $guisado['id_guisado']; ?>" />
                            <input value="Agregar" type="submit" name="submit" class="u-full-width button-primary button input agregar-carrito" data-id="<?php echo $guisado ['id_guisado']; ?>"></input>
                        </form>
                </div>
            </div> <!--.card-->
        </div>
    <?php }?>
    </div>  
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
                            <ul>
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-whatsapp"></i></a>
                            <br>
                         
                            </ul>
                        </div>
                    </div>
            </div>
        </div>
    </footer>

</body>
</html>