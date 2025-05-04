<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/Exception.php';
require '../phpmailer/PHPMailer.php';
require '../phpmailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'contactus.glamor.hr@gmail.com'; // Gmail
        $mail->Password = 'nghu tkcv ovan lczq'; // Use app password here
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($_POST['email'], $_POST['name']);
        $mail->addAddress('contactus.glamor.hr@gmail.com', 'Glamour HR');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body = "
            <h3>New Contact Request</h3>
            <p><strong>Name:</strong> {$_POST['name']}</p>
            <p><strong>Email:</strong> {$_POST['email']}</p>
            <p><strong>Phone:</strong> {$_POST['phone']}</p>
            <p><strong>Subject:</strong> {$_POST['subject']}</p>
            <p><strong>Message:</strong><br>{$_POST['message']}</p>
        ";

        $mail->send();

        echo "<script>
            alert('Message sent successfully!');
            window.location.href = 'contact.php';
        </script>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>


