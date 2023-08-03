<?php 
//FUNCIONA!!
//CÓDIGO PARA SUBIR EL ARCHIVO EXCEL DE REMISION A TABLA EN PHPMYADMIN
session_start();
require 'php/c.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['save_excel_data_remi'])) {
    $fileName = $_FILES['import_file_remi']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xsl', 'csv', 'xlsx'];

    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['import_file_remi']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        // Realizar una consulta para verificar si la tabla contiene registros
        mysqli_set_charset($conexion, "utf8");
        $sql = "SELECT COUNT(*) as count FROM remision";
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
                    $no_remision = $row['0'];
                    $fecha = $row['1'];
                    $tipo_remision = $row['2'];
                    $tipo_movimiento = $row['3'];
                    $usuario = $row['4'];
                    $no_soli = $row['5'];
                    $gpo = $row['6'];
                    $gen = $row['7'];
                    $esp = $row['8'];
                    $dif = $row['9'];
                    $var = $row['10'];
                    $descripcion = $row['11'];
                    $surtida = $row['12'];
                    $recibida = $row['13'];
                    $pre_unit = $row['14'];
                    $importe = $row['15'];

                
            // Realizar la inserción
          
            $medisQuery = "INSERT INTO remision (NO_REMISION,FECHA,TIPO_REMISION,TIPO_MOVIMIENTO,USUARIO,NO_SOLI,GPO,GEN,ESP,DIF,VAR,DESCRIPCION,SURTIDA,RECIBIDA,PRE_UNIT,IMPORTE) 
            VALUES ('$no_remision', '$fecha', '$tipo_remision', '$tipo_movimiento', '$usuario', '$no_soli', '$gpo', '$gen', '$esp', '$dif', '$var', '$descripcion', '$surtida', '$recibida', '$pre_unit', '$importe')";
            $result = mysqli_query($conexion, $medisQuery);
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