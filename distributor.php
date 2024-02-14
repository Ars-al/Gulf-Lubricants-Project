<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Set the recipient email address
    $to = 'info@gulflubricants.co';
    
    // Set the subject line
    $subject = 'Disributor Request !';
    
    // Collect the form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $message = $_POST['message'];
    
    // Validate the form data
    if (empty($firstname) || empty($lastname) || empty($email) || empty($number) || empty($message)) {
      header("Location: distributor.html?Please fill in all required fields.");
      // echo 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header("Location: distributor.html?Invalid email format.");
      // echo 'Invalid email format.';
    } else {
      // Build the email message
      $email_message = "First Name: $firstname \n\n";
      $email_message = "Last Name: $lastname \n\n";
      $email_message .= "Email: $email \n\n";
      $email_message .= "Phone Number: $number \n\n";
      $email_message .= "Message: $message \n   \n";
      
      // Set the email headers
      $headers = "From: $firstname <$email>";
      
      // Send the email
      if (mail($to, $subject, $email_message, $headers)) {
        // echo 'Your message has been sent. Thank you!';
        header("Location: distributor.html?mail send");
      } else {
        // echo 'There was an error sending your message. Please try again later.';
        header("Location: distributor.html?mail not send");
      }
    }
  }

?>