<?php
require 'conexion.php';
require 'funcs.php';

session_start();
$mensaje = array();
$errors = array();


if (!isset($_SESSION['Id_Usuario'])) {
    header("Location:login.php");
}
$Id_Usuario = $_SESSION['Id_Usuario'];//Codigo estudiante
$Nombre_Usuario = $_SESSION['Nombre_Usuario'];
$Tipo_Usuario = $_SESSION['Tipo_Usuario'];
$nombre="";
$nombreA="";
if ($Tipo_Usuario == 3) {
    $sqlD="SELECT * FROM  docentes WHERE Codigo_Doc = $Id_Usuario";
    $resultadoD = $mysqli-> query ($sqlD);

    while ($row=$resultadoD->fetch_assoc() ) {
        $nombre = $row['Nombre_Doc'].' '.$row['Apellidos_Doc'];
        $id_Proyecto = $row['Cod_proyecto'];
        $id_Est = $row['Codigo_Est'];
    }
}

$sqlProy = "SELECT * FROM proyecto WHERE Cod_proyecto = $id_Proyecto";
$resultadoProy=$mysqli->query($sqlProy);
while ($row=$resultadoProy->fetch_assoc() ) {
    $url_Av = $row['url_aval'];
}

if($id_Proyecto>0){
if($url_Av==""){
if($_POST){   
	if($_FILES["archivo"]["error"]>0){
        $mensaje[]="Error al cargar archivo";
	}else{
		    $path = 'documentos';
            if (!is_dir($path)) {
                @mkdir($path);
            }
            $ruta = 'documentos/'.$Id_Usuario.'/';
			$archivo = $ruta.$_FILES["archivo"]["name"];
			if(!file_exists($ruta)){
				mkdir($ruta);
			}
			if(!file_exists($archivo)){
				$resulta=@move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo);
				if($resulta){
                    $sql2 = "UPDATE proyecto SET url_aval='$archivo' WHERE Codigo_Doc = '$Id_Usuario'";
                    $resultado=$mysqli->query($sql2);

                    if($resultado){
                        $mensaje[]="El aval se subió con éxito</p>";
                    }
				}else{
                    $mensaje[]="Error al guardar archivo";
				}
			}else{
                $mensaje[]="El documento ya existía";
			}
	}
}
}else{
    $mensaje[]="Ya subió el aval";
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
    <title>Generar Aval</title>
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
                    <span>Universidad De Nariño</span></a>
            </li>
            <?php if($Tipo_Usuario==3) { ?>
            <!-- Docentes -->
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
                    <span>Revisar Trabajo De grado</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="visualizarProyecto.php?avalar=0">Revision</a>
                        <a class="collapse-item" href="generarAval.php">Generar Aval</a>
                        <!-- <a class="collapse-item" href="cards.html">Cards</a> -->
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
                                    Configuración

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
                                        <h6 class="m-0 font-weight-bold text-primary">Subir el Aval del Proyecto</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;"
                                            src="img/aval.png" alt="...">
                                        </div>
                                        <hr>
                                        <?php
                                        if($id_Proyecto>0){
                                        ?>
                                            <div id="mensaje" class="text-center">
                                                <h5>
                                                <?php foreach($mensaje as $msg){
                                                    echo "<li>".$msg."</li>";
                                                    }?>
                                                </h5>
                                            </div>
                                            <?php 
                                                if($url_Av!=""){
                                                    echo'<p>Su anteproyecto ya fue subido para revisión del docente.</p><br><p>Puede revisar su estado en el apartado GESTIÓN DE TRABAJO DE GRADO</p>';
                                                }else{

                                                
                                            ?>
                                            <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" , class="user"
                                                enctype="multipart/form-data">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <input class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" type="file" name="archivo" id="archivo">
                                                </div>
                                                <br>
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <input type="submit" class="btn btn-primary" name="Subir" value="Enviar">
                                                </div>  
                                            </form>
                                            <?php 
                                            } ?>
                                            <hr>
                                            <div id="mensaje">
                                                <?php foreach($mensaje as $msg){
                                                    echo "<li>".$msg."</li>";
                                                    }?>
                                            </div>
                                        <?php 
                                        }?>  
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
                        <h5 class="modal-title" id="exampleModalLabel">¿Seguro quieres cerrar sesión?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
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