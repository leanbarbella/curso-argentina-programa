<?php
/**
 * @version 1.0
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

// Valores enviados desde el formulario
if ( !isset($_POST["Nombre"]) || !isset($_POST["Telefono"]) ||!isset($_POST["Email"]) || !isset($_POST["Mensaje"]) ) {
    die ("Es necesario completar todos los datos del formulario");
}
$nombre = $_POST["Nombre"];
$email = $_POST["Email"];
$telefono = $_POST["Telefono"];
$mensaje = $_POST["Mensaje"];



// Datos de la cuenta de correo utilizada para enviar vía SMTP
$smtpHost = "smtp.gmail.com";  // Dominio alternativo brindado en el email de alta 
$smtpUsuario = "barbellaleandro@gmail.com";  // Mi cuenta de correo
$smtpClave = "fausto2019";  // Mi contraseña
//$smtpHost ='mail.solution-it.com.ar';  // Dominio alternativo brindado en el email de alta 
//$smtpUsuario = 'daniel@solution-it.com.ar';  // Mi cuenta de correo
//$smtpClave = 'T7mRGO6y6fPLKjDYO78t';  // Mi contraseña

// Email donde se enviaran los datos cargados en el formulario de contacto
$emailDestino = "barbellaleandro@gmail.com";
//$emailDestino = "daniel@solution-it.com.ar";

$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();        // Set mailer to use SMTP
    $mail->Host       = $smtpHost;  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = $smtpUsuario;                     // SMTP username
    $mail->Password   = $smtpClave;                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 25;  //587
    $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);// TCP port to connect to

 //Recipients
    $mail->setFrom($email, $nombre);
    $mail->addAddress($emailDestino, 'Leandro');   // Add a recipient

 // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Nueva consulta de CV';
    $mail->Body = "<html>
                        <body style='background-color:#eee;'>
                            <table style='width:600px; background-color:#fff;'>
                                <tbody>
                                    <tr>
                                        <td style='width:150px'><strong>Nombre: </strong></td>
                                        <td style='width:400px'>$nombre</td>
                                    </tr>
                                    <tr>
                                        <td style='width:150px'><strong>Nombre: </strong></td>
                                        <td style='width:400px'>$telefono</td>
                                    </tr>
                                    <tr>
                                        <td style='width:150px'><strong>Email: </strong></td>
                                        <td style='width:400px'>$email</td>
                                    </tr>
                                    
                                    <tr>
                                        <td style='width:150px'><strong>Consulta: </strong></td>
                                        <td style='width:400px'>$mensaje</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </body>
                    </html>";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
$mail->send();
    header( 'Location: https://somapublicidad.com.ar/gracias.html' ) ;
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    
}
