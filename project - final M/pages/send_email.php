<!-- raghad bahawi : use phpmailer to recieve masseges from the user to our email -->

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
        $mail->Password = 'pgwhmefyyklcjmzo'; // App password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->Timeout = 20;

        // Fix SSL issues (important!)
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ];

        // Recipients
        $mail->setFrom('contactus.glamor.hr@gmail.com', $_POST['name']);
        $mail->addReplyTo($_POST['email'], $_POST['name']);
        $mail->addAddress('contactus.glamor.hr@gmail.com', 'Glamour HR');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact : ' . htmlspecialchars($_POST['subject']) . '';
        $mail->Body = '
        <div >
            <h2 style="color:rgb(215, 129, 129); text-align: center;"> Contact Request : ' . htmlspecialchars($_POST['subject']) . '</h2>
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                <tr>
                    <td style="padding: 8px; border: 1px solid rgb(186, 81, 81); color:#ffff; background-color:rgb(215, 129, 129);"><strong>Name:</strong></td>
                    <td style="padding: 8px; border: 1px solid rgb(186, 81, 81)">' . htmlspecialchars($_POST['name']) . '</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border: 1px solid rgb(186, 81, 81); color:#ffff;  background-color: rgb(215, 129, 129);"><strong>Email:</strong></td>
                    <td style="padding: 8px; border: 1px solid rgb(186, 81, 81);">' . htmlspecialchars($_POST['email']) . '</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border: 1px solid rgb(186, 81, 81);  color:#ffff; background-color: rgb(215, 129, 129);"><strong>Phone:</strong></td>
                    <td style="padding: 8px; border: 1px solid rgb(186, 81, 81);">' . htmlspecialchars($_POST['phone']) . '</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border: 1px solid rgb(186, 81, 81); color:#ffff;  background-color: rgb(215, 129, 129);"><strong>Subject:</strong></td>
                    <td style="padding: 8px; border: 1px solid rgb(186, 81, 81);">' . htmlspecialchars($_POST['subject']) . '</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border: 1px solid rgb(186, 81, 81); color:#ffff;  background-color:rgb(215, 129, 129);"><strong>Message:</strong></td>
                    <td style="padding: 8px; border: 1px solid rgb(186, 81, 81);">' . nl2br(htmlspecialchars($_POST['message'])) . '</td>
                </tr>
            </table>
        </div>';
    

        $mail->send();

        // Redirect to show success modal
        header("Location: contact.php?sent=1");
        exit;

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
