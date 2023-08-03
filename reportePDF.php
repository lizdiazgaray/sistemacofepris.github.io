<?php
session_start();
// Verificar si el usuario ha iniciado sesión y tiene el rol de administrador
if (!isset($_SESSION['id']) || !isset($_SESSION['user_name']) || $_SESSION['rol'] !== 'Admin') {
    // Redireccionar al usuario al inicio de sesión
    header("Location: login.php");
    exit(); // Terminar la ejecución del script para evitar que se procese más código
}

// Aquí se muestra el resultado del PDF 
require_once 'vendor/autoload.php';
require_once 'plantilla.php';
require_once 'consultasbd.php';
ini_set("pcre.backtrack_limit", "5000000");
ini_set('max_execution_time', '300');

$css = file_get_contents("style.css");
$plantilla = getPlantilla($productos, $firmas);

// Dividir el HTML en fragmentos más pequeños (500,000 caracteres)
$fragmentosHTML = str_split($plantilla, 500000);

// Crear la instancia de mPDF
$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => [600, 636],
    'pagenumPrefix' => 'Página número ',
    'pagenumSuffix' => ' - ',
    'nbpgPrefix' => ' de ',
    'nbpgSuffix' => ' páginas'
]);

$mpdf->SetHTMLFooter('
<table width="100%" class="tabla3">
    <tr>
        <td width="50%" style="text-align: right;">Reporte COFEPRIS/{PAGENO}/{nbpg} </td>
    </tr>
</table>');

$mpdf->writeHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);

// Escribir cada fragmento de HTML
foreach ($fragmentosHTML as $fragmento) {
    $mpdf->writeHTML($fragmento, \Mpdf\HTMLParserMode::HTML_BODY);
}

$mpdf->output("ReporteCOFEPRIS.pdf", "I");
?>
