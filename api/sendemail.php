<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

include "php/Exception.php";
include "php/PHPMailer.php";
include "php/SMTP.php";

define("SMTP_EMAIL", "sales@kenzburaq.com");
define("SMTP_PASSWORD", "bflsotpzleeyhjov");
define("RECIPIENT_NAME", "Kenz Buraq");
define("RECIPIENT_EMAIL", "sales@kenzburaq.com");

// Read the form values
$success = false;
$name = isset($_POST['name']) ? preg_replace("/[^\.\-\' a-zA-Z0-9]/", "", $_POST['name']) : "";
$senderEmail = isset($_POST['email']) ? preg_replace("/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['email']) : "";
$phone = isset($_POST['phone']) ? preg_replace("/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['phone']) : "";
$service = isset($_POST['service']) ? preg_replace("/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['service']) : "";
$subject = isset($_POST['subject']) ? preg_replace("/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['subject']) : "";
$address = isset($_POST['address']) ? preg_replace("/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['address']) : "";
$website = isset($_POST['website']) ? preg_replace("/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['website']) : "";
$message = isset($_POST['message']) ? preg_replace("/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['message']) : "";

$mail_subject = 'A contact request send by ' . $name;

$body = 'Name: ' . $name . "\r\n";
$body .= 'Email: ' . $senderEmail . "\r\n";

if ($phone) {$body .= 'Phone: ' . $phone . "\r\n";}
if ($service) {$body .= 'Service: ' . $service . "\r\n";}
if ($subject) {$body .= 'Subject: ' . $subject . "\r\n";}
if ($address) {$body .= 'Address: ' . $address . "\r\n";}
if ($website) {$body .= 'Website: ' . $website . "\r\n";}

$body .= 'Message: ' . "\r\n" . $message;

// If all values exist, send the email
if ($name && $senderEmail && $message) {

    $to_Email = RECIPIENT_EMAIL;

    $host = "smtp.gmail.com";
    $username = SMTP_EMAIL;
    $password = SMTP_PASSWORD;
    $SMTPSecure = "tls";
    $port = 587;

    $mail = new PHPMailer();

    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    // $mail->SMTPDebug = 2;
    $mail->Host = $host;
    $mail->Username = $username;
    $mail->Password = $password;
    $mail->SMTPSecure = $SMTPSecure;
    $mail->Port = $port;
    $mail->setFrom($username);
    $mail->addReplyTo($senderEmail);
    $mail->AddAddress($to_Email);
    $mail->Subject = $mail_subject;
    $mail->Body = $body;
    $mail->WordWrap = 200;
    $mail->IsHTML(false);

    if (!$mail->send()) {
        echo "<div style='color: red !important; margin-top: 20px;'>Something went wrong. Please try again.</div>";
        // $output = json_encode(array('type'=>'error', 'text' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo));
        // die($output);
    } else {
        echo "<div style='color: green !important; margin-top: 20px;'>Hi " . $name . "! Thank you for your email.</div>";
        // $output = json_encode(array('type'=>'message', 'text' => 'Hi '.$name .'! Thank you for your email'));
        // die($output);
    }

} else {
    echo "<div style='color: red !important;'>Something went wrong. Please try again.</div>";
}
