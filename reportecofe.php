<?php

session_start();
  // Verificar si el usuario ha iniciado sesión y tiene el rol de administrador
if (!isset($_SESSION['id']) || !isset($_SESSION['user_name']) || $_SESSION['rol'] !== 'Admin') {
// Redireccionar al usuario al inicio de sesión
header("Location: login.php");
exit(); // Terminar la ejecución del script para evitar que se procese más código

}

//GENERAR REPORTE EN EXCEL 

require 'vendor/autoload.php';
require 'php/c.php';
ini_set("pcre.backtrack_limit", "5000000");
ini_set('max_execution_time', '300');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;


$excel = new Spreadsheet();
$hojaActiva = $excel->getActiveSheet();
$hojaActiva->setTitle("Reporte COFERPRIS");

//$fechaGeneracion = date('Y-m-d'); // Obtiene la fecha actual en el formato deseado
date_default_timezone_set('America/Mazatlan');
$fechaGeneracion = date('Y-m-d H:i:s');
//$fechaGeneracion = date('Y-m-d');


//ENCABEZADO

$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
    $drawing->setName('Paid');
    $drawing->setDescription('Paid');
    $drawing->setPath('IMG/LOGO.png');
    $drawing->setCoordinates('B1');
    $drawing->setOffsetX(100);
    $drawing->setRotation(0);
    $drawing->getShadow()->setVisible(false);
    $drawing->getShadow()->setDirection(45);
    $drawing->setWidthAndHeight(140,140);
    $drawing->setWorksheet($excel->getActiveSheet());


