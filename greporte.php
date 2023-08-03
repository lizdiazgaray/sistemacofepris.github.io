<?php
  
  session_start();
    // Verificar si el usuario ha iniciado sesión y tiene el rol de administrador
  if (!isset($_SESSION['id']) || !isset($_SESSION['user_name']) || $_SESSION['rol'] !== 'Admin') {
  // Redireccionar al usuario al inicio de sesión
  header("Location: login.php");
  exit(); // Terminar la ejecución del script para evitar que se procese más código

}

   
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Generar reporte</title>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="assets/IMSS.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
</head>
<body style="background-color: #ABB2B9;">
<nav class="navbar bg-body-tertiary, navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#" >
      <img src="https://puntomedio.mx/wp-content/uploads/2019/12/IMSS-logo.png" alt="Logo" width="60" height="60" class="d-inline-block align-text-top">
      Instituto Mexicano del Seguro Social
    </a>    
    <a href="php/cerrar.php" class="btn btn-success">Cerrar sesión</a>
  </div>
</nav>

<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="admin.php">
      <img src="IMG/casa1.png" alt="Logo" width="60" height="60" class="d-inline-block align-text-top">
      Regresar al menú de inicio
    </a>    

  </div>
</nav>




<nav class="navbar" style="background-color: #e3f2fd;">

  <div class="container-fluid" class="fs-1">
    <a class="navbar-brand fs-1">
      <img src="IMG/CF.png" alt="Logo" width="200" height="70" class="d-inline-block align-text-top">
      Generar reporte COFEPRIS 2023
    </a>
  </div>
