<?php
//CONSULTAS SQL PARA GENERAR EL REPORTE EN PDF 

ini_set("pcre.backtrack_limit", "5000000"); //Aumenta el límite de retroceso para poder generar correctamente el PDF con la libreria mPDF.
ini_set('max_execution_time', '300'); //Aumenta el tiempo de ejecución del script para que el PDF se genere correctamente.
//El tiempo de generación del PDF es de aprox 40-60 segundos, según la cantidad de información que procese.

$mysqli= new mysqli("localhost","root","","proyectimss");
$mysqli->set_charset("utf8"); //Establece el conjunto de caracteres predeterminado del cliente

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

$resultado = $mysqli->query($consulta);
while($rows = $resultado->fetch_assoc())$productos[]=$rows;


//CONSULTA PARA AGREGAR LOS NOMBRES PARA FIRMA DEL DOCUMENTO PDF

$cons = "SELECT nombre_responsable,nombre_elabora,nombre_autoriza FROM firmas"; 
$res = $mysqli->query($cons);
while($rows = $res->fetch_assoc())$firmas[]=$rows;

?>


