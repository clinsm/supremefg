<?php

use PHPMailer\PHPMailer\PHPMailer;

function sendmail() {
  $name = "SFG Contact Form"; // Name of your website or yours
  $to = "admin@supremefg.co.za"; // Mail of receiver

  // Get form data from AJAX request (assuming it's sent using POST)
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nameFromForm = $_POST['name'];
    $emailFromForm = $_POST['email'];
    $messageFromForm = $_POST['message'];
  } else {
    // Handle the case where the request method is not POST (e.g., error message)
    $nameFromForm = "Error";
    $emailFromForm = "N/A";
    $messageFromForm = "An error occurred during form submission.";
  }

  $subject = "New Contact";

  $body = "<b>Contact Form Details</b><br>";
  $body .= "<b>Client Details <br> <br>Name: " . $nameFromForm . "<br>";
  $body .= "Email: " . $emailFromForm . "<br>";
  $body .= "Message: " . $messageFromForm . "<br>"; // Include message field
  //$body .= "Phone: N/A<br>"; // Assuming there's no phone field in the form
  $from = "noreply@supremefg.co.za"; // Your mail
  $password = "auto.Sup@l1v3"; // Your mail password
        // Ignore from here

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";
        $mail = new PHPMailer();

        // To Here

        //SMTP Settings
        $mail->isSMTP();
        // $mail->SMTPDebug = 3;  Keep It commented this is used for debugging
        $mail->Host = "mail.supremefg.co.za"; // smtp address of your email
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = $password;
        $mail->Port = 587;  // port
        $mail->SMTPSecure = "tls";  // tls or ssl
        $mail->smtpConnect([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            ]
        ]);

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($from, $name);
        $mail->addAddress($to); // enter email address whom you want to send
      //  $mail->addAddress($to2); // enter email address whom you want to send
        $mail->Subject = ("$subject");
        $mail->Body = $body;
        if ($mail->send()) {
            echo "Successfully Sent!";
        } else {
            echo "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }
    }


        // sendmail();  // call this function when you want to


            sendmail();

?>
