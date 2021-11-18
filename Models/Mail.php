<?php
namespace Models;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Models\Student as Student;


require './Vendor/PHPMailer/Exception.php';
require './Vendor/PHPMailer/PHPMailer.php';
require './Vendor/PHPMailer/SMTP.php';

class Mail
{
    
    public function sendMail($email,$student)
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
                $mail->addAddress($email);        
                // $mail->addAddress('jobUTN@gmail.com');                                     // Name is optional
                // Name is optional

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $i=1;
                 $body = "Bienvenido a Jobs UTN " . $student->getFirstName() . " " . $student->getLastName() . " tu mail para ingresar es: " . $student->getEmail();
                // $body ="welcome to this job";
                $mail->Body  = $body;
                $mail->Subject = "Aplicaste para una propuesta laboral";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                $mail->send();

            } catch (Exception $ex) {

                echo  $ex->getMessage();
            }

    }

    public function emailEndJobOffer($student, $jobPosition){

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
                // $mail->addAddress($student->getEmail());   
                $mail->addAddress(ADMIN_EMAIL);   


                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $i=1;
                $body =  $student->getEmail() .", La oferta laboral a la cual aplicó: ". $jobPosition->getDescription() ." ah sido finalizada.";
          
                $mail->Body  = $body;
                $mail->Subject = "Job Offer - ". $jobPosition->getDescription();
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                $mail->send();

            } catch (Exception $ex) {

                echo  $ex->getMessage();
        }
    }

    public function emailApplicationRejected($student, $jobPosition){

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
                 $mail->addAddress($student->getEmail());                                     // Name is optional

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $i=1;
                $body = "Estimado " . $student->getEmail() .", su inscripción a la oferta laboral de: ". $jobPosition->getDescription() ." ha sido rechazada";
          
                $mail->Body  = $body;
                $mail->Subject = " Aplicación rechazada - ". $jobPosition->getDescription();
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                $mail->send();

            } catch (Exception $ex) {

                echo  $ex->getMessage();
        }
    }

}

?>