<?php
    $campo_nombre= True;
    $campo_apellidop= True;
    $campo_apellidom= True;
    $campo_password= True;
    $campo_correo= True;
    $campo_telefono= True;
$nameErr = $lastnameErr = $emailErr = $passwordErr = $phoneErr = "";
$name = $lastname = $email = $password = $phone = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nombre"])) {
        $nameErr = "ERROR ";
        $campo_nombre= False;
    } else {
        $name = test_input($_POST["nombre"]);
        if (!preg_match("/^[a-zA-ZÀ-ÿ\s]{1,40}$/", $name)) {
            $nameErr = "ERROR";
            $campo_nombre= False;
        }
    }

    if (empty($_POST["correo"])) {
        $emailErr = "ERROR ";
        $campo_correo= False;
    } else {
        $email = test_input($_POST["correo"]);
        if (!preg_match("/^[a-zA-Z0-9.+-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/", $email)) {
            $emailErr = "ERROR";
            $campo_correo= False;
        }
    }


    if (empty($_POST["apellidop"])) {
        $lastnameErr = "ERROR";
        $campo_apellidop= False;
    } else {
        $lastname = test_input($_POST["apellidop"]);
        if (!preg_match("/^[a-zA-ZÀ-ÿ\s]{1,40}$/", $lastname)) {
            $lastnameErr = "ERROR";
            $campo_apellidop= False;
        }
    }


    if (empty($_POST["apellidom"])) {
        $lastnameErr = "ERROR";
        $campo_apellidop= False;
    } else {
        $lastname = test_input($_POST["apellidom"]);
        if (!preg_match("/^[a-zA-ZÀ-ÿ\s]{1,40}$/", $lastname)) {
            $lastnameErr = "ERROR";
            $campo_apellidop= False;
        }
    }


    if (empty($_POST["password"])) {
        $passwordErr = "ERROR";
        $campo_password= False;
    } else {
        $password = test_input($_POST["password"]);
        if (!preg_match(" /^.{4,12}$/ ", $password)) {
            $passwordErr = "ERROR";
            $campo_password= False;
        }
    }


    if (empty($_POST["telefono"])) {
        $phoneErr = "ERROR";
        $campo_telefono= False;
    } else {
        $phone = test_input($_POST["telefono"]);
        if (!preg_match(" /^\d{7,14}$/ ", $phone)) {
            $phoneErr = "ERROR";
            $campo_telefono= False;
        }
    }


    include("config/database.php");
    if($campo_nombre && $campo_apellidop && $campo_password && $campo_correo && $campo_telefono){
            $nombre = $_POST['nombre'];
            $apellidoP = $_POST['apellidop'];
            $apellidoM = $_POST['apellidom'];
            $telefono = $_POST['telefono'];
            $correo = $_POST['correo'];
            $password = $_POST['password'];
            $query = $conexion->prepare(
                "INSERT INTO usuarios(nombre,apellido_p,apellido_m,telefono,correo,password)
                    VALUES(:nombre,:apellidop,:apellidom,:telefono,:correo,:password)");
            $query->bindParam(":nombre",$nombre);
            $query->bindParam(":apellidop",$apellidoP);
            $query->bindParam(":apellidom",$apellidoM);
            $query->bindParam(":telefono",$telefono);
            $query->bindParam(":correo",$correo);
            $query->bindParam(":password",$password);
            $query->execute();
            {echo '<script language="javascript">document.getElementById("formulario__mensaje-exito").classList.add("formulario__mensaje-exito-activo");</script>';}
            }    
            else {echo '<script language="javascript">document.getElementById("formulario__mensaje").classList.add("formulario__mensaje-activo");</script>';}
            
    }

    header('pedidos.php');

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>