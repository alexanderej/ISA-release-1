<?php
require 'conexion.php';
require 'funcs.php';

session_start();
$errors = array();
$mensaje = array();

$id = $_GET['id'];
	
	$sql = "SELECT * FROM admin WHERE Codigo_Adm = '$id'";
	$resultado = $mysqli->query($sql);
	$row = $resultado->fetch_assoc();
	
if($_POST){
    //echo 'Funciona post';
////obtener los valores de las variables del formulario
    $nombre = $_POST['nombreA'];
    $apellidos = $_POST['apellidoA'];
    $email = $_POST['email'];
    $cedula = $_POST['cedula'];
    $codigo = $_POST['codigo'];
    $celular = $_POST['celular'];

    if(isNull($nombre, $apellidos, $email, $cedula, $codigo, $celular, "", "", 1)){
        $errors[] = "Debe llenar todos los campos";
    }

    if(!isEmail($email)){
        $errors[] = "Direccion de correo no valida";
    }
    

    if(count($errors) == 0){
        ///Registrar nuevo adminn y usuario
        $sql = "UPDATE admin SET Codigo_Adm='$codigo', Cedula_Adm='$cedula', Nombre_Adm='$nombre', Apellidos_Adm='$apellidos', Correo_Adm='$email', Cel_Adm='$celular' WHERE Codigo_Adm = '$id'";
        $resultado=$mysqli->query($sql);
        //echo $resultado;

        $pass= sha1 ($cedula);
        $sql2 = "UPDATE usuarios SET Id_Usuario='$codigo', Usuario='$codigo', Password='$pass', Nombre_Usuario='ADMIN', Tipo_Usuario='1' WHERE Id_Usuario = '$id'";
        $resultado2=$mysqli->query($sql2);
        //echo $resultado2;


        if($resultado && $resultado2){
            $mensaje[] ="Los datos del administrador $nombre $apellidos han sido modificados exitosamente";
            ////////enviar un correo//////////////////////////////////////
            $url = 'http://'.$_SERVER["SERVER_NAME"].'/ISA-release-1/login.php';

            $asunto = 'Modificación de Cuenta - Sistema Gestion Modalidades de Grado';
            $cuerpo = "Estimado $nombre $apellidos: <br>sus datos han sido modificados exitosamente al sistema de gestion de proyectos de grado <br>puede acceder al sistema con:<br>Usuario: $codigo<br>Contraseña: $cedula<br> <a href='$url'>Ir a página web</a>";

            if(enviarEmail($email, $nombre, $asunto, $cuerpo)){
                $mensaje[] = "<br>Se ha enviado las credenciales al correo: $email";

               
            }
            //////////*///////////////////////////////////
        }
        else{
            $errors[] = "Falló modificar el admin. ";
        }
        
    }
}else{
        //echo 'No funciona post';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Modificar Administrador</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="./css/style.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block">
                        <img id="acreditacion" align="right" src="img/acreditacion.png">
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Modificar Administrador</h1>
                            </div>
                            <form class="user" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="nombreA"
                                            placeholder="Nombres" value="<?php echo $row['Nombre_Adm']; ?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" name="apellidoA"
                                            placeholder="Apellidos" value="<?php echo $row['Apellidos_Adm']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="email"
                                        placeholder="Correo Electrónico" value="<?php echo $row['Correo_Adm']; ?>">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="number" class="form-control form-control-user" name="cedula"
                                            placeholder="No de Identificación" value="<?php echo $row['Cedula_Adm'] ?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control form-control-user" name="codigo"
                                            placeholder="Código del Administrador" value="<?php echo $row['Codigo_Adm'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="number" class="form-control form-control-user" name="celular"
                                            placeholder="Celular" value="<?php echo $row['Cel_Adm']; ?>">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Modificar
                                    Administrador</button>


                                <hr>
                                
                            </form>

                            <?php echo resultBlock($errors); 
                            if(count($mensaje) > 0){
                                echo '
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-info text-white shadow">
                                        <div class="card-body">';
                                        foreach($mensaje as $msg)
			{
				echo "<li>".$msg."</li>";
			}
                                        echo '<div class="text-white-50 small">#Registro Modificado</div>
                                        </div>
                                    </div>
                                </div>
                                ';
                            }
                            ?>
                            <a href="index.php" class="btn btn-primary">
                                Página Principal
                            </a>
                           
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