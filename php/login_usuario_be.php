<?php

session_start();

include 'conexion_be.php';

// $Correo = $_POST['Correo'];
// $Contraseña = $_POST['Contraseña'];
// $Contraseña = hash('sha512', $Contraseña);

// $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Correo='$Correo'
// and Contraseña='$Contraseña'");

// if (mysqli_num_rows($validar_login) > 0){
//     $_SESSION['Usuario'] = $Correo;
//     return $Correo;
//     header("location : ../bienvenido.php");
//     exit;

// } 
// else{
//     echo     '
//     <script>
//     alert("Usuario no existe, por favor verifique los datos introducidos");
//     window.location = "../index.php";
//     </script>
//     ';
//     exit;
// } 
if (isset($_POST['Login'])) {
    $Correo = $_POST['Correo'];
    $Contraseña = hash('sha512',$_POST['Contraseña']);


    $query = "SELECT * FROM usuarios WHERE Correo = '$Correo' AND Contraseña = '$Contraseña'";
    $execute = mysqli_query($conexion , $query);
    $resultado = mysqli_fetch_assoc($execute);

    $Correo_valido = $resultado['Correo'] ?? '';
    $Contraseña_valido = $resultado['Contraseña'] ?? '';

    if (isset($_SESSION['intento']) && $_SESSION['intento'] >= 3) {
        if (!isset($_SESSION['tiempo']) || $_SESSION['tiempo'] == 0) {
            $_SESSION['tiempo'] = time() + (1 * 60);
        }

        $actual = time();
        $tiempo = $_SESSION['tiempo'];

        if ($actual < $tiempo) {
            $contador = ceil(($tiempo - $actual) / 60);
            echo "<script>
            alert('Has agotado tus 3 intentos, intentalo de nuevo en $contador minutos');
            </script>";

            "<script>
            setTimeout(function () {
                // Redirigir con JavaScript
                window.location.href= 'https://baulcode.com/registro/'
             }, 5000);
            </script>";
        } else {
            $_SESSION['intento'] = 0;
            $_SESSION['tiempo'] = 0;
        }
    }

    if (!isset($_SESSION['intento']) || $_SESSION['intento'] < 3) {
        if ($Correo == $Correo_valido && $Contraseña == $Contraseña_valido) {
            $_SESSION['intento'] = 0;
            header('location: ../bienvenido.php');
            exit;
        } else {
            if (!isset($_SESSION['intento'])) {
                $_SESSION['intento'] = 1;
                $intento = $_SESSION['intento'];
            } else {
                $_SESSION['intento']++;
                $intento = $_SESSION['intento'];

            }
            echo "<script>
            alert('Credenciales incorrectas, intento ' . $intento);
            </script>";
        }
    }
}
?>