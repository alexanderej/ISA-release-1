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
    }else if($tipo==3 || $tipo==1){
        if(strlen(trim($nombre)) < 1 || strlen(trim($apellidos)) < 1 || strlen(trim($email)) < 1 || strlen(trim($cedula)) < 1 || strlen(trim($codigo)) < 1 || strlen(trim($celular)) < 1)
    {
        return true;
        } else {
        return false;
    }	
    }
    	
}

function isUserNull($usuario,$pass){
	if(strlen(trim($usuario)) < 1 || strlen(trim($pass)) < 1)
    {
        return true;
        } else {
        return false;
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

	
	function enviarEmail($email, $nombre, $asunto, $cuerpo){
		require 'PHPMailer/src/Exception.php';
		require 'PHPMailer/src/PHPMailer.php';
		require 'PHPMailer/src/SMTP.php';
		
		$mail = new PHPMailer();
		try {
			//Server settings
			$mail->SMTPDebug = SMTP::DEBUG_OFF;
			//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
			$mail->isSMTP();                                            //Send using SMTP
			$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			$mail->Username   = 'santiagocoral80@gmail.com';                     //SMTP username
			$mail->Password   = 'czrjivjpgfhhbkyx';                               //SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
			$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
		
			//Recipients
			$mail->setFrom('santiagocoral80@gmail.com', 'Envio de correo -Prueba');
			$mail->addAddress($email, $nombre);     //Add a recipient
			//$mail->addAddress('ellen@example.com');               //Name is optional
			//$mail->addReplyTo('info@example.com', 'Information');
			//$mail->addCC('cc@example.com');
			//$mail->addBCC('bcc@example.com');
		
			//Attachments
			//$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
		
			//Content
			$mail->isHTML(true);                                  //Set email format to HTML
			$mail->Subject = $asunto;
			$mail->Body    = $cuerpo;
			//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		
			$mail->send();
			return true;
		} catch (Exception $e) {
			//echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			return false;
		}
		// $mail->isSMTP();
		// $mail->SMTPAuth = true;
		// $mail->SMTPSecure = 'tls'; //Modificar//gmail tls
		// $mail->Host = 'smtp.gmail.com'; //Modificar
		// $mail->Port = '587'; //Modificar puerto
		
		// $mail->Username = 'santiagocoral80@gmail.com'; //Modificar correo emisor
		// $mail->Password = '09051999s'; //Modificar contraseña
		
		// $mail->setFrom('santiagocoral80@gmail.com', 'Envio de correo -Prueba'); //Modificar correo emisor, nombre de correo
		// $mail->addAddress($email, $nombre);
		
		// $mail->Subject = $asunto;
		// $mail->Body    = $cuerpo;
		// $mail->IsHTML(true);
		
		// if($mail->send())
		// return true;
		// else
		// return false;
	}

	function eliminarDir($carpeta){
		foreach(glob($carpeta . "/*") as $archivo_carpeta){
			if(is_dir($archivo_carpeta)){
				eliminarDir($archivo_carpeta);
			}else{
				unlink($archivo_carpeta);
			}
		}
		rmdir($carpeta);
	}
    
?>