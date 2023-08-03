<?php 
include "php/c.php";

session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id']) || !isset($_SESSION['user_name'])) {
    // El usuario no ha iniciado sesión, redireccionar al inicio de sesión
    
} 

$_SESSION['id'] = $row['id'];
$_SESSION['user_name'] = $row['user_name'];

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: index.php?error=El usuario es requerido");
	    exit();
	}else if(empty($pass)){
        header("Location: index.php?error=La contraseña es requerida");
	    exit();
	}else{
		

        
		$sql = "SELECT * FROM users2 WHERE user_name='$uname' AND password='$pass'";

		$result = mysqli_query($conexion, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['user_name'] === $uname && $row['password'] === $pass) {
				$_SESSION['id'] = $row['id'];
            	$_SESSION['user_name'] = $row['user_name'];
            	$_SESSION['password'] = $row['password'];
            	$_SESSION['nombre'] = $row['nombre'];
				$_SESSION['UMF'] = $row['UMF'];
				$_SESSION['turno'] = $row['turno'];
				$_SESSION['rol'] = $row['rol'];
				if ($_SESSION['rol'] == "Admin") {
                    header("Location:admin.php");
                    exit();
                } elseif ($_SESSION['rol'] == "Usuario") {
                    header("Location:cliente.php");
                    exit();
                } else {
                    header("Location:editor.php");
                    exit();
                }
			}else{
				header("Location: index.php?error=Usuario o contraseña incorrectos");
		        exit();
			}
		}else{
			header("Location: index.php?error=Usuario o contraseña incorrectos");
	        exit();
		}
	}
	
}else{
	header("Location: index.php");
	exit();
}

