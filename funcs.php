<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function isNull($nombre,$apellidos,$email,$cedula,$codigo,$celular,$programa,$sede,$tipo){
    if($tipo==2){
        if(strlen(trim($nombre)) < 1 || strlen(trim($apellidos)) < 1 || strlen(trim($email)) < 1 || strlen(trim($cedula)) < 1 || strlen(trim($codigo)) < 1 || strlen(trim($celular)) < 1 || strlen(trim($programa)) < 1 || strlen(trim($sede)) < 1)
    {
        return true;
        } else {
        return false;
    }	
    }else if($tipo==3){
        if(strlen(trim($nombre)) < 1 || strlen(trim($apellidos)) < 1 || strlen(trim($email)) < 1 || strlen(trim($cedula)) < 1 || strlen(trim($codigo)) < 1 || strlen(trim($celular)) < 1)
    {
        return true;
        } else {
        return false;
    }	
    }
    	
}

function isEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL)){
			return true;
			} else {
			return false;
		}
	}

    function resultBlock($errors){
		if(count($errors) > 0)
		{
			echo "<div id='error' class='alert alert-danger' role='alert'>
			<a href='#' onclick=\"showHide('error');\">[X]</a>
			<ul>";
			foreach($errors as $error)
			{
				echo "<li>".$error."</li>";
			}
			echo "</ul>";
			echo "</div>";
		}
	}

    function usuarioExiste($usuario)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT Id_Usuario FROM usuarios WHERE Usuario = ? LIMIT 1");
		$stmt->bind_param("s", $usuario);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();
		
		if ($num > 0){
			return true;
			} else {
			return false;
		}
	}

    
?>