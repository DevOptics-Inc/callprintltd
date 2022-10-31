<?php
// require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
require("<PATH TO>/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases

$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("test@example.com", "Example User");
$email->setSubject("Sending with SendGrid is Fun");
$email->addTo("test@example.com", "Example User");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}




(() => {
    //Serialize the form at index.html page and send a proper XmlHttpRequest to ./send-mail.php
})();


<?php

  readfile('index.html');
  die();

?>


<?php

$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$email_address = $_POST['email'];
$message = $_POST['subject'];

if(empty($fname) || 
empty($lname) || 
empty($email_address) || 
empty($message)){
  echo "All fields are required!";
}

else {

$mailOptions = array(
  'firstName' => $fname,
  'lastName' => $lname,
  'emailAddress' => $email_address,
  'subject' => "Contact form submission: $fname $lname",
  'body' => "You have received a new message. ".
            "Here are the details:\nName: $fname $lname\n".
            "Email: $email_address\nMessage:\n$message"
);

$result = sendMail($mailOptions);

//$result error handling, ensuring the email has been sent, etc.

}


function sendMail($mailOptions)
{
  $sendEndpoint = 'https://api.sendgrid.com/v3/mail/send';

  //Acording to SendGrid's API email send request
  $payload = '{"personalizations": [{"to": [{"email": "skaduteye@gmail.com"}]}],
  "from": {"email": "' . $mailOptions['emailAddress'] . '"},"subject": "' . $mailOptions['subject'] . '",
  "content": [{"type": "text/plain", "value": "' . $mailOptions['body'] . '"}]}';

  $opts = array('http' =>
      array(
          'method'  => 'POST',
          'header'  => array(
            'Authorization: Bearer <<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>>',
            'Content-Type: application/json'
          ),
          'content' => $payload
      )
  );

  $context = stream_context_create($opts);

  return file_get_contents($sendEndpoint, false, $context);
}

?>
