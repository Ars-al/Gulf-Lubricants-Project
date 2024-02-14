<?php

// $name = $_POST['name'];
// $email = $_POST['email'];
// $subject = $_POST['subject'];
// $message = $_POST['message'];

// $mailheader = "From: ". $name . "<" . $email . ">\r\n";

// $recipient = "arsalweb549@gmail.com";

// mail($recipient, $subject, $message, $mailheader) or die("Error!");

// header("Location: contact-us.html?mail send");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Set the recipient email address
    $to = 'info@gulflubricants.co';
    
    // Set the subject line
    $subject = 'Contact Info:';
    
    // Collect the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    // Validate the form data
    if (empty($name) || empty($email) || empty($message)) {
      header("Location: contact-us.html?Please fill in all required fields.");
      // echo 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header("Location: contact-us.html?Invalid email format.");
      // echo 'Invalid email format.';
    } else {
      // Build the email message
      $email_message = "Name: $name \n\n";
      $email_message .= "Email: $email \n\n";
      $email_message .= "Message: $message \n\n";
      
      // Set the email headers
      $headers = "From: $name <$email>";
      
      // Send the email
      if (mail($to, $subject, $email_message, $headers)) {
        // echo 'Your message has been sent. Thank you!';
        header("Location: contact-us.html?mail send");
      } else {
        // echo 'There was an error sending your message. Please try again later.';
        header("Location: contact-us.html?mail not send");
      }
    }
  }

?>