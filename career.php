<?php

if(isset($_POST['submit'])) {
  $to = 'hr@gulflubricants.co'; // your email address
  $subject = 'Career Request !';
  
  // Collect form data
  $firstName = $_POST['first_name'];
  $lastName = $_POST['last_name'];
  $email = $_POST['email'];
  $number = $_POST['number'];
  $appliedFor = $_POST['applied_for'];
  $file = $_FILES['file'];
  
  // Headers for email
  $headers = "From: $firstName $lastName <$email>\r\n";
  $headers .= "Reply-To: $email\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: multipart/mixed; boundary=\"boundary1\"\r\n";
  
  // Message for email
  $message = "--boundary1\r\n";
  $message .= "Content-Type: text/plain; charset=\"iso-8859-1\"\r\n";
  $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
  $message .= "First Name: $firstName\r\n";
  $message .= "Last Name: $lastName\r\n";
  $message .= "Email: $email\r\n";
  $message .= "Number: $number\r\n";
  $message .= "Applied For: $appliedFor\r\n\r\n";
  $message .= "--boundary1\r\n";
  
  // Attach file to email
  $fileContent = file_get_contents($file['tmp_name']);
  $message .= "Content-Type: {\"application/octet-stream\"};\r\n";
  $message .= " name=\"$file[name]\"\r\n";
  $message .= "Content-Disposition: attachment;\r\n";
  $message .= " filename=\"$file[name]\"\r\n";
  $message .= "Content-Transfer-Encoding: base64\r\n\r\n";
  $message .= chunk_split(base64_encode($fileContent)) . "\r\n";
  $message .= "--boundary1--";
  
  // Send email
  if(mail($to, $subject, $message, $headers)) {
      // echo "Thank you for your message!";
      header("Location: career.html?Request Submited!");
  } else {
      // echo "Oops! Something went wrong. Please try again.";
      header("Location: career.html?Request Failed To Submited!");
  }
}
?>
