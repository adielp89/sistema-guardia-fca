<?php
require_once 'functions.php';
date_default_timezone_set("America/Havana");
$model = new CModel;
$hoy = getdate();
//$fech_ayer = date('Y-m-d', strtotime('-1 day'));
@$fecha_Actual = $hoy[weekday] . ", " . $hoy[month] . " " . $hoy[mday] . ", " . $hoy[year];
@$semana=array(Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday);

// ENVIO DE CORREO CUANDO ES VIERNES, AQUI SE ENVIA LA NOTIFICACION A TODOS LOS ESTUDIANTES VIERNES SABADO Y DOMINGO.
if (@$hoy[weekday] == $semana[4]){
	
	//setlocale(LC_ALL,"es_CU");
    //$loc = setlocale(LC_TIME, NULL);
    $dias=2;
    for($i=1;$i<$dias;$i++)
    {
     	$dia=strftime("%d",mktime(0,0,0,date("m"),date("d")+$i,date("Y")));
        $mes=strftime("%B",mktime(0,0,0,date("m"),date("d")+$i,date("Y")));
       	echo $dia."==>".$mes;
       	

        $resulta = $model->recolectaDatos($dia,$mes);
        foreach ($resulta as $key => $value) {
			//print_r($value);
			$Nombre = $value['0'];
			$Carrera = $value['2'];
			$email= $value['1'];
			echo $Nombre."===>".$Carrera."===>".$email."===>".$dia."===>".$mes." <br>";
			
			require_once ('mail/PHPMailerAutoload.php');
	        $mail = new PHPMailer;
			$mail->SMTPDebug = 0;                               // Enable verbose debug output

			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = '10.12.1.60';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'usuario';                 // SMTP username
			$mail->Password = 'password';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 2525;                                    // TCP port to connect to

			$mail->setFrom('user@uclv.edu.cu', 'Mailer');
			$mail->addAddress($email, 'Joe User');     // Add a recipient
			$mail->addAddress('user1@uclv.edu.cu');               // Name is optional
			$mail->addReplyTo('user2@uclv.edu.cu', 'Information');
			//$mail->addCC('cc@example.com');
			//$mail->addBCC('bcc@example.com');

			//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = 'Probando Sistema para la Guardia FCA';
			//$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
			$mail->Body    = 'Probando el envio del sistema de guardia, Testeando desde la casa por adiel plasencia, sistemas de pruebas, sistema al 80%. <br> enviando copia de mensaje a maykel!!';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			//$mail->send();

				
			if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
			    echo 'Message has been sent';
			}
			
		}
        
    }

}

// EN CASO DE NO SER FIN DE SEMANA--DE LUNES A JUEVES.

else{
		$diamas= strftime("%d",mktime(0,0,0,date("m"),date("d")+1,date("Y")));
		
		$resulta = $model->recolectaDatos($diamas,@$hoy[month]);
        foreach ($resulta as $key => $value) {
			//print_r($value);
			$Nombre = $value['0'];
			$Carrera = $value['2'];
			$email= $value['1'];
			//echo $Nombre."===>".$Carrera."===>".$email."===>".$diamas."===>".@$hoy[month]." <br>";
			
			require_once ('mail/PHPMailerAutoload.php');
	        $mail = new PHPMailer;
			$mail->SMTPDebug = 0;                               // Enable verbose debug output

			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = '10.12.1.60';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'usuario';                 // SMTP username
			$mail->Password = 'password';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 2525;                                    // TCP port to connect to

			$mail->setFrom('user@uclv.edu.cu');
			//$mail->FromName ('Sistena de guardia');
			$mail->addAddress($email, 'Joe User');     // Add a recipient
			//$mail->addAddress('user1@uclv.edu.cu');               // Name is optional
			$mail->addReplyTo('user2@uclv.edu.cu', 'Information');
			//$mail->addCC('cc@example.com');
			//$mail->addBCC('bcc@example.com');

			//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = 'Probando Sistema para la Guardia FCA';
			//$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
			$mail->Body    = 'Probando el envio del sistema de guardia, Testeando desde la casa por adiel plasencia, sistemas de pruebas, sistema al 80%. <br> enviando copia de mensaje a maykel!!';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			//$mail->send();

				
			if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
			    echo 'Message has been sent';
			}
		}
}

?>