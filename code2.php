<?php 
//FUNCIONA!!
//CÓDIGO PARA SUBIR EL ARCHIVO EXCEL DE MEDICOS A TABLA EN PHPMYADMIN
session_start();
require 'php/c.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['save_excel_data_medis'])) {
    $fileName = $_FILES['import_file_medis']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xsl', 'csv', 'xlsx'];

    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['import_file_medis']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        // Realizar una consulta para verificar si la tabla contiene registros
        mysqli_set_charset($conexion, "utf8");
        $sql = "SELECT COUNT(*) as count FROM medicos";
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
        
                    $matricula = $row['0'];
                    $nombre_med = $row['1'];
                    $identificador = $row['2'];
                    $identificador_med = $row['3'];
                    $cve_esp_med = $row['4'];
                    $desc_esp_med = $row['5'];
                    $especialidad_med = $row['6'];
                    $clas_ptal = $row['7'];
                    $desc_servicio = $row['8'];
                    $servicio_med = $row['9'];
                    $no_recetas = $row['10'];
                    $estatus = $row['11'];
                    $fecha_registro = $row['12'];
                    $fecha_ult_receta = $row['13'];
                    $recetarios_act = $row['14'];
                    $recetarios_dev = $row['15'];
                    $recetarios_ext = $row['16'];
                    $recetarios_can = $row['17'];
                    $recetarios_ter = $row['18'];
                    $recetarios_tot = $row['19'];
                    $estatus_med = $row['20'];

                    

            // Realizar la inserción
            $studentQuery = "INSERT INTO medicos (MATRICULA,NOMBRE_MED,IDENTIFICADOR,IDENTIFICADOR_MED,CVE_ESP_MED,DESC_ESP_MED,ESPECIALIDAD_MED,CLAS_PTAL,DESC_SERVICIO,SERVICIO_MED,NO_RECETAS,ESTATUS,FECHA_REGISTRO,FECHA_ULT_RECETA,RECETARIOS_ACT,RECETARIOS_DEV,RECETARIOS_EXT,RECETARIOS_CAN,RECETARIOS_TER,RECETARIOS_TOT,ESTATUS_MED) 
            VALUES ('$matricula', '$nombre_med', '$identificador', '$identificador_med', '$cve_esp_med', '$desc_esp_med', '$especialidad_med', '$clas_ptal', '$desc_servicio', '$servicio_med', '$no_recetas', '$estatus', '$fecha_registro', '$fecha_ult_receta', '$recetarios_act', '$recetarios_dev', '$recetarios_ext', '$recetarios_can', '$recetarios_ter', '$recetarios_tot', '$estatus_med')";
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