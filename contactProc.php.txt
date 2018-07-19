
<?php
error_reporting(-1);
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$message = $_POST['message'];

$contact_email = 'erk0086@gmail.com';
$subject = 'Php Course Contact Form';
$headers = "From: $email\r\nReply-To: $email\r\n"; // \r\n = new line 改行

// Build the email body containing the user informarion and the message
$msg = "Email from Contact Form\n";
$msg .= "First Name: " . $firstName . "\n";
$msg .= "Last Name: " . $lastName . "\n";
$msg .= "Email: " . $email . "\n\n";
$msg .= "Comments\n: " . $message . "\n";

//echo $msg;
//exit();

// Tell php to try to send the email
$mailSent = mail($contact_email, $subject, $msg);


?><!doctype html>

<body>
	
	<h1><?php echo "Hi $firstName $lastName!"; ?>
	</h1>
	
	<h2><?php
		if($mailSent){
			echo "Your message was sent. Thank you.";
		}
		else{
			echo "Could not send the message. Please try again.";
		}

	
	?></h2>

</body>