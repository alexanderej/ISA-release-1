<?php
require "conexion.php";
require 'funcs.php';

session_start();
$errors = array();

if ($_POST){
    $Usuario=$_POST['Usuario'];
    $Password=$_POST['Password'];
    if(isUserNull($Usuario,$Password)){
        $errors[] = "Debe llenar todos los campos";
    }

    if(!usuarioExiste($Usuario)){
        $errors[] = "El Usuario $Usuario no existe";
    }
    $sql ="SELECT Id_Usuario,Password,Nombre_Usuario,Tipo_Usuario FROM usuarios WHERE   Usuario='$Usuario'";
    $resultado =$mysqli->query($sql);
    $num=$resultado->num_rows;    
    if ($num>0) {
        $row=$resultado->fetch_assoc();
        $Password_bd=$row['Password'];
        $pass_c= sha1 ($Password);
        
        if ($Password_bd==$pass_c) {
       		$_SESSION['Id_Usuario']=$row['Id_Usuario'];
            $_SESSION['Nombre_Usuario']=$row['Nombre_Usuario'];
            $_SESSION['Tipo_Usuario']=$row['Tipo_Usuario'];
            header ("Location: index.php");
	    }else{
            $errors[] = "La contraseña no coincide";
	            //echo "la contraseña no coincide";
	    }
    }
}
?> 

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <br>
                            <div class="col-lg-6 d-none d-lg-block ">
                                <br>
                                <img align="right" src="img/acreditacion.png" width="300px", height="300 px">
                                <br>
                                <br>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Universidad De Nariño <br> Inscripción Proyecto De Grado</h1>
                                    </div>
                           <!--PARA QUE EL FORM SE VUELVA A CARGAR ASI MISMO -->
                                    <form method="POST" action=" <?php echo $_SERVER['PHP_SELF'];?> " ,  class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" placeholder="Usuario" name="Usuario">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" placeholder="Password" name="Password">
                                        </div>
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> -->
                                        <div class="form-group">
                                        <div class="text-center">
                                        <button type="submit" class="btn btn-primary ">Login</button>
                                        </div></div>
                                        <hr>
                                    </form>
                                    <hr>
                                    <?php echo resultBlock($errors); ?>
                                    <!--<div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                     <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>
</html>