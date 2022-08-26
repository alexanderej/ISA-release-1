<?php
require 'conexion.php';
require 'funcs.php';

session_start();
$errors = array();
$mensaje = array();

if($_POST){
    //echo 'Funciona post';
////obtener los valores de las variables del formulario
    $nombre = $_POST['nombreE'];
    $apellidos = $_POST['apellidoE'];
    $email = $_POST['email'];
    $cedula = $_POST['cedula'];
    $codigo = $_POST['codigo'];
    $celular = $_POST['celular'];
    $programa = $_POST['programa'];
    $sede = $_POST['sede'];

    if(isNull($nombre, $apellidos, $email, $cedula, $codigo, $celular, $programa, $sede,2)){
        $errors[] = "Debe llenar todos los campos";
    }

    if(!isEmail($email)){
        $errors[] = "Direccion de correo no valida";
    }
    if(usuarioExiste($codigo)){
        $errors[] = "El código $codigo ya existe";
    }

    if(count($errors) == 0){
        ///Registrar nuevo estudiante y usuario
        $sql = "INSERT INTO estudiantes (Codigo_Est, Cedula_Est, Nombre_Est, Apellidos_Est, Programa_Est, Correo_Est, Cel_Est, Sede_Est, Codigo_Doc, Cod_proyecto) VALUES ('$codigo','$cedula','$nombre','$apellidos','$programa', '$email',   '$celular', '$sede','','')";
        $resultado=$mysqli->query($sql);
        //echo $resultado;

        $pass= sha1 ($cedula);
        $sql2 = "INSERT INTO usuarios (Id_Usuario, Usuario, Password, Nombre_Usuario, Tipo_Usuario) VALUES ('$codigo','$codigo', '$pass', 'ESTUDIANTE', '2')";
        $resultado2=$mysqli->query($sql2);

        if($resultado && $resultado2){
            $mensaje[] ="El Estudiante $nombre $apellidos ha sido registrado exitosamente";
            ////////enviar un correo//////////////////////////////////////
            $url = 'http://'.$_SERVER["SERVER_NAME"].'/ISA-release-1/login.php';

            $asunto = 'Registro Cuenta - Sistema Gestion Modalidades de Grado';
            $cuerpo = "Estimado $nombre $apellidos: <br> ha sido registrado exitosamente al sistema de gestion de proyectos de grado <br>puede acceder al sistema con:<br>Usuario: $codigo<br>Contraseña: $cedula<br> <a href='$url'>Ir a página web</a>";

            if(enviarEmail($email, $nombre, $asunto, $cuerpo)){
                $mensaje[] = "<br>Se ha enviado las credenciales al correo: $email";

               // echo "<br><a href='index.php'>Iniciar Sesión</a>";
                //exit;
            }
            //////////*///////////////////////////////////
        }
        else{
            $errors[] = "Falló registrar el estudiante. ";
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

    <title>Registrar Estudiante</title>

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
                        <img id="acreditacion" align="right" margin="20px"; src="img/acreditacion.png">
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Registrar Estudiante</h1>
                            </div>
                            <form class="user" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="nombreE"
                                            placeholder="Nombres">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" name="apellidoE"
                                            placeholder="Apellidos">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="email"
                                        placeholder="Correo Electrónico">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="number" class="form-control form-control-user" name="cedula"
                                            placeholder="No de Identificación">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control form-control-user" name="codigo"
                                            placeholder="Código del Estudiante">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="number" class="form-control form-control-user" name="celular"
                                            placeholder="Celular">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" name="programa"
                                            placeholder="Programa Académico">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">

                                        <select name="sede" class="form-control">
                                            <option value="">Seleccionar Sede</option>
                                            <option value="Pasto">Pasto</option>
                                            <option value="Tuquerres">Túquerres</option>
                                            <option value="Ipiales">Ipiales</option>
                                            <option value="Tumaco">Tumaco</option>
                                        </select>

                                    </div>
                                    <!-- <div class="col-sm-6">
                                        <input type="number" class="form-control form-control-user"
                                            id="codigo" placeholder="Código del Estudiante">
                                    </div> -->
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Registrar
                                    Estudiante</button>


                                <hr>
                                <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a> -->
                            </form>

                            <?php echo resultBlock($errors); 
                            if(count($mensaje) > 0){
                                echo '
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-success text-white shadow">
                                        <div class="card-body">';
                                        foreach($mensaje as $msg){
				                            echo "<li>".$msg."</li>";
			                            }
                                        echo '<div class="text-white-50 small">#Registro Exitoso</div>
                                        </div>
                                    </div>
                                </div>
                                ';
                            }
                            ?>
                            <a href="index.php" class="btn btn-primary">
                                Regresar
                            </a>
                            <!-- <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.html">Already have an account? Login!</a>
                            </div> -->
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