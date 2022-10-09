<?php

   session_start();
   require 'conexion.php';

   // valodar siel usuarionesta iniciando sesion o no

   if (!isset($_SESSION['Id_Usuario'])) {
       header("Location:login.php");
     }

    $Id_Usuario=$_SESSION['Id_Usuario'];    
    $Tipo_Usuario = $_SESSION['Tipo_Usuario'];
    $Nombre_Usuario = $_SESSION['Nombre_Usuario'];
    $nombre="";


    if ($Tipo_Usuario == 1) {
        $sqlA="SELECT * FROM  admin WHERE Codigo_Adm = $Id_Usuario";
        $resultadoA = $mysqli-> query ($sqlA);

        while ($row=$resultadoA->fetch_assoc() ) {
            $nombre = $row['Nombre_Adm'].' '.$row['Apellidos_Adm'];
        }

    }

    $sql="SELECT *FROM  usuarios";
    $resultado = $mysqli-> query ($sql);
    $sqlA="SELECT * FROM  admin";
    $resultadoA = $mysqli-> query ($sqlA);
    $sqlE="SELECT * FROM  estudiantes";
    $resultadoE = $mysqli-> query ($sqlE);
    $sqlD="SELECT * FROM  docentes";
    $resultadoD = $mysqli-> query ($sqlD);
    $sqlP="SELECT * FROM  proyecto";
    $resultadoP = $mysqli-> query ($sqlP);
    


?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tables</title>

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

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">


                    <span>Universidad De Nariño</span></a>
            </li>

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
                    </div>
                </div>
            </li>
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
                                    <?php echo $Nombre_Usuario.'<br>'.$nombre; 
            
            ?>
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <a href="agregarAdmin.php"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Agregar Administrador</a>
                    </div>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Mostrando usuarios registrados...</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Usuarios</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Usuario</th>
                                            <th>Password</th>
                                            <th>Nombre</th>
                                            <th>Tipo Usuario</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>usuario</th>
                                            <th>Password</th>
                                            <th>Nombre</th>
                                            <th>Tipo Usuario</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php while ($row=$resultado->fetch_assoc() ) { ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['Usuario'] ?>
                                            </td>

                                            <td>
                                                <?php echo $row['Password']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['Nombre_Usuario']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['Tipo_Usuario']; ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Administradores</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Nombre</th>
                                            <th>Apellidos</th>
                                            <th>Cédula</th>
                                            <th>Celular</th>
                                            <th>Correo</th>
                                            <th colspan="2">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                            <th>Código</th>
                                            <th>Nombre</th>
                                            <th>Apellidos</th>
                                            <th>Cédula</th>
                                            <th>Celular</th>
                                            <th>Correo</th>
                                            <th colspan="2">Acciones</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php while ($row=$resultadoA->fetch_assoc() ) { ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['Codigo_Adm'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['Nombre_Adm'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['Apellidos_Adm']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['Cedula_Adm']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['Cel_Adm']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['Correo_Adm']; ?>
                                            </td>
                                            <td> <a href="modificarAdm.php?id=<?php echo $row['Codigo_Adm']; ?>"><span
                                            class="fas fa-pencil-alt"></span>Modificar </a> </td>
                                            
                                            <td> <a onclick="return confirm ('seguro quiere eliminar?')" class="..." href="eliminarAdm.php?id=<?php echo $row['Codigo_Adm']; ?>"> <span
                                            class="fas fa-trash"></span>Eliminar </a> </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Estudiantes</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                                            <th colspan="2">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Código</th>
                                            <th>Cédula</th>
                                            <th>Nombre</th>
                                            <th>Apellidos</th>
                                            <th>Programa</th>
                                            <th>Correo</th>
                                            <th>Celular</th>
                                            <th>Sede</th>
                                            <th colspan="2"></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php while ($row=$resultadoE->fetch_assoc() ) {
                                            $id=$row['Codigo_Est']; ?>
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
                                            <td> <a href="modificarEstudiante.php?id=<?php echo $row['Codigo_Est']; ?>"><span
                                            class="fas fa-pencil-alt"></span>Modificar </a> </td>
                                            <td> <a href="eliminar.php?id=<?php echo $row['Codigo_Est']; ?>" > <span
                                            class="fas fa-trash"></span>Eliminar </a> </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Docentes</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Cédula</th>
                                            <th>Nombre</th>
                                            <th>Apellidos</th>
                                            <th>Correo</th>
                                            <th>Celular</th>
                                            <th colspan="2">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Código</th>
                                            <th>Cédula</th>
                                            <th>Nombre</th>
                                            <th>Apellidos</th>
                                            <th>Correo</th>
                                            <th>Celular</th>
                                            <th colspan="2">Acciones</th>
                                        </tr>
                                    </tfoot>
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
                                            <td> <a href="modificarDoc.php?id=<?php echo $row['Codigo_Doc']; ?>"><span
                                            class="fas fa-pencil-alt"></span>Modificar </a> </td>
                                            <td> <a href="eliminarDoc.php?id=<?php echo $row['Codigo_Doc']; ?>"> <span
                                            class="fas fa-trash"></span>Eliminar </a> </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Proyectos</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Código del proyecto</th>
                                            <th>Nombre del proyecto</th>
                                            <th>URL</th>
                                            <th>Codigo Estudiante</th>
                                            <th colspan="2">Acciones</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php while ($row=$resultadoP->fetch_assoc() ) { ?>
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
                                            
                                            <td> <a href="asignarDocente.php?id_E=<?php echo $row['Cod_Est']; ?>&id_P=<?php echo $row['Cod_proyecto'] ?>
"><span
                                            class="fas fa-pencil-alt"></span>Asignar docente </a> </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
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
                        <span>Copyright &copy; Your Website 2020</span>
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

    
		<!-- Modal Eliminar-->
		<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
					</div>
					
					<div class="modal-body">
						¿Desea eliminar este registro?
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<a class="btn btn-danger btn-ok" href="eliminar.php?id=<?php echo $id; ?>&tipo=2">Delete</a>
					</div>
				</div>
			</div>
		</div>
		
		

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