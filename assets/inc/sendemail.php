<?php

// define("SMTP_EMAIL", "sales@kenzburaq.com")
// define("SMTP_PASSWORD", "yaqe xmxm onrb thwu")
// // Define some constants
// define( "RECIPIENT_NAME", "Kenz Buraq" );
// define( "RECIPIENT_EMAIL", "sales@kenzburaq.com" );

// // Read the form values
// $success = false;
// $name = isset( $_POST['name'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['name'] ) : "";
// $senderEmail = isset( $_POST['email'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['email'] ) : "";
// $phone = isset( $_POST['phone'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['phone'] ) : "";
// $services = isset( $_POST['services'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['services'] ) : "";
// $subject = isset( $_POST['subject'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['subject'] ) : "";
// $address = isset( $_POST['address'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['address'] ) : "";
// $website = isset( $_POST['website'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['website'] ) : "";
// $message = isset( $_POST['message'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['message'] ) : "";

// $mail_subject = 'A contact request send by ' . $name;

// $body = 'Name: '. $name . "\r\n";
// $body .= 'Email: '. $senderEmail . "\r\n";


// if ($phone) {$body .= 'Phone: '. $phone . "\r\n"; }
// if ($services) {$body .= 'services: '. $services . "\r\n"; }
// if ($subject) {$body .= 'Subject: '. $subject . "\r\n"; }
// if ($address) {$body .= 'Address: '. $address . "\r\n"; }
// if ($website) {$body .= 'Website: '. $website . "\r\n"; }

// $body .= 'message: ' . "\r\n" . $message;



// // If all values exist, send the email
// if ( $name && $senderEmail && $message ) {
//   $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
//   $headers = "From: " . $name . " <" . $senderEmail . ">";  
//   $success = mail( $recipient, $mail_subject, $body, $headers );
//   echo "<div class='inner success'><p class='success'>Thanks for contacting us. We will contact you ASAP!</p></div><!-- /.inner -->";
// }else {
// 	echo "<div class='inner error'><p class='error'>Something went wrong. Please try again.</p></div><!-- /.inner -->";
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get form data
  $name = isset( $_POST['name'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['name'] ) : "";
  $email = isset( $_POST['email'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['email'] ) : "";
  $message = isset( $_POST['message'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['message'] ) : "";
  
  // Set up the email
  $to = 'sales@kenzburaq.com';  // Replace with your company's email address
  $subject = 'New Contact Form Submission';
  $message_body = "Name: $name\nEmail: $email\nMessage:\n$message";
  $headers = "From: $email";
  
  // Send email
  $mail_sent = mail($to, $subject, $message_body, $headers);
  
  // Check and inform user
  if ($mail_sent) {
      echo json_encode(array('message' => 'Your message has been sent successfully!'));
  } else {
      echo json_encode(array('message' => 'Oops! Something went wrong and we couldn\'t send your message.'));
  }
} else {
  http_response_code(405); // Return Method Not Allowed status
  exit("Method Not Allowed");
}
?>