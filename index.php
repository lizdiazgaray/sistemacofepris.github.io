
<?php
session_start();
include('php/c.php');


//PANTALLA DE INICIO DE SESIÓN 
?>



<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
<link rel="stylesheet" href="styles.css">
<link rel="icon" type="image/x-icon" href="assets/IMSS.png" />
<title>Iniciar sesión</title>
<body>
<div class>
<section class="vh-100" style="background-color: #0B4414;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="https://upload.wikimedia.org/wikipedia/commons/f/f4/IMSS.jpg"
                class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

      <form action="login.php" method="post">
                <div class="bg-white p-3 rounded-5 text-secondary shadow" style="width: 25rem">
      <div class="box">
        <img
          src="assets/usuario.png"
          alt="login-icon"
          style="height: 7rem"
        />
      </div>
      <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
      <div class="text-center fs-2 fw-bold">Iniciar sesión</div>
      <div class="input-group mt-4">
        <div class="input-group-text bg-success">
          <img
            src="assets/username-icon.svg"
            alt="username-icon"
            style="height: 1rem"
          />
        </div>
        <input
          name="uname"
          class="form-control bg-light"
          type="text"
          placeholder="Usuario"
        />
      </div>
      <div class="input-group mt-1">
        <div class="input-group-text bg-success">
          <img
            src="assets/password-icon.svg"
            alt="password-icon"
            style="height: 1rem"
          />
        </div>
        <input
          class="form-control bg-light"
          type="password" 
          name="password"
          placeholder="Contraseña"
        />
      </div>

      <div class="input-group mt-2"> 
      <input 
      type="submit" 
         id="btn" 
         value="Ingresar" 
         name="submit" 
         class="btn btn-success text-white w-100 mt-4 fw-semibold shadow-sm"

      
      />
      </div>
      </form>
      

                </div>
                </body>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
 </div>
</body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
