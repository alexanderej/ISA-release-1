<?php
require 'conexion.php';
include 'enviarPro.php';
//session_start();

if (!isset($_SESSION['Id_Usuario'])) {
    header("Location:login.php");
}
$Id_Usuario = $_SESSION['Id_Usuario'];//Codigo estudiante
$Nombre_Usuario = $_SESSION['Nombre_Usuario'];
$Tipo_Usuario = $_SESSION['Tipo_Usuario'];

if($_POST['Subir']){
    if(file_exists($_FILES['archivo']['tmp_name'])){
        if(move_uploaded_file($_FILES['archivo']['tmp_name'], 'files/'.$_FILES['archivo']['name'])){
            $url='files/'.$_FILES['archivo']['name'];
            $nombre=$_FILES['archivo']['name'];
            
            $sql = "UPDATE proyecto SET Nombre_proyecto='$nombre', url_proy='$url' WHERE Cod_Est='$Id_Usuario'";
            $resultado=$mysqli->query($sql);
            if($resultado){
                echo "Se ha modificado con exito";
                $sqlP="SELECT * FROM  proyecto WHERE Cod_Est = $Id_Usuario";
                $resultadoP = $mysqli-> query ($sqlP);

            while ($row=$resultadoP->fetch_assoc() ) {
                $id_Proyecto = $row['Cod_proyecto'];
            }

            }
            
            $sql2 = "UPDATE estudiantes SET Cod_proyecto='$id_Proyecto' WHERE Codigo_Est = '$Id_Usuario'";
    $resultado2=$mysqli->query($sql2);
            if($resultado2)
            echo "Se ha subido con exito";
            echo "Nombre: <i><a href=\"".$url."\">".$_FILES['archivo']['name']."</a></i><br>";
        }else{
            echo "No se subió";
        }
    }else{
        echo "No se ha subido";
    }
}

?>




