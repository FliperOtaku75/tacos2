<?php
        session_start();

        include("config/database.php");
        $nombre = $_REQUEST['nombre'];
        $apellidoP = $_REQUEST['apellidop'];
        $apellidoM = $_REQUEST['apellidom'];
        $telefono = $_REQUEST['telefono'];
        $correo = $_REQUEST['correo'];
        $password = $_REQUEST['password'];

        $query = $conexion->prepare(
            "INSERT INTO usuarios(nombre,apellido_p,apellido_m,telefono,correo,`password`)
                VALUES($nombre,$apellidoP,$apellidoM,$telefono,$correo,$password)");
        $query->execute();
        echo "HOLA SI LLEGUE HASTA AQUÍ";
?>