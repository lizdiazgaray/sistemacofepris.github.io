<?php

//Plantilla HTML para mostrar el reporte en PDF 
ini_set("pcre.backtrack_limit", "5000000");
ini_set('max_execution_time', '300');
require_once 'vendor/autoload.php';
require_once 'plantilla.php';
require_once 'reportePDF.php';
require_once 'consultasbd.php';






function getPlantilla($productos,$firmas){
date_default_timezone_set('America/Mazatlan');
$fechaGeneracion = date('Y-m-d H:i:s');
$contenido='

  <body>
 <header class="clearfix">
   
      <div id="logo">
        <img src="IMG/LOGO.png"  width= "150" height="155">
      </div>
      <div id="company" class="clearfix">
        <div><h2>INSTITUTO MEXICANO DEL SEGURO SOCIAL</h2></div>
        
        <div>Reporte Antibioticos Cofepris</div>
        <div>Oficio No. 15-ML-0101-12305-FN</div>
		<div>Expediente No. 5000/ IMSS 421231 I45-61</div>
      </div>
	  <br>
    <div id="fecha-generacion">
    <h1>Fecha del reporte: '.$fechaGeneracion.'</h1>
    </div>
	   <div id="project2">
      </div>
    </header>
    <main>
			
      <br></br>
    
      <table>
        <thead>
          <tr>
            <th class="qty">FECHA DE ENTRADA DEL ANTIBIÓTICO</th>
            <th class="qty">FECHA DE SALIDA DEL ANTIBIÓTICO</th>
            <th class="qty">RAZON SOCIAL DEL PROVEEDOR</th>
            <th class="qty">NÚMERO DE FACTURA</th>
            <th class="qty">DENOMINACIÓN DISTINTIVA</th>
            <th class="qty">NOMBRE DE QUIEN PRESCRIBE EL MEDICAMENTO</th>
            <th class="qty">MATRICULA</th>
            <th class="qty">NO_RECETAS</th>
            <th class="qty">MEDICINA FAMILIAR U.M.F. NO</th>
            <th class="qty">ID MEDICAMENTO</th>    
          </tr>
        </thead>
        <tbody>';
        
        foreach($productos as $producto){
          $contenido.='
                    <tr>
                

                    
                    <td class="desc">'.$producto["FECHA"].'</td> 
                    <td class="desc">'.$producto["FEC_ULT_SAL"].'</td>   
                    <td class="desc">'.$producto["CPTAL_DESTINO"].'</td>  
                    <td class="desc">'.$producto["DOCUMENTO"].'</td>   
                    <td class="desc">'.$producto["DESCRIPCION"].'</td>  
                    <td class="desc">'.$producto["NOMBRE_MED"].'</td> 
                    <td class="desc">'.$producto["MATRICULA"].'</td>  
                    <td class="desc">'.$producto["NO_RECETAS"].'</td>  
                    <td class="desc">'.$producto["DESC_SERVICIO"].'</td>  
                    <td class="desc">'.$producto["ID"].'</td> 
                     
                  
                  
                    </tr>';
                    
        } 
        
        $contenido.='

          <tr>
            
               
          </tr> 
      </tbody>
    </table>';


    // Realizar la consulta SQL y obtener los datos
    
    // Generar la segunda tabla
    $contenido .= '
        <p></p>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <table class="tabla2">
        <tbody>';
    
        foreach ($firmas as $fila) {
            $contenido .= '
                    <tr>
                        <td style="text-align: center">'.$fila['nombre_responsable'].'</td>
                        <td style="text-align: center">'.$fila['nombre_elabora'].'</td>
                        <td style="text-align: center">'.$fila['nombre_autoriza'].'</td>
                      
                    </tr>';
        }
        
        $contenido .= '
                </tbody>
            <thead>
                <tr>
                    <th>ELABORA</th>
                    <th>RESPONSABLE</th>
                    <th>AUTORIZA</th>
                   
                </tr>
            </thead>
            <tbody>
        </table>

  </main>
  <footer>
 
  </footer>
  </body>';

  return $contenido;

}

  ?>
        