$hojaActiva->getColumnDimension('B')->setWidth(40,15);
$hojaActiva->getStyle('B7')->getFont()->setBold(true)->setSize(14);
$hojaActiva->getStyle('B7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('158C6F');
$hojaActiva->setCellValue('B7', 'Delegación');
$hojaActiva->getColumnDimension('C')->setWidth(40,15);
$hojaActiva->getStyle('C7')->getFont()->setBold(true)->setSize(14);
$hojaActiva->setCellValue('C7', 'AGUASCALIENTES');

$hojaActiva->getColumnDimension('D')->setWidth(40,15);
$hojaActiva->getStyle('D7')->getFont()->setBold(true)->setSize(14);
$hojaActiva->getStyle('D7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('158C6F');
$hojaActiva->setCellValue('D7', 'Fecha del reporte:');
$hojaActiva->getStyle('E7')->getFont()->setBold(true)->setSize(16);
$hojaActiva->setCellValue('E7', $fechaGeneracion);
$hojaActiva->getStyle('E7')->getAlignment()->setHorizontal('left');


$hojaActiva->getColumnDimension('C')->setWidth(40,15);
$hojaActiva->getColumnDimension('C')->setWidth(40);
$hojaActiva->getStyle('C2')->getFont()->setBold(true)->setName('Arial')->setSize(14);
$hojaActiva->setCellValue('C2', 'INSTITUTO MEXICANO DEL SEGURO SOCIAL');
$hojaActiva->getColumnDimension('C')->setWidth(40);
$hojaActiva->getStyle('C3')->getFont()->setBold(true)->setName('Arial')->setSize(14);
$hojaActiva->setCellValue('C3', 'Reporte Antibioticos Cofepris');
$hojaActiva->getColumnDimension('C')->setWidth(40);
$hojaActiva->getStyle('C4')->getFont()->setBold(true)->setName('Arial')->setSize(14);
$hojaActiva->setCellValue('C4', 'Oficio No. 15-ML-0101-12305-FN');
$hojaActiva->getColumnDimension('C')->setWidth(40);
$hojaActiva->getStyle('C5')->getFont()->setBold(true)->setName('Arial')->setSize(14);
$hojaActiva->setCellValue('C5', 'Expediente No. 5000/ IMSS 421231 I45-61');



//CUERPO DEL REPORTE 


$hojaActiva->getColumnDimension('A')->setWidth(40);
$hojaActiva->getStyle('A10')->getFont()->setBold(true)->setName('Aharoni')->setSize(11);
$hojaActiva->setCellValue('A10', 'FECHA DE ENTRADA DEL ANTIBIÓTICO');
$hojaActiva->getRowDimension(10)->setRowHeight(60);
$hojaActiva->getColumnDimension('B')->setWidth(40);
$hojaActiva->getStyle('B10')->getFont()->setBold(true)->setName('Aharoni')->setSize(11);
$hojaActiva->setCellValue('B10', 'FECHA DE SALIDA DEL ANTIBIÓTICO');
$hojaActiva->getColumnDimension('C')->setWidth(40);
$hojaActiva->getStyle('C10')->getFont()->setBold(true)->setName('Aharoni')->setSize(11);
$hojaActiva->getStyle('C10')->getFont('Aharoni')->setBold(true)->setSize(11);
$hojaActiva->setCellValue('C10', 'RAZÓN SOCIAL DEL PROVEEDOR');
$hojaActiva->getColumnDimension('D')->setWidth(40);
$hojaActiva->getStyle('D10')->getFont()->setBold(true)->setName('Aharoni')->setSize(11);
$hojaActiva->setCellValue('D10', 'NÚMERO DE FACTURA O COMPROBANTE DE ADQUISICION');
$hojaActiva->getColumnDimension('E')->setWidth(150);
$hojaActiva->getStyle('E10')->getFont()->setBold(true)->setName('Aharoni')->setSize(11);
$hojaActiva->setCellValue('E10', 'DENOMINACIÓN DISTINTIVA');
$hojaActiva->getColumnDimension('F')->setWidth(60);
$hojaActiva->getStyle('F10')->getFont()->setBold(true)->setName('Aharoni')->setSize(11);
$hojaActiva->setCellValue('F10', 'CANTIDAD ADQUIRIDA, VENDIDA, DEVUELTA O DESTRUIDA');
$hojaActiva->getColumnDimension('G')->setWidth(50);
$hojaActiva->getStyle('G10')->getFont()->setBold(true)->setName('Aharoni')->setSize(11);
$hojaActiva->setCellValue('G10', 'NOMBRE DE QUIEN PRESCRIBE EL MEDICAMENTO');
$hojaActiva->getColumnDimension('H')->setWidth(50);
$hojaActiva->getStyle('H10')->getFont()->setBold(true)->setName('Aharoni')->setSize(11);
$hojaActiva->setCellValue('H10', 'MATRICULA');
$hojaActiva->getColumnDimension('I')->setWidth(50);
$hojaActiva->getStyle('I10')->getFont()->setBold(true)->setName('Aharoni')->setSize(11);
$hojaActiva->setCellValue('I10', 'NO_RECETAS');
$hojaActiva->getColumnDimension('J')->setWidth(40);
$hojaActiva->getStyle('J10')->getFont()->setBold(true)->setName('Aharoni')->setSize(11);
$hojaActiva->setCellValue('J10', 'MEDICINA FAMILIAR U.M.F. NO');
$hojaActiva->getColumnDimension('K')->setWidth(30);
$hojaActiva->getStyle('K10')->getFont()->setBold(true)->setName('Aharoni')->setSize(11);
$hojaActiva->setCellValue('K10', 'NÚMERO DOCUMENTO');
$hojaActiva->getColumnDimension('L')->setWidth(25);
$hojaActiva->getStyle('L10')->getFont()->setBold(true)->setName('Aharoni')->setSize(11);
$hojaActiva->setCellValue('L10', 'ID MEDICAMENTO');


 


/*





FUNCIONA CORRECTAMENTE!! SELECT DISTINCT m.MATRICULA, m.NOMBRE_MED, m.NO_RECETAS, r.DESCRIPCION,r.ESP FROM medicos m INNER JOIN recetas r ON m.MATRICULA = r.MATRICULA WHERE m.MATRICULA = '99057061' ORDER BY M.NOMBRE_MED



//Consulta SQL para generar reporte en EXCEL 


*/
 
$consulta="SELECT
            m.MATRICULA,
            m.NOMBRE_MED,
            m.NO_RECETAS,
            M.DESC_SERVICIO,
            r.DESCRIPCION,
            e.CPTAL_DESTINO,
            MAX(e.DOCUMENTO) AS DOCUMENTO,
            MAX(e.FECHA) AS FECHA,
            MAX(i.FEC_ULT_SAL) AS FEC_ULT_SAL,
            med.ID
            FROM
            medicos m
            INNER JOIN recetas r ON
            m.MATRICULA = r.MATRICULA
            LEFT JOIN entradas e ON
            r.ESP = e.ESP
            LEFT JOIN inventario i ON
            r.ESP = i.ESP
            LEFT JOIN medicinas med ON
            r.ESP = med.ESP
            GROUP BY
            m.MATRICULA,
            m.NOMBRE_MED,
            m.NO_RECETAS,
            r.DESCRIPCION,
            med.ID,
            e.CPTAL_DESTINO
            ORDER BY
            m.NOMBRE_MED";

$resultado = $conexion->query($consulta);
$fila = 11;




while($rows = $resultado->fetch_assoc()){
 


    $hojaActiva->setCellValue('A'.$fila, $rows['FECHA']);
    $hojaActiva->setCellValue('B'.$fila, $rows['FEC_ULT_SAL']);
    $hojaActiva->setCellValue('C'.$fila, $rows['CPTAL_DESTINO']);
    $hojaActiva->setCellValue('D'.$fila, $rows['DOCUMENTO']);
    $hojaActiva->setCellValue('E'.$fila, $rows['DESCRIPCION']);
    $hojaActiva->setCellValue('G'.$fila, $rows['NOMBRE_MED']);
    $hojaActiva->setCellValue('H'.$fila, $rows['MATRICULA']);
    $hojaActiva->setCellValue('I'.$fila, $rows['NO_RECETAS']);
    $hojaActiva->setCellValue('J'.$fila, $rows['DESC_SERVICIO']);
    $hojaActiva->setCellValue('L'.$fila, $rows['ID']);

   
    $fila++;
}
//ESPACIO PARA FIRMA DEL REPORTE 


$cons = "SELECT nombre_responsable,nombre_elabora,nombre_autoriza FROM firmas"; 
$res = $conexion->query($cons);
while($row = $res->fetch_assoc()){


// Dar formato a la tabla

$hojaActiva->setCellValue('B' . ($fila + 2), $row['nombre_elabora']);
$hojaActiva->getStyle('B' . ($fila + 2))->applyFromArray([
    'font' => ['bold' => true, 'size' => 14],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'wrapText' => true],
]);

$hojaActiva->setCellValue('B' . ($fila + 3), 'ELABORA');
$hojaActiva->mergeCells('B' . ($fila + 3) . ':B' . ($fila + 3));
$hojaActiva->getStyle('B' . ($fila + 3))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$hojaActiva->getStyle('B' . ($fila + 3))->getAlignment()->setWrapText(true);

$hojaActiva->setCellValue('C' . ($fila + 2), $row['nombre_responsable']);
$hojaActiva->getStyle('C' . ($fila + 2))->applyFromArray([
    'font' => ['bold' => true, 'size' => 14],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'wrapText' => true],
]);

$hojaActiva->setCellValue('C' . ($fila + 3), 'RESPONSABLE');
$hojaActiva->mergeCells('C' . ($fila + 3) . ':C' . ($fila + 3));
$hojaActiva->getStyle('C' . ($fila + 3))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$hojaActiva->getStyle('C' . ($fila + 3))->getAlignment()->setWrapText(true);

$hojaActiva->setCellValue('D' . ($fila + 2), $row['nombre_autoriza']);
$hojaActiva->getStyle('D' . ($fila + 2))->applyFromArray([
    'font' => ['bold' => true, 'size' => 14],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'wrapText' => true],
]);

