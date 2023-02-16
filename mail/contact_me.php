<?php
// Check for empty fields
if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
{
	echo "No arguments Provided!";
	return false;
}
	
$name = $_POST['name'];
$email_address = $_POST['email'];
$message = $_POST['message'];

// Set your Zoho Mail settings
$smtpHost = 'smtp.zoho.com';
$smtpUsername = 'contact@gandakinirmansewa.org.np';
$smtpPassword = '9856032133radha@123';
$smtpPort = 465;
$smtpSecure = 'ssl';

// Create the email and send the message
require_once "vendor/autoload.php"; // Include PHPMailer library
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = $smtpHost;                              // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'contact@gandakinirmansewa.org.np';                          // SMTP username
    $mail->Password   = '9856032133radha@123';                          // SMTP password
    $mail->SMTPSecure = $smtpSecure;                             // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = $smtpPort;                               // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom($email_address, $name);                      // Sender email and name
    $mail->addAddress('contact@gandakinirmansewa.org.np');       // Recipient email address
    $mail->addReplyTo($email_address, $name);                    // Reply-to email and name

    // Content
    $mail->isHTML(true);                                        // Set email format to HTML
    $mail->Subject = "Website Contact Form:  $name";
    $mail->Body    = "You have received a new message from your website contact form.<br><br>".
                     "Here are the details:<br><br>Name: $name<br>Email: $email_address<br>Message:<br>$message";

    $mail->send();
    return true;
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    return false;
}
?>
