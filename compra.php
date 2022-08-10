<?php 
     session_start();
     include("config/database.php");

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

    $Total_Total = 0.0;
?>

<!DOCTYPE html>
<html lang="span">
    <head>
        <title>La Canastera</title>
        <link rel="icon" href="css/media/logo.ico">
        <link rel="stylesheet" href="css/carrito.css">
        <link rel="stylesheet" href="css/custom.css">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/fonts/fonts.css">
        <link rel="stylesheet" href="css/formulary.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    </head>

<body id="cuerpoformularios">
    <!-- MENU DESPLEGABLE -->
    <nav class="barra">
        <h2>MENU</h2><img class="menuicon" src="css/media/menuicon.png" alt="menuicon">
        <ul>
            <li><a href="index.html">INICIO</a></li>
            <li><a href="menu.html">MENÚ</a></li>
            <li><a href="pedidos.php">PEDIDOS</a></li>
            <li><a href="registro.php">REGISTRATE</a></li>
            <li><a href="login.php">INICIA SESION</a>
            </li>
        </ul>
    </nav>
<!-- FORMULARIO TICKETS -->

<br><br><br><br>
    <section class="formularios">
        <form action="pedidos2.php"></form>
            <h2>Ticket</h2>
            <table id="lista-carrito" class="u-full-width">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total/P</th>
                    </tr>
                </thead>
                <tbody>
                
                <?php 
$ticket = array();
foreach ($listaCarrito as $producto) {?>
      <?php 
    $guisado = (string)$producto['nombre_guisado'];
    $precio = (string)$producto['precio_oferta'];
    $cantidad = (string)$producto['cantidad'];
    ?>
    <?php array_push($ticket, $cantidad, $guisado, $precio);?>
    <tr> 
        <td><?php echo $producto['nombre_guisado'];?></td>
        <td>$ <?php echo $producto['precio_oferta'];?></td>
        <td><?php echo $producto['cantidad'];?></td>
        <td>$ <?php 
            $Total_Producto = $producto['precio_oferta'] * $producto['cantidad'];
            echo $Total_Producto;
            $Total_Total = $Total_Total +  $Total_Producto;
            ?></td>
    </tr>
<?php }
?>

          
                </tbody>
            </table>
            <h3> TOTAL:<?php echo $Total_Total; ?> </h3>
            <?php 
                    array_unshift($ticket, $Total_Total);
                    // implode($ticket);
                    $ticket2 = json_encode($ticket[2]);
                    // foreach ($ticket as $sid){
                    //     $sid = (string)$sid;
                    //     echo "<script>console.log($sid); </script>";
                    // }
                    $cadena = "";
                    $prueba = count($ticket);
                    echo "<script>console.log($ticket2); </script>";
                    // echo "<script>console.log($ticket2[2]); </script>";
                    for($i=1; $i<$prueba; $i=$i+3){
                        $a = $i + 1;
                        $b = $i + 2;
                        $palabra = json_encode($ticket[$i]);
                        $palabra2 = json_encode($ticket[$a]);
                        $palabra3 = json_encode($ticket[$b]);
                        // $cadena = json_encode($cadena);
                        $cadena .="\n Cantidad:".$palabra."\n Ingrediente:".$palabra2."\n Precio:".$palabra3."\n";
                        echo "<script>console.log($cadena); </script>";
                        echo "<script>console.log($palabra); </script>";
                        echo "<script>console.log($palabra2); </script>";
                        echo "<script>console.log($palabra3); </script>";
                    };
                    $direccion = $_POST['direc'];
            require_once 'twilio-php-main/src/Twilio/autoload.php'; 
            
            use Twilio\Rest\Client; 
            
            $sid    = "AC27e17aff74634e3f94a70240b1e10531"; 
            $token  = "3818fa4e05a0ab16ca9835b20ef9842d"; 
            $twilio = new Client($sid, $token); 

                    if ($_SERVER["REQUEST_METHOD"] == "POST"){
                        $message = $twilio->messages 
                        ->create("whatsapp:+5214641221085", // to 
                                [
                                    "from" => "whatsapp:+14155238886",       
                                    "body" => "Se solicito un pedido con la siguiente informacion: \n$cadena \nEl total del pedido es: $$Total_Total
                                    \nDomicilio a entregar:$direccion" 
                                ] 
                        ); 
        
                    }
                    
           
        ?>
            <br>
            <form method="post" class="formulario_compra">
                    <label>Lugar de entrega:</label>

                    <select class="formulario_input" onchange="enableBrand(this)">
                        <option value="0">Escoje opcion</option>
                        <option value="2">En local</option>
                        <option value="1">A domicilio</option>
                    </select>
                    <br>
                    <br>
                        <section id="direc" class="d-none">
                            <label>Direccion:</label>
                            <input type="text" class="formulario_input">
                    <br>
                    <br>
                        </section>
                        <input class="formularioinput" name="confirmarpedido" type="submit" value="Solicitar pedido" >
                        <br>
                        <br>
            
                </form>

</section>

<script type="text/javascript">
    function enableBrand(answer) {   
        console.log(answer.value);
        if(answer.value == 1) {
            document.getElementById('direc').classList.remove('d-none');
        }
        else{
            document.getElementById('direc').classList.add('d-none');
        }
    }

</script>
</section>





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