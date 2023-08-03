<?php 
//PANTALLA DE INICIO EN ROL USUARIO
include('php/c.php');

  session_start();
    // Verificar si el usuario ha iniciado sesión y tiene el rol de administrador
  if (!isset($_SESSION['id']) || !isset($_SESSION['user_name']) || $_SESSION['rol'] !== 'Usuario') {
  // Redireccionar al usuario al inicio de sesión
  header("Location: login.php");
  exit(); // Terminar la ejecución del script para evitar que se procese más código

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="stylenav.css">
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="assets/IMSS.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    
    <title>Usuario</title>
</head>
<body style="background-image: url('https://www.unotv.com/uploads/2022/03/imss-142428.jpg')">

<nav class="navbar bg-body-tertiary, navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="https://puntomedio.mx/wp-content/uploads/2019/12/IMSS-logo.png" alt="Logo" width="60" height="60" class="d-inline-block align-text-top">
      Instituto Mexicano del Seguro Social
    </a>

    <a href="php/cerrar.php" class="btn btn-success">Cerrar sesión</a>
    
  </div>
</nav>
<div id="container">
    <nav>
        <ul>
            <li><a href="#">Sección de usuarios</a></li>
            <li><a href="#">Operaciones<i class="down"></i></a>
            <!-- Primer Menu Desplegable -->
            <ul>
                <li><a href="views/historial2.php">Historial de reportes mensuales</a></li>
            </ul>        
            </li>
            <li><a href="#">Más operaciones<i class="down"></i></a>
             <!-- Primer Menu Desplegable -->
            <ul>
                <li><a href="changepass/change-password.php">Cambiar contraseña</a></li>

        </ul>
    </nav>

</div>
<p></p>
<p></p>
<br></br>
<p style="text-align:rigth">Usuario ingresado, <?php echo $_SESSION['nombre']; ?></p>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    
    
</body>
</html>