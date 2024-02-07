<?php

include 'conexion_be.php';

$Nombre_Completo = $_POST['Nombre_Completo'];
$Correo = $_POST['Correo'];
$Usuario = $_POST['Usuario'];
$Contraseña = $_POST['Contraseña'];

//encriptamiento de contraseña
$Contraseña = hash('sha512', $Contraseña);

$query = "INSERT INTO usuarios(Nombre_Completo, Correo, Usuario, Contraseña) 
VALUES ('$Nombre_Completo', '$Correo', '$Usuario', '$Contraseña')";

//verificar que el correo no se repita en la base de datos
$Verificar_Correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Correo= '$Correo'");

if(mysqli_num_rows($Verificar_Correo) >0) {
    echo '
    <script>
    alert("Este correo ya está registrado, intenta con uno diferente");
    window.location = "../index.php";
    </script>
    ';
    exit();
}

//verificar que el usuario no se repita en la base de datos
$Verificar_Usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Usuario= '$Usuario'");

if(mysqli_num_rows($Verificar_Usuario) >0) {
    echo '
    <script>
    alert("Este usuario ya está registrado, intenta con uno diferente");
    window.location = "../index.php";
    </script>
    ';
    exit();
}


$ejecutar = mysqli_query($conexion, $query);

if($ejecutar){
    echo '
    <script>
    alert("Usuario almacenado correctamente");
    window.location = "../index.php";
    </script>
    ';
    }else{
        echo '
        <script>
    alert("Intentalo de nuevo, usuario no almacenado");
    window.location = "../index.php";
    </script>
    ';
    }

    mysqli_close($conexion)
?>