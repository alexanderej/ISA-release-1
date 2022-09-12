<?php

   
   require 'conexion.php';
session_start();
   // valodar siel usuarionesta iniciando sesion o no

   if (!isset($_SESSION['Id_Usuario'])) {
       header("Location:login.php");
     }

    $Id_Usuario=$_SESSION['Id_Usuario'];    
    $Tipo_Usuario = $_SESSION['Tipo_Usuario'];
    $Nombre_Usuario = $_SESSION['Nombre_Usuario'];
    $nombre="";
    $comentarios = "";
    $fecha="";
    $aval=$_GET['avalar'];

    if($Tipo_Usuario==3){//////Para docentes
        $sql="SELECT * FROM  docentes WHERE Codigo_Doc = $Id_Usuario";
        $resultado = $mysqli-> query ($sql);
        while ($row=$resultado->fetch_assoc() ) {
            $id_Proyecto = $row['Cod_proyecto'];////obtener codigo de proyecto asignado
            $nombre = $row['Nombre_Doc'].' '.$row['Apellidos_Doc'];
            $id_Est = $row['Codigo_Est'];/////obtener codigo de estudiante asignado
        }
        $sqlE="SELECT * FROM  estudiantes WHERE Codigo_Est = $id_Est";
        $resultadoE = $mysqli-> query ($sqlE);
    }
    if($Tipo_Usuario==2){
        $sql="SELECT * FROM  estudiantes WHERE Codigo_Est = $Id_Usuario";
        $resultado = $mysqli-> query ($sql);
        while ($row=$resultado->fetch_assoc() ) {
            $id_Proyecto = $row['Cod_proyecto'];
            $nombre = $row['Nombre_Est'].' '.$row['Apellidos_Est'];
            $id_Doc = $row['Codigo_Doc'];
        }
        $sqlD="SELECT * FROM  docentes WHERE Codigo_Doc = $id_Doc";
        $resultadoD = $mysqli-> query ($sqlD);
    }
        $sqlP="SELECT * FROM  proyecto WHERE Cod_proyecto = $id_Proyecto";
        $resultadoP = $mysqli-> query ($sqlP);

        $sqlCom = "SELECT comentarios FROM proyecto WHERE Cod_proyecto = $id_Proyecto";
        $resultadoCom=$mysqli->query($sqlCom);
        while ($row=$resultadoCom->fetch_assoc() ) {
            $comentarios = $row['comentarios'];

        }
        $sqlProy = "SELECT * FROM proyecto WHERE Cod_proyecto = $id_Proyecto";
        $resultadoProy=$mysqli->query($sqlProy);
        while ($row=$resultadoProy->fetch_assoc() ) {
            $comentarios = $row['comentarios'];
            $calificaciones = $row['calificaciones'];
            $fecha = $row['fecha'];
        }

        if($_POST){
        //echo 'Funciona post';
    ////obtener los valores de las variables del formulario
    /************************************************************* */
    $com = $comentarios.'.\n '.$_POST['comentarios'];
        $sqlP2 = "UPDATE proyecto SET comentarios='$com' WHERE Cod_proyecto = $id_Proyecto";
        $resultadoP2=$mysqli->query($sqlP2);

        $resultadoCom=$mysqli->query($sqlCom);
        while ($row=$resultadoCom->fetch_assoc() ) {
            $comentarios = $row['comentarios'];
        }
           
    }
     if($aval==1){
        $sqlP3 = "UPDATE proyecto SET calificaciones='APROBADO' WHERE Cod_proyecto = $id_Proyecto";
        $resultadoP3=$mysqli->query($sqlP3);

        $sqlProy2 = "SELECT * FROM proyecto WHERE Cod_proyecto = $id_Proyecto";
        $resultadoProy2=$mysqli->query($sqlProy2);
        while ($row=$resultadoProy2->fetch_assoc() ) {
            $calificaciones = $row['calificaciones'];
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

    <title>Revisión de Proyecto</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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

            <!-- Divider -->----------------
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">


                    <span>Universidad De Nariño</span></a>
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
                    <span>Inscripción Trabajo de Grado</span>
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
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Mostrando Proyecto de grado...</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <?php if($Tipo_Usuario==3) { ///para doocente
                            //echo 'codigo'.$id_Est.'codigo';
                            //$num=$resultadoE->num_rows;    
                            if ($id_Est>0){ 
                            ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Datos del Estudiante</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Programa</th>
                                        <th>Correo</th>
                                        <th>Celular</th>
                                        <th>Sede</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row=$resultadoE->fetch_assoc() ) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['Codigo_Est'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Cedula_Est'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Nombre_Est']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Apellidos_Est']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Programa_Est']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Correo_Est']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Cel_Est']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Sede_Est']; ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                        <?php 
                            }else{
                                echo '
                            <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">No ha sido asignado como Docente aún!!</h6>
                        </div>';
                        }
                    } ?>
                        <?php if($Tipo_Usuario==2) { ///para el estudiante  
                            if ($id_Doc>0){ 
                            ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Datos del Docente</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Correo</th>
                                        <th>Celular</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row=$resultadoD->fetch_assoc() ) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['Codigo_Doc'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Cedula_Doc'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Nombre_Doc']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Apellidos_Doc']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Correo_Doc']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Cel_Doc']; ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                        <?php 
                            }else{
                                echo '
                            <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">No se ha asignado un Docente aún</h6>
                        </div>';
                        }
                    } ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Proyecto</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Código del proyecto</th>
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
                                                <?php
                                                if($id_Proyecto>0){?>
                                                    <a href="<?php echo $urlP;?> " target="_blank">
                                                        <?php echo $nom_pro; ?>
                                                    </a>
                                                <?php }else {
                                                    echo '
                            <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">No se ha registrado un Proyecto aún</h6>
                        </div>';
                                                }
                                                ?>
                                                    
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

                    <div>
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">      
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Estado de la entrega
                                        </div>
                                        
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Estado de la entrega</th>
                                                    <td>
                                                        <?php
                                                            if($id_Proyecto>0){
                                                        ?>
                                                            Enviado para revisión
                                                        <?php }else{?>
                                                            No entregado
                                                        <?php }?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Estado de la calificación</th>
                                                    <td>
                                                        <?php
                                                            if($id_Proyecto>0){
                                                                echo $calificaciones
                                                        ?>
                                                             
                                                        <?php }else{?>
                                                            No tiene ningun proyecto cargado
                                                        <?php }?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Fecha de resgistro </th>
                                                    <td colspan="2"><?php echo $fecha?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <?php
                                            if($Tipo_Usuario==3){
                                        ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <a href="visualizarProyecto.php?avalar=1" class="btn btn-primary">
                                AVALAR
                            </a>
                                            </div>
                                            <?php }?>
                                    </div>       
                                    <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pending Requests Card Example -->
                    <?php
                    if($id_Proyecto>0){
                        ?>
                    <div>
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">      
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Comentarios
                                        </div>
                                        <div class="card mb-4"><div class="card-body"><?php
                                            echo $comentarios;
                                            ?></div></div>
                                        
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="user"
                                                enctype="multipart/form-data">
                                                <textarea name="comentarios" id="comentarios" cols="50"
                                                    rows="5" placeholder="Escriba su comentario"></textarea><br>
                                                <button type="submit" class="btn btn-primary btn-user">Enviar</button>
                                            </form>
                                        </div>
                                    </div>       
                                    <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }?>

                    
                    
                    

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
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="./css/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
</body>
</html>