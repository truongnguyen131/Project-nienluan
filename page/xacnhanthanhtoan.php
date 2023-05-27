<?php
include "../mail/PHPMailer/src/PHPMailer.php";
include "../mail/PHPMailer/src/Exception.php";
include "../mail/PHPMailer/src/OAuth.php";
include "../mail/PHPMailer/src/POP3.php";
include "../mail/PHPMailer/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SendMail
{
    public function SendMailInfo($mailkhachhang,$noidung)
    {
        $mail = new PHPMailer(true);
        $mail->CharSet = ('UTF-8 ');
        try {
            //Server settings
            $mail->SMTPDebug = 0; // Enable verbose debug output
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'trib1906791@student.ctu.edu.vn'; // SMTP username
            $mail->Password = 'rdhceidpueiorhve'; // SMTP password
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587; // TCP port to connect to

            //Recipients
            $mail->setFrom('trib1906791@student.ctu.edu.vn', 'GAMESTORE');
            $mail->addAddress($mailkhachhang, 'Mr.Tri'); // Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('trib1906791@student.ctu.edu.vn');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz'); // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name

            //Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Payment Information--GAMESTORE';
            $mail->Body = $noidung;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }

}
?>