$hojaActiva->setCellValue('D' . ($fila + 3), 'AUTORIZA');
$hojaActiva->mergeCells('D' . ($fila + 3) . ':D' . ($fila + 3));
$hojaActiva->getStyle('D' . ($fila + 3))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$hojaActiva->getStyle('D' . ($fila + 3))->getAlignment()->setWrapText(true);
}

// Aplicar bordes a la tabla
$lastColumn = 'D';
$lastRow = $fila + 3;
$range = 'B' . ($fila + 2) . ':' . $lastColumn . $lastRow;

$hojaActiva->getStyle($range)->applyFromArray([
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['rgb' => '000000'],
        ], 
    ],
]);

// Ajustar el ancho de las columnas automáticamente
foreach (range('B', $lastColumn) as $column) {
    $hojaActiva->getColumnDimension($column)->setAutoSize(true);
}






// Establecer alto de las celdas
$hojaActiva->getRowDimension(($fila + 2))->setRowHeight(130);
$hojaActiva->getRowDimension(($fila + 3))->setRowHeight(30);



ob_end_clean();
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ReporteCOFEPRIS.xlsx"');
header('Cache-Control: max-age=0');
$writer =IOFactory::createWriter($excel, 'Xlsx');
$writer->save('php://output');

exit;

?>