<?php
require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

function sendBooking() {
  // Sanitize and validate POST data
  $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $services = filter_var($_POST['services'], FILTER_SANITIZE_STRING);
  $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format.";
    return;
  }

  $to = "admin@supremefg.co.za";
  $subject = "New Booking from Supreme Financial Group Website";

  $body = "<b>Booking Details</b><br>";
  $body .= "<b>Client Name: </b>" . htmlspecialchars($name) . "<br>";
  $body .= "<b>Email: </b>" . htmlspecialchars($email) . "<br>";
  $body .= "<b>Services: </b>" . htmlspecialchars($services) . "<br>";
  $body .= "<b>Message: </b>" . nl2br(htmlspecialchars($message)) . "<br>";

  // Configure PHPMailer
  $mail = new PHPMailer(true);

  try {
    $mail->isSMTP();
    $mail->Host = "mail.supremefg.co.za";
    $mail->SMTPAuth = true;
    $mail->Username = "noreply@supremefg.co.za";
    $mail->Password = "auto.Sup@l1v3";
    $mail->Port = 587;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    $mail->isHTML(true);
    $mail->setFrom("noreply@supremefg.co.za", "Supreme Financial Group");
    $mail->addAddress($to);

    $mail->Subject = $subject;
    $mail->Body = $body;

    if ($mail->send()) {
      echo "Successfully Sent!";
    } else {
      echo "Something went wrong: " . $mail->ErrorInfo;
    }
  } catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
  }
}

  sendBooking();
?>
