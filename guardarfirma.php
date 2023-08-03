
<?php
session_start();
  // Verificar si el usuario ha iniciado sesión y tiene el rol de administrador
if (!isset($_SESSION['id']) || !isset($_SESSION['user_name']) || $_SESSION['rol'] !== 'Admin') {
// Redireccionar al usuario al inicio de sesión
header("Location: login.php");
exit(); // Terminar la ejecución del script para evitar que se procese más código

}
// Insertar la información de los nombres para firma en la base de datos

$nombre_elabora = $_POST['elabora'];
$nombre_responsable = $_POST['responsable'];
$nombre_autoriza = $_POST['autoriza'];


include "php/c.php";

// Verificar si la base de datos está vacía
mysqli_set_charset($conexion, "utf8");
$sql = "SELECT COUNT(*) as count FROM firmas";
$resultado = mysqli_query($conexion, $sql);
$row = mysqli_fetch_assoc($resultado);
$count = $row['count'];

if ($count > 0) {
    echo "<script language='JavaScript'>
          alert('Ya se han insertado datos en la base de datos. No se pueden agregar más.');
          location.assign('greporte.php');
          </script>";
} else {
    // Insertar los datos en la base de datos
    $sql = "INSERT INTO firmas (nombre_elabora, nombre_responsable, nombre_autoriza) 
            VALUES ('$nombre_elabora', '$nombre_responsable', '$nombre_autoriza')"; 

    $resultado = mysqli_query($conexion, $sql);
    if ($resultado) {
        echo "<script language='JavaScript'>
              alert('Datos guardados correctamente');
              location.assign('greporte.php');
              </script>";
    } else {
        echo "<script language='JavaScript'>
              alert('Error al guardar los datos');
              location.assign('greporte.php');
              </script>";
    }
}
?>


