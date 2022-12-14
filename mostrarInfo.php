<?php
require 'conexion.php';
session_start();

if (!isset($_SESSION['Id_Usuario'])) {
    header("Location:login.php");
}
$Id_Usuario = $_SESSION['Id_Usuario'];
$Nombre_Usuario = $_SESSION['Nombre_Usuario'];
$Tipo_Usuario = $_SESSION['Tipo_Usuario'];
$nombre="";
if($Tipo_Usuario==3){//Docentes
    $sqlD="SELECT * FROM  docentes WHERE Codigo_Doc = $Id_Usuario";
    $resultadoD = $mysqli-> query ($sqlD);
    while ($row=$resultadoD->fetch_assoc() ) {
        $nombre = $row['Nombre_Doc'].' '.$row['Apellidos_Doc'];

        $codD=$row['Codigo_Doc'];
        $cedD=$row['Cedula_Doc'];
        $nomD=$row['Nombre_Doc'];
        $apeD=$row['Apellidos_Doc'];
        $correoD=$row['Correo_Doc'];
        $celD=$row['Cel_Doc'];
    }
}
if($Tipo_Usuario==2){///Estudiantes
    $sqlE="SELECT * FROM  estudiantes WHERE Codigo_Est = $Id_Usuario";
    $resultadoE = $mysqli-> query ($sqlE);
    while ($row=$resultadoE->fetch_assoc() ) {
        $nombre = $row['Nombre_Est'].' '.$row['Apellidos_Est'];
        
        $codE=$row['Codigo_Est']; 
        $cedE=$row['Cedula_Est']; 
        $nomE=$row['Nombre_Est']; 
        $apeE=$row['Apellidos_Est'];
        $progE=$row['Programa_Est'];
        $correoE=$row['Correo_Est'];
        $celE=$row['Cel_Est'];
        $sedeE=$row['Sede_Est'];

    }
}
if($Tipo_Usuario==1){///Admin
    $sqlA="SELECT * FROM  admin WHERE Codigo_Adm = $Id_Usuario";
    $resultadoA = $mysqli-> query ($sqlA);
    while ($row=$resultadoA->fetch_assoc() ) {
        $nombre = $row['Nombre_Adm'].' '.$row['Apellidos_Adm'];

        $codA=$row['Codigo_Adm'];
        $nomA=$row['Nombre_Adm'];
        $apeA=$row['Apellidos_Adm'];
        $cedA=$row['Cedula_Adm'];
        $celA=$row['Cel_Adm'];
        $correoA=$row['Correo_Adm'];
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
    <title>Sistema Web Udenar</title>
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
                <div class="sidebar-brand-text mx-3">GESTI??N MODALIDADES DE GRADO</div>
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

            <!-- permitimos el acceso a la secreatria -->
            <?php if($Tipo_Usuario==1) { ?>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Acciones
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Agregar Usuario</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Seleccione Tipo de Usuario:</h6>
                        <a class="collapse-item" href="agregarEstudiante.php">Nuevo Estudiante</a>
                        <a class="collapse-item" href="agregarDocente.php">Nuevo Docente</a>
                        <!-- <a class="collapse-item" href="forgot-password.html">Forgot Password</a> 
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>-->
                    </div>
                </div>
            </li>
            <!-- Nav Item - Charts 
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>-->
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Gestion de Usuarios</span></a>
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
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Perfil de Usuario</h1>
                    </div>

                    <!-- Illustrations -->
                    <div class="card shadow mb-4">
                        <?php if($Tipo_Usuario==1){ ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Datos del Administrador</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>C??digo</th>
                                            <th>Nombre</th>
                                            <th>Apellidos</th>
                                            <th>C??dula</th>
                                            <th>Celular</th>
                                            <th>Correo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php echo $codA; ?>
                                            </td>
                                            <td>
                                                <?php echo $nomA; ?>
                                            </td>
                                            <td>
                                                <?php echo $apeA; ?>
                                            </td>
                                            <td>
                                                <?php echo $cedA; ?>
                                            </td>
                                            <td>
                                                <?php echo $celA; ?>
                                            </td>
                                            <td>
                                                <?php echo $correoA; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if($Tipo_Usuario==2){ ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Datos del estudiante</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>C??digo</th>
                                            <th>C??dula</th>
                                            <th>Nombre</th>
                                            <th>Apellidos</th>
                                            <th>Programa</th>
                                            <th>Correo</th>
                                            <th>Celular</th>
                                            <th>Sede</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php echo $codE; ?>
                                            </td>
                                            <td>
                                                <?php echo $cedE; ?>
                                            </td>
                                            <td>
                                                <?php echo $nomE; ?>
                                            </td>
                                            <td>
                                                <?php echo $apeE; ?>
                                            </td>
                                            <td>
                                                <?php echo $progE; ?>
                                            </td>
                                            <td>
                                                <?php echo $correoE; ?>
                                            </td>
                                            <td>
                                                <?php echo $celE; ?>
                                            </td>
                                            <td>
                                                <?php echo $sedeE; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if($Tipo_Usuario==3){ ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Datos del Docente</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>C??digo</th>
                                            <th>C??dula</th>
                                            <th>Nombre</th>
                                            <th>Apellidos</th>
                                            <th>Correo</th>
                                            <th>Celular</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php echo $codD; ?>
                                            </td>
                                            <td>
                                                <?php echo $cedD; ?>
                                            </td>
                                            <td>
                                                <?php echo $nomD; ?>
                                            </td>
                                            <td>
                                                <?php echo $apeD; ?>
                                            </td>
                                            <td>
                                                <?php echo $correoD; ?>
                                            </td>
                                            <td>
                                                <?php echo $celD; ?>
                                            </td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php } ?>

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