<!doctype>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	
	<script>
		
		// make sure the pswds match before sending form data
		function validatePasswords(){
			const pswd = document.getElementById('pswd').value;
			const pswd2 = document.getElementById('pswd2').value;
			// compare the pswds
			if(pswd != pswd2){
				alert("Passwords Don't Match")
				return false // stop the process --stay on this page
			} // end if
		} // end function
	
	</script>
</head>
<body>
	
	<h1>Member Join Form</h1>
	
	<form method="post" action="memberJoinProc.php" onsubmit="return validatePasswords()">
		
		<p><label>First Name: <input type="text" name="firstName" id="firstName" required></label></p>
		
		<p><label>Last Name: <input type="text" name="lastName" id=" lastName" required></label></p>
		
		<p><label>Email: <input type="email" name="email" id="email" required></label></p>
		
		<p><label>UserName: <input type="text" name="user" id="user" required></label></p>
		
		<p><label>Password: <input type="password" name="pswd" id="pswd" required></label></p>
		
		<p><label>Re-Type Password: <input type="password" name="pswd2" id="pswd2" required></label></p>
		
		<p><button>Submit</button></p>
<!--	= <input type="submit" name="submit" value="sign me up!">-->
		
	</form>
</body>
</html>