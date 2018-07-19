<?php
	// processor for form on memberJoin.php

	// 1.) hand off the incoming form POST variables to 'regular' variables
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$email = $_POST['email'];
	$user = $_POST['user'];
	$pswd = $_POST['pswd'];
	
	// 2.) connect to MySQL
	$conn = mysqli_connect('localhost', 'root', 'mysql') or die("Couldn't Connect to MySQL!"); // 以前はmysqlだった
		// or die...はなくても可

	// 3.) conecct to database
	mysqli_select_db($conn, 'loftyhts');

	// 4.) write out your CRUD "order" (query) -- what you want to do
	$query = "INSERT INTO members(firstName, lastName, email, user, pswd) VALUES('$firstName', '$lastName', '$email', '$user', '$pswd')"; // queryじゃなくてもいい、なんでもいい

	// 5.) insert the new record into members rtable
	mysqli_query($conn, $query);  //Midterm 出る！: "what goes there? - mysql_???"

?>

<!DOCTYPE html>
<html lang="en-us">

<head>

	<meta charset="utf-8">
	<title>Member Join Processor</title>

</head>

<body>
	
	<h1 align="center">
	
	<?php
	
		// 6.) give user some feedback -- did it work?
		if(mysqli_affected rows($conn) == 1){ // if it worked
			// welcome!
			echo 'Welcome ' . $firstName . '! Thanks for joining!';
		}else{ // it didnt work
			// sory!
			echo 'Sorry ' . $firstName . "! Couldn't sign you up!";
		}
	
	?>
	
	</h1>
	
	
	<h1>Thank you for joining!</h1>
	
</body>

</html>