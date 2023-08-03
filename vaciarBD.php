
<?php
//VACIAR TABLAS QUE SE UTILIZAN PARA GENERAR EL REPORTE
session_start();
require 'php/c.php';
session_start();
// Verificar si el usuario ha iniciado sesión y tiene el rol de administrador
if (!isset($_SESSION['id']) || !isset($_SESSION['user_name']) || $_SESSION['rol'] !== 'Admin') {
// Redireccionar al usuario al inicio de sesión
header("Location: login.php");
exit(); // Terminar la ejecución del script para evitar que se procese más código

}

// Array con los nombres de las tablas que deseas vaciar
$tables_to_empty = array("colectivos", "entradas", "inventario", "medicinas", "medicos", "recetas", "remision", "salidas","firmas");

// Verificar si se ha enviado el formulario de confirmación
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
    // Verificar si las tablas ya están vacías
    $emptyTables = true;
    foreach ($tables_to_empty as $table_name) {
        // Consulta para verificar si la tabla tiene registros
        $count_query = "SELECT COUNT(*) FROM `$table_name`";
        $count_result = $conexion->query($count_query);
        if ($count_result && $count_result->fetch_array()[0] > 0) {
            $emptyTables = false;
            break;
        }
    }

    if (!$emptyTables) {
        // Vaciar el contenido de las tablas
        foreach ($tables_to_empty as $table_name) {
            // Consulta para vaciar la tabla actual
            $empty_query = "DELETE FROM `$table_name`";
            $empty_result = $conexion->query($empty_query);

            // Verificar si se vació la tabla correctamente
            if ($empty_result === false) {
                die("Error al vaciar la tabla $table_name: " . $conn->error);
            }
        }

        // Cerrar la conexión a la base de datos
        $conexion->close();

        echo "<script language='JavaScript'>
                    alert('El contenido de la base de datos ha sido vaciado correctamente.');
                    location.assign('greporte.php');
                    </script>";
        exit;
    } else {
        echo "<script language='JavaScript'>
                    alert('La base de datos ya se encuentra vacía.');
                    location.assign('greporte.php');
                    </script>";
        exit;
    }
}
?>