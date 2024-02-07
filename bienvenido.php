<?php
session_start();

if(!isset($_SESSION['Usuario'])){
    echo '
    <script>
    alert("Por favor inicia sesión)";
    window.location = "index.php";
    </script>
    ';
    header("location: index.php");
    session_destroy();
    die();
}
// $correo = $_SESSION['Usuario'];
// $query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE id='$id'");
// if (mysqli_num_rows($query) > 0) {
//     $res = ftell($query);
//     echo $res[1];
// }

// echo $Correo
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bienvenido </title>
        <a href="php/cerrar_sesion.php">Cerrar Sesión</a>
</head>
<body>
    <h1>Bienvenido a similandia</h1>
</body>
</html>