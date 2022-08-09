<?php
include_once('conexion_db_formu.php');
//recibo todos los datos del formulario
$Codigo_Estu=$_POST['Codigo_Estu'];
$Nombre_Estu=$_POST['Nombre_Estu'];
$Apellidos_Estu=$_POST['Apellidos_Estu']; 
$Programa_Estu=$_POST['Programa_Estu'];
$Correo_Estu=$_POST['Correo_Estu'];
$Cel_Estu=$_POST['Cel_Estu'];
$Sede_Estu=$_POST['Sede_Estu'];

echo "los datos son los siguientes: <br>";
echo "$Codigo_Estu,$Nombre_Estu,$Apellidos_Estu,$Programa_Estu,$Correo_Estu,$Cel_Estu y $Sede_Estu ";

     $conectar=conn(); // ejecuta las conexiones a la bd
     $sql="INSERT INTO estudiantes (Codigo_Estu, Nombre_Estu, Apellidos_Estu, Programa_Estu, Correo_Estu, Cel_Estu, Sede_Estu)
     VALUES ('$Codigo_Estu', '$Nombre_Estu', '$Apellidos_Estu', '$Programa_Estu', '$Correo_Estu', '$Cel_Estu', '$Sede_Estu')";
     $result = mysqli_query($conectar , $sql)or trigger_error("Query Failed! SQL- Error: ".mysqli_error($conectar))
?>