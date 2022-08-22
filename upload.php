<?php
require 'conexion.php';
include 'enviarPro.php';
//session_start();
$errors = array();
$mensaje = array();

if (!isset($_SESSION['Id_Usuario'])) {
    header("Location:login.php");
}
$Id_Usuario = $_SESSION['Id_Usuario'];//Codigo estudiante
$Nombre_Usuario = $_SESSION['Nombre_Usuario'];
$Tipo_Usuario = $_SESSION['Tipo_Usuario'];

if($_POST['Subir']){    
	if($_FILES["archivo"]["error"]>0){
		// echo "Error al cargar archivo";
        $mensaje[]="Error al cargar archivo";
	}else{
		///$permitidos = array("image/png","image/jpg","image/jpeg","application/pdf");
		//$limite_kb =2000;

		//if(in_array($_FILES["archivo"]["type"], $permitidos) && $_FILES["archivo"]["size"] <= $limite_kb * 1024){
			$ruta = 'documentos/'.$Id_Usuario.'/';
			$archivo = $ruta.$_FILES["archivo"]["name"];
			if(!file_exists($ruta)){
				mkdir($ruta);
			}
			if(!file_exists($archivo)){
				$resulta=@move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo);
				if($resulta){
                    $nombre=$_FILES['archivo']['name'];
                    $sql = "INSERT INTO proyecto (Nombre_proyecto, url_proy, Cod_Est, comentarios, Codigo_Doc) VALUES ('$nombre','$archivo', '$Id_Usuario', '', '')";
                    $resultado=$mysqli->query($sql);
                    if($resultado){
                        $mensaje[]="Su archivo se subió con éxito";
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
			}else{
				// echo "Archivo ya existe";
                $mensaje[]="El documento ya existía";
			}
		//}else{
		//	echo "Archivo no permitido o excede el tamaño";
		//}
	}
}else {
    $mensaje[]="Se produjo un error";
}
foreach($mensaje as $msg){
    echo "<li>".$msg."</li>";
}
?>
