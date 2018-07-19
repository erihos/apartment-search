<!doctype>
<body>
	
	<h1>Apartment Rent Estimator</h1>
	
	<form method="get" action="aptRentEstProc.php">
			
		<!-- We use "get" here because we are only GETting information.
			We used "post" for the contact form because we create an email on each submission. -->
		
		
		
		<p><label>Bedrooms:<br>
			<select name = "bdrms">
				<option value="1000">Studio ($1,000)</option>
				<option value="1400">1 Bedroom ($1,400)</option>
				<option value="1800">2 Bedroom ($1,800)</option>
			</select>
		</label></p>
		
		<h2>Additional monthly charges apply for these amenities:</h2>

		<p><label><input type="checkbox" name="doorman" value="0.2">Doorman +20%</label></p>
		
		<p><label><input type="checkbox" name="riverview" value="150">View of River +$150</label></p>
		
		<p><button>Submit</button></p>
	
	</form>
</body>