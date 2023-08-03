<?php 
//FUNCIONA!!
//CÓDIGO PARA SUBIR EL ARCHIVO EXCEL COLECTIVOS A TABLA EN PHPMYADMIN
session_start();
require 'php/c.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['save_excel_datacole'])) {
    $fileName = $_FILES['import_file_cole']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xsl', 'csv', 'xlsx'];

    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['import_file_cole']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        // Realizar una consulta para verificar si la tabla contiene registros
        mysqli_set_charset($conexion, "utf8");
        $sql = "SELECT COUNT(*) as count FROM colectivos ";
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

                    $no_documento = $row['0'];
                    $servicio = $row['1'];
                    $fecha = $row['2'];
                    $usuario = $row['3'];
                    $especialidad = $row['4'];
                    $area = $row['5'];
                    $gpo = $row['6'];
                    $gen = $row['7'];
                    $esp = $row['8'];
                    $dif = $row['9'];
                    $var = $row['10'];
                    $descripcion = $row['11'];
                    $solicitada = $row['12'];
                    $surtida = $row['13'];
                    $negada = $row['14'];
                    $pre_unit = $row['15'];
                    $importe = $row['16'];

                 // Realizar la inserción

            $studentQuery = "INSERT INTO colectivos (NO_DOCUMENTO,SERVICIO,FECHA,USUARIO,ESPECIALIDAD,AREA,GPO,GEN,ESP,DIF,VAR,DESCRIPCION,SOLICITADA,SURTIDA,NEGADA,PRE_UNIT,IMPORTE)
            VALUES ('$no_documento', '$servicio', '$fecha', '$usuario', '$especialidad', '$area', '$gpo', '$gen', '$esp', '$dif', '$var', '$descripcion', '$solicitada', '$surtida', '$negada', '$pre_unit', '$importe')";
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