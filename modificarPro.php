<?php
require 'conexion.php';
require 'funcs.php';

session_start();
$mensaje = array();
$errors = array();
$nom_pro="";

if (!isset($_SESSION['Id_Usuario'])) {
    header("Location:login.php");
}
$Id_Usuario = $_SESSION['Id_Usuario'];//Codigo estudiante
$Nombre_Usuario = $_SESSION['Nombre_Usuario'];
$Tipo_Usuario = $_SESSION['Tipo_Usuario'];
$nombre="";
$nombreP="";
$urlP="";
if ($Tipo_Usuario == 2) {
    $sqlE="SELECT * FROM  estudiantes WHERE Codigo_Est = $Id_Usuario";
    $resultadoE = $mysqli-> query ($sqlE);

    while ($row=$resultadoE->fetch_assoc() ) {
        $nombre = $row['Nombre_Est'].' '.$row['Apellidos_Est'];
        $id_pro= $row['Cod_proyecto'];
    }
}

if($id_pro>0){
    $sqlP="SELECT * FROM  proyecto WHERE Cod_proyecto = $id_pro";
    $resultadoP = $mysqli-> query ($sqlP);

if($_POST){  
    $nombreP = $_POST['nombreP'];
    if(isProyectoNull($nombreP)){
        $mensaje[] = "Debe llenar todos los campos";
    }
	else if($_FILES["archivo"]["error"]>0){
		// echo "Error al cargar archivo";
        $mensaje[]="Error al cargar archivo";
	}else{
		///$permitidos = array("image/png","image/jpg","image/jpeg","application/pdf");
		//$limite_kb =2000;

		//if(in_array($_FILES["archivo"]["type"], $permitidos) && $_FILES["archivo"]["size"] <= $limite_kb * 1024){
            $path = 'documentos';
            if (!is_dir($path)) {
                @mkdir($path);
            }
			$ruta = 'documentos/'.$Id_Usuario.'/';
			$archivo = $ruta.$_FILES["archivo"]["name"];
			if(!file_exists($ruta)){
				mkdir($ruta);
			}
			//if(!file_exists($archivo)){
				$resulta=@move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo);
				if($resulta){
                    //ombreP=$_FILES['archivo']['name'];
                    $sql = "UPDATE proyecto SET Nombre_proyecto='$nombreP', url_proy='$archivo' WHERE Cod_Est='$Id_Usuario'";
                    $resultado=$mysqli->query($sql);
                    if($resultado){
                        $mensaje[]="Su archivo se subi?? con ??xito<br><p>Puede revisar su estado en el apartado GESTI??N DE TRABAJO DE GRADO</p>";
                        // echo "Se ha subido con exito";
                        $sqlP="SELECT * FROM  proyecto WHERE Cod_Est = $Id_Usuario";
                        $resultadoP = $mysqli-> query ($sqlP);

                        while ($row=$resultadoP->fetch_assoc() ) {
                            $id_Proyecto = $row['Cod_proyecto'];
                        }
                    }
                    $sql2 = "UPDATE estudiantes SET Cod_proyecto='$id_Proyecto' WHERE Codigo_Est = '$Id_Usuario'";
                    $resultado2=$mysqli->query($sql2);
				}else{
					// echo "Error al guardar archivo";
                    $mensaje[]="Error al guardar archivo";
				}
			//}else{
				// echo "Archivo ya existe";
              //  $mensaje[]="El documento ya exist??a";
			//}
		//}else{
		//	echo "Archivo no permitido o excede el tama??o";
		//}
	}
}
}else {
    $mensaje[]="Debe subir primero su anteproyecto";
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
    <title>Enviar Propuesta</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand  AQUI ENRAMOS AL SISTEMA -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-0">
                    <img src="img/logo1.png" aling="center" width="60" , height="60">
                </div>
                <div class="sidebar-brand-text mx-3">GESTION MODALIDADES DE GRADO</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <span>Universidad De Nari??o</span></a>
            </li>
            <?php if($Tipo_Usuario==2) { ?>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Acciones
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Inscripci??n Trabajo de Grado</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="enviarPro.php">Enviar Propuesta</a>
                        <a class="collapse-item" href="modificarPro.php">Modificar Propuesta</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Gestion Trabajo De Grado</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="visualizarProyecto.php?avalar=0">Revision y comentarios</a>
                        <!-- <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a> -->
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            <?php } ?>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">


                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo $Nombre_Usuario.'<br>'.$nombre; ?>
                                </span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>

                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="mostrarInfo.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Configuraci??n

                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#logout" href="#">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Salir
                                    </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    
                                <!-- Illustrations -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Subir el Archivo del Proyecto</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                                src="img/undraw_posting_photo.svg" alt="...">
                                        </div>
                                        <p>Subir su anteproyecto para revisi??n del docente que ser?? asignado...</p>
                                        </div>
                                        <div id="mensaje" class="text-center">
                                            <h5>
                                            <?php foreach($mensaje as $msg){
                                                echo "<li>".$msg."</li>";
                                                }?>
                                            </h5>
                                        </div>
<hr>
                    <?php 
                    if($id_pro>0){
                    ?>
                                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Avance de Proyecto Actual</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>C??digo del proyecto</th>
                                            <th>Nombre del proyecto</th>
                                            <th>URL</th>
                                            <th>Codigo Estudiante</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row=$resultadoP->fetch_assoc() ) {
                                            $urlP = $row['url_proy'];
                                            $nom_pro= $row['Nombre_proyecto'];

                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['Cod_proyecto'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['Nombre_proyecto'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['url_proy']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['Cod_Est']; ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    

                    <!-- Tasks Card Example -->
                    <div>
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Para
                                            visualizar Proyecto clic en el enlace
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                    <a href="<?php echo $urlP;?> " target="_blank">
                                                        <?php echo $nom_pro; ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" , class="user" enctype="multipart/form-data">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" name="nombreP" placeholder="Nombre del proyecto">
                            </div>
                            <hr>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" type="file" name="archivo" id="archivo">
                            </div>
                            <br>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="submit" class="btn btn-primary" name="Subir" value="Enviar">
                            </div> 
                        </form>
                    </div>
                    <?php 
                    } ?>
                    <hr>
                    <div id="mensaje" class="text-center">
                        <h5>
                        <?php foreach($mensaje as $msg){
                            echo "<li>".$msg."</li>";
                        }?>
                        </h5>
                    </div>
                </div>
            </div>
                    <!-- /.container-fluid -->
        </div>
                <!-- End of Main Content -->
                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; VisionSoft 2022</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <!-- Logout Modal-->
        <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">??Seguro quieres cerrar sesi??n?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">??</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="logout.php">Logout</a>
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

        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>