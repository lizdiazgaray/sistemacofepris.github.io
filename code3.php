<?php 
//FUNCIONA!!
//CÓDIGO PARA SUBIR EL ARCHIVO EXCEL  DE ENTRADAS A TABLA EN PHPMYADMIN
session_start();
require 'php/c.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['save_excel_dataent'])) {
    $fileName = $_FILES['import_fileent']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xsl', 'csv', 'xlsx'];

    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['import_fileent']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        // Realizar una consulta para verificar si la tabla contiene registros
        mysqli_set_charset($conexion, "utf8");
        $sql = "SELECT COUNT(*) as count FROM entradas";
        $resultado = mysqli_query($conexion, $sql);
        $fila = mysqli_fetch_assoc($resultado);
        $count = $fila['count'];

        if ($count > 0) {
            // La tabla contiene registros, no permitir el llenado
            $_SESSION['message'] = "Archivo existente en la base de datos";
            header('Location: greporte.php');
            exit(0);
        } else {
            // La tabla está vacía, permitir el llenado
            $count = 0; // Inicializar contador en 0
            foreach ($data as $index => $row) {
                if ($index > 0) { // Comenzar desde la segunda fila
        
                    $documento = $row['0'];
                    $movimiento = $row['1'];
                    $motivo = $row['2'];
                    $fecha = $row['3'];
                    $usuario = $row['4'];
                    $cptal_origen = $row['5'];
                    $desc_unidad_origen = $row['6'];
                    $cptal_destino = $row['7'];
                    $desc_unidad_destino = $row['8'];
                    $observaciones = $row['9'];
                    $lote = $row['10'];
                    $proveedor = $row['11'];
                    $gpo = $row['12'];
                    $gen = $row['13'];
                    $esp = $row['14'];
                    $dif = $row['15'];
                    $var = $row['16'];
                    $descripcion = $row['17'];
                    $cantidad = $row['18'];
                    $pre_unit = $row['19'];
                    $importe = $row['20'];

                // Realizar la inserción

                $studentQuery = "INSERT INTO entradas (DOCUMENTO, MOVIMIENTO, MOTIVO, FECHA, USUARIO, DESC_UNIDAD_ORIGEN, CPTAL_DESTINO, DESC_UNIDAD_DESTINO, OBSERVACIONES, LOTE, PROVEEDOR, GPO, GEN, ESP, DIF, VAR, DESCRIPCION, CANTIDAD, PRE_UNIT, IMPORTE) 
                VALUES ('$documento', '$movimiento', '$motivo', '$fecha', '$usuario', '$desc_unidad_origen', '$cptal_destino', '$desc_unidad_destino', '$observaciones', '$lote', '$proveedor', '$gpo', '$gen', '$esp', '$dif', '$var', '$descripcion', '$cantidad', '$pre_unit', '$importe')";
                $result = mysqli_query($conexion, $studentQuery);
                $msg = true;
            }
        }

            if (isset($msg)) {
                $_SESSION['message'] = "Importación exitosa";
                header('Location: greporte.php');
                exit(0);
            } else {
                $_SESSION['message'] = "Archivo no importado";
                header('Location: greporte.php');
                exit(0);
            }
        }
    } else {
        $_SESSION['message'] = "Archivo no válido, solo se admiten archivos con extensión xsl, csv, xlsx";
        header('Location: greporte.php');
        exit(0);
    }
}




?>