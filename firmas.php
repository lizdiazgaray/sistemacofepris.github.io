
<head>

<div id="myModal" class="modal" tabindex="-1">
  <div class="modal-dialog">
        <!--VENTANA EMERGENTE PARA AGREGAR NOMBRES PARA FIRMA DEL DOCUMENTO PDF-->
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h3 class="modal-title" id="exampleModalLabel">Ingresar nombres para firma del reporte</h3>
                <button type="button" class="btn btn-success" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">

                <form action="guardarfirma.php" method="POST" enctype="multipart/form-data">


                <div class="row">
                        

                    <div class="col-12">
                        <label for="yourPassword" class="form-label">ELABORA</label>
                        <input type="text" name="elabora" id="elabora" class="form-control" required>

                    </div>

                    <div class="col-12">
                        <label for="yourPassword" class="form-label">RESPONSABLE</label>
                        <input type="text" name="responsable" id="responsable" class="form-control" required>

                    </div>
                    <div class="col-12">
                        <label for="yourPassword" class="form-label">AUTORIZA</label>
                        <input type="text" name="autoriza" id="autoriza" class="form-control" required>

                    </div>

                    <br>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="register" name="registrar">Guardar</button>
                        <button type="button" onclick="closeModal()" style="float: right; cursor: pointer;" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    </div>

            </div>

            </form>
        </div>
    </div>
</div>

</head>



  <script>
    // Función para abrir la ventana modal
   
  function openModal() {
  document.getElementById("myModal").style.display = "block";
  document.body.classList.add("modal-blur");
  }

    // Función para cerrar la ventana modal

    function closeModal() {
  document.getElementById("myModal").style.display = "none";
  document.body.classList.remove("modal-blur");
}

  </script>

</body>
</html>
