<?php
namespace Models;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\phpmailerException;
use Models\Student as Student;


require './Vendor/PHPMailer/Exception.php';
require './Vendor/PHPMailer/PHPMailer.php';
require './Vendor/PHPMailer/SMTP.php';

class Mail
{
    
    public function sendMailRegister($student)
    {

        $mail = new PHPMailer(true);

        try {
                //Server settings
                $mail->SMTPDebug =0;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                            // Enable SMTP authentication
                $mail->Username   = ADMIN_EMAIL;                     // SMTP username
                $mail->Password   = ADMIN_PASSWORD ;                               // SMTP password
                $mail->SMTPSecure = "tls";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port       = "587";                                    // TCP port to connect to
                $mail->CharSet = "UTF-8";
            
                //Recipients
                $mail->setFrom(ADMIN_EMAIL,'JobUTN');
                $mail->addAddress($student->getEmail());                        // Name is optional

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $i=1;
                 $body = "Bienvenido a Jobs UTN " . $student->getFirstName() . " " . $student->getLastName() . " tu mail para ingresar es: " . $student->getEmail();
                // $body ="welcome to this job";
                $mail->Body  = $body;
                $mail->Subject = "Aplicaste para una propuesta laboral";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                $mail->send();

            } catch (phpmailerException $ex) {

                throw $ex;
            }

    }

    public function emailEndJobOffer($student, $jobOffer){

        $mail = new PHPMailer(true);

        try {
                //Server settings
            // $mail->SMTPDebug =0;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                            // Enable SMTP authentication
                $mail->Username   = ADMIN_EMAIL;                     // SMTP username
                $mail->Password   = ADMIN_PASSWORD;                               // SMTP password
                $mail->SMTPSecure = "tls";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port       = "587";                                    // TCP port to connect to
                $mail->CharSet = "UTF-8";
            
                //Recipients
                $mail->setFrom(ADMIN_EMAIL,'JobUTN');
                 $mail->addAddress($student->getEmail());   
                // $mail->addAddress(ADMIN_EMAIL); //USA ESTE MAIL PARA PROBAR QUE LLEGAN LOS MENSAJES   


                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $i=1;
                $body =  $student->getEmail() .", La oferta laboral a la cual aplicó en " . $jobOffer->getCompany_name() . " ah sido finalizada.";
          
                $mail->Body  = $body;
                $mail->Subject = "Job Offer - ". $jobOffer->getCompany_name();
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                $mail->send();

            } catch (phpmailerException $ex) {

              throw $ex;
        }
    }

    public function emailApplicationRejected($student, $jobOffer){

        $mail = new PHPMailer(true);

        try {
                //Server settings
            // $mail->SMTPDebug =0;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                            // Enable SMTP authentication
                $mail->Username   = ADMIN_EMAIL;                     // SMTP username
                $mail->Password   = ADMIN_PASSWORD;                               // SMTP password
                $mail->SMTPSecure = "tls";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port       = "587";                                    // TCP port to connect to
                $mail->CharSet = "UTF-8";
            
                //Recipients
                $mail->setFrom(ADMIN_EMAIL,'JobUTN');
                $mail->addAddress($student->getEmail());  
                // $mail->addAddress(ADMIN_EMAIL); //USA ESTE MAIL PARA PROBAR QUE LLEGAN LOS MENSAJES   


                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $i=1;
                $body = "Estimado " . $student->getEmail() .", su inscripción a la oferta laboral de: ". $jobOffer->getCompany_name() ." ha sido rechazada";
          
                $mail->Body  = $body;
                $mail->Subject = " Aplicación rechazada - ". $jobOffer->getCompany_name();
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                $mail->send();

            } catch (phpmailerException $ex) {

                throw $ex;
        }
    }

}
