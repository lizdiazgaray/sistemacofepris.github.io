<?php 
//FUNCIONA!!
//CÓDIGO PARA SUBIR EL ARCHIVO EXCEL DE RECETAS A TABLA EN PHPMYADMIN
session_start();
require 'php/c.php';
require 'vendor/autoload.php';
ini_set("pcre.backtrack_limit", "5000000");
ini_set('max_execution_time', '300'); // con estas lineas se soluciono el error al cargar el archivo de recetas a PhpMyadmin

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['save_excel_data_rece'])) {
    $fileName = $_FILES['import_file_rece']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xsl', 'csv', 'xlsx'];

    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['import_file_rece']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        // Realizar una consulta para verificar si la tabla contiene registros
        mysqli_set_charset($conexion, "utf8");
        $sql = "SELECT COUNT(*) as count FROM recetas";
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

                    $no_receta = $row['0'];
                    $no_ss = $row['1'];
                    $agregado = $row['2'];
                    $nombre_paciente_curp = $row['3'];
                    $servicio = $row['4'];
                    $usuario = $row['5'];
                    $usuario_act = $row['6'];
                    $matricula = $row['7'];
                    $nombre_medico = $row['8'];
                    $registro = $row['9'];
                    $expedicion = $row['10'];
                    $estatus = $row['11'];
                    $estatus_receta = $row['12'];
                    $enviado = $row['13'];
                    $gpo = $row['14'];
                    $gen = $row['15'];
                    $esp = $row['16'];
                    $dif = $row['17'];
                    $var = $row['18'];
                    $descripcion = $row['19'];
                    $despacho = $row['20'];
                    $fecha_desp = $row['21'];
                    $cantidad = $row['22'];
                    $pre_unit = $row['23'];
                    $importe = $row['24'];

                 // Realizar la inserción
                 $medisQuery = "INSERT INTO recetas (NO_RECETA,NO_SS,AGREGADO,NOMBRE_PACIENTE_CURP,SERVICIO,USUARIO,USUARIO_ACT,MATRICULA,NOMBRE_MEDICO,REGISTRO,EXPEDICION,ESTATUS,ESTATUS_RECETA,ENVIADO,GPO,GEN,ESP,DIF,VAR,DESCRIPCION,DESPACHO,FECHA_DESP,CANTIDAD,PRE_UNIT,IMPORTE) 
                 VALUES ('$no_receta', '$no_ss', '$agregado', '$nombre_paciente_curp', '$servicio', '$usuario', '$usuario_act', '$matricula', '$nombre_medico', '$registro', '$expedicion', '$estatus', '$estatus_receta', '$enviado', '$gpo', '$gen', '$esp', '$dif', '$var', '$descripcion', '$despacho', '$fecha_desp', '$cantidad', '$pre_unit', '$importe')";
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