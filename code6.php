<?php 
//FUNCIONA!!
//CÓDIGO PARA SUBIR EL ARCHIVO EXCEL DE INVENTARIOS A TABLA EN PHPMYADMIN
session_start();
require 'php/c.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['save_excel_data_inv'])) {
    $fileName = $_FILES['import_file_inv']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xsl', 'csv', 'xlsx'];

    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['import_file_inv']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        // Realizar una consulta para verificar si la tabla contiene registros
        mysqli_set_charset($conexion, "utf8");
        $sql = "SELECT COUNT(*) as count FROM inventario";
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

                    $descripcion_gpo = $row['0'];
                    $gpo = $row['1'];
                    $gen = $row['2'];
                    $esp = $row['3'];
                    $dif = $row['4'];
                    $var = $row['5'];
                    $exis_max = $row['6'];
                    $exis_min = $row['7'];
                    $inv_inicial = $row['8'];
                    $ent_remisiones = $row['9'];
                    $ent_compras = $row['10'];
                    $ent_traspasos = $row['11'];
                    $ent_devoluciones = $row['12'];
                    $ent_ajustes = $row['13'];
                    $fec_ult_ent = $row['14'];
                    $sal_consumo = $row['15'];
                    $sal_traspasos = $row['16'];
                    $sal_concentraciones = $row['17'];
                    $sal_muestras = $row['18'];
                    $sal_bajas = $row['19'];
                    $sal_ajustes = $row['20'];
                    $fec_ult_sal = $row['21'];
                    $no_atendido = $row['22'];
                    $inv_disp = $row['23'];
                    $inv_ndisp = $row['24'];
                    $dias_ult_mov = $row['25'];
                    $sin_mov = $row['26'];


             
            // Realizar la inserción
            $studentQuery = "INSERT INTO inventario (DESCRIPCION_GPO,GPO,GEN,ESP,DIF,VAR,EXIS_MAX,EXIS_MIN,INV_INICIAL,ENT_REMISIONES,ENT_COMPRAS,ENT_TRASPASOS,ENT_DEVOLUCIONES,ENT_AJUSTES,FEC_ULT_ENT,SAL_CONSUMO,SAL_TRASPASOS,SAL_CONCENTRACIONES,SAL_MUESTRAS,SAL_BAJAS,SAL_AJUSTES,FEC_ULT_SAL,NO_ATENDIDO,INV_DISP,INV_NDISP,DIAS_ULT_MOV,SIN_MOV) 
            VALUES ('$descripcion_gpo', '$gpo', '$gen', '$esp', '$dif', '$var', '$exis_max', '$exis_min', '$inv_inicial', '$ent_remisiones', '$ent_compras', '$ent_traspasos', '$ent_devoluciones', '$ent_ajustes', '$fec_ult_ent', '$sal_consumo', '$sal_traspasos', '$sal_concentraciones', '$sal_muestras', '$sal_bajas', '$sal_ajustes', '$fec_ult_sal', '$no_atendido', '$inv_disp', '$inv_ndisp', '$dias_ult_mov', '$sin_mov')";
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