</nav>

    <div class="container mt-5" >

    <div>
    <button type="button" onclick="openModal()" class="btn btn-success" data-toggle="modal" data-target="#firmas" > Agregar nombres para firma del reporte</button>
    <?php include "firmas.php"; ?>
    </div>
        <div class="row">
                <div class="col-md--12 mt-4">
                <?php
                if(isset($_SESSION['message']))
                {
                    echo "<h4>".$_SESSION['message']."</h4>";
                    unset($_SESSION['message']);
                }
                 ?>
              <div class="col-12">

     


              <div class="card">
                <!--Formulario para cargar el archivo excel y subir solamente los DATOS que contiene a su tabla correspondiente en la BD en PhpMyadmin-->
                    <div class="card-header" style="background-color: #145A32"> 
                      <h3 class="text-white">  Seleccione archivo COLECTIVOS </h3>
                    </div>
                    <div class="card-body">
                    
                    <form action="code5.php"
                      method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-10">
                                <input type="file" name="import_file_cole" class="form-control"/>
                            </div>
                            <div class="col-2">
                                <button type="submit" name="save_excel_datacole" class="btn btn-success" style="width:100%">Importar</button>
					                  
                              </form>

      
                            </div>
                        </div>
                    </div>
              
                  <div class="card">
                         <!--Formulario para cargar el archivo excel y subir solamente los DATOS que contiene a su tabla correspondiente en la BD en PhpMyadmin-->
                    <div class="card-header" style="background-color:  #000000"> 
                      <h3 class="text-white">  Seleccione archivo ENTRADAS </h3>
                    </div>
                    <div class="card-body">
                    <form action="code3.php"
                      method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-10">
                                <input type="file" name="import_fileent" class="form-control"/>
                            </div>
                            <div class="col-2">
                                <button type="submit" name="save_excel_dataent" class="btn btn-success" style="width:100%">Importar</button>
					                  </form>
                            </div>
                        </div>
                    </div>

                  
                    <div class="card">
                    <!--Formulario para cargar el archivo excel y subir solamente los DATOS que contiene a su tabla correspondiente en la BD en PhpMyadmin-->
                    <div class="card-header" style="background-color: #454545"> 
                      <h3 class="text-white">  Seleccione archivo INVENTARIO </h3>
                    </div>
                    <div class="card-body">
                    <form action="code6.php"
                      method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-10">
                                <input type="file" name="import_file_inv" class="form-control"/>
                            </div>
                            <div class="col-2">
                                <button type="submit" name="save_excel_data_inv" class="btn btn-success" style="width:100%">Importar</button>
					                  </form>
                            </div>
                        </div>
                    </div>

            
                    
                <div class="card">
                <!--Formulario para cargar el archivo excel y subir solamente los DATOS que contiene a su tabla correspondiente en la BD en PhpMyadmin-->
                    <div class="card-header" style="background-color: #0E6655"> 
                      <h3 class="text-white">  Seleccione archivo MEDICOS </h3>
                    </div>
                    <div class="card-body">
                    <form action="code2.php"
                      method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-10">
                                <input type="file" name="import_file_medis" class="form-control"/>
                            </div>
                            <div class="col-2">
                                <button type="submit" name="save_excel_data_medis" class="btn btn-success" style="width:100%">Importar</button>
					                  </form>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                    <!--Formulario para cargar el archivo excel y subir solamente los DATOS que contiene a su tabla correspondiente en la BD en PhpMyadmin-->
                    <div class="card-header" style="background-color: #145A32"> 
                      <h3 class="text-white">  Seleccione archivo CATALOGO DE MEDICINAS</h3>
                    </div>
                    <div class="card-body">
                    <form action="code.php"
                      method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-10">
                                <input type="file" name="import_file" class="form-control"/>
                            </div>
                            <div class="col-2">
                                <button type="submit" name="save_excel_data" class="btn btn-success" style="width:100%">Importar</button>
					                  </form>
                            </div>
                        </div>
                    </div>

                  <div class="card">
                  <!--Formulario para cargar el archivo excel y subir solamente los DATOS que contiene a su tabla correspondiente en la BD en PhpMyadmin-->
                    <div class="card-header" style="background-color: #000000"> 
                      <h3 class="text-white">  Seleccione archivo RECETAS </h3>
                    </div>
                    <div class="card-body">
                    <form action="code7.php"
                      method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-10">
                                <input type="file" name="import_file_rece" class="form-control"/>
                            </div>
                            <div class="col-2">
                                <button type="submit" name="save_excel_data_rece" class="btn btn-success" style="width:100%">Importar</button>
					                  </form>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                    <!--Formulario para cargar el archivo excel y subir solamente los DATOS que contiene a su tabla correspondiente en la BD en PhpMyadmin-->
                    <div class="card-header" style="background-color: #454545"> 
                      <h3 class="text-white">  Seleccione archivo REMISION </h3>
                    </div>
                    <div class="card-body">
                    <form action="code8.php"
                      method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-10">
                                <input type="file" name="import_file_remi" class="form-control"/>
                            </div>
                            <div class="col-2">
                                <button type="submit" name="save_excel_data_remi" class="btn btn-success" style="width:100%">Importar</button>
					                  </form>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                    <!--Formulario para cargar el archivo excel y subir solamente los DATOS que contiene a su tabla correspondiente en la BD en PhpMyadmin-->
                    <div class="card-header" style="background-color: #0E6655"> 
                      <h3 class="text-white">  Seleccione archivo SALIDAS </h3>
                    </div>
                    <div class="card-body">
                    <form action="code4.php"
                      method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-10">
                                <input type="file" name="import_file_sal" class="form-control"/>
                            </div>
                            <div class="col-2">
                                <button type="submit" name="save_excel_datasal" class="btn btn-success" style="width:100%">Importar</button>
					                  </form>
                            </div>
                        </div>
                    </div>
              

                
                </div>
                
              
        </div>

        <div>
       </div>

      
       <br><br/>

       
       <div class="btn-group">
      <!--Botón para generar el reporte en PDF-->
       <form action="reportePDF.php" method="POST">
            <button type="submit" class="btn btn-danger btn-lg">Genera reporte en PDF</button>
       </form>
       
      <!--Botón para generar el reporte en EXCEL-->
       <form action="reportecofe.php" method="POST">
            <button type="submit" class="btn btn-success btn-lg">Genera reporte en excel</button>
       </form>

       <script language="JavaScript">
        function confirmarVaciado() {
            var respuesta = confirm("¿Estás seguro de que quieres vaciar la base de datos? Esta acción no se puede deshacer.");
            if (respuesta) {
                document.getElementById('confirm-form').submit();
            }
        }
        </script>
         
        <!--Botón para vaciar las tablas de PhpMyadmin utilizadas para generar el reporte -->
        <form action="vaciarBD.php" id="confirm-form" method="POST">
            <button class="btn btn-warning btn-lg" type="button" onclick="confirmarVaciado()">Vaciar base de datos</button>
            <input type="hidden" name="confirm" value="1">
        </form>
    
        </div>
       
                    
       <br><br/>

     
       
      
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>