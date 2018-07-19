<?php
	require_once("conn/connApts.php");
	// load the buildings for the select menu
	$query = "SELECT IDbldg, bldgName FROM buildings 
	ORDER BY bldgName ASC";
	$result = mysqli_query($conn, $query);
	echo mysqli_error($conn); // check to see if we have any errors yet
?>

<!doctype>
<html lang="en-us">
<head>
	
	<title>Apartment Search</title>
	<link href="css/apts.css" rel="stylesheet">
	
</head>

<body>

	<div id="container">
	
		<h1>Apartment Rent return Estimator</h1>
		
<!--		We use "get" here because we rwe only GETing information-->

		<br><form method="get" action="searchAptsProc.php" onsubmit="return validateMinMaxRent()">

			
			<!-- keyword search -->
			<p>Search: <input type="search" name="search" id="search"></p>
			
			
			<!--		
				Lab:
					Add minRent select in searchApp.php 
					すぐ下の<p><label>...whileのやつ
					and searchAptsProc.php
					Add validateMinMaxRent() function to ensure that the maxRent is >= minRent // 1. と 4. のやつ
			-->

			<p>Building:
				<select name="bldgID" id="bldgID">
					<option value="-1">Any</option>
					<?php
					
						while($row=mysqli_fetch_array($result)){
							echo '<option value="' . $row['IDbldg'] . '">' . $row['bldgName'] . '</option>';
						}
					?>
					
				</select>
			</p>
			
			

			<p>Min Rent:
				<select name = "minRent" id="minRent">
					<option value="0">Any</option>

					<?php
					$i = 1000;

					while($i <= 5000){
					echo '<option value="' . $i . '">$' . number_format($i) . '</option>';
					$i += 250;
					}

					?>

				</select>
			</p>




			<p>Max Rent:
				<select name = "maxRent" id="maxRent">
					<option value="999999">Any</option>


					<?php
					$i = 2000;

					while($i <= 7500){
					echo '<option value="' . $i . '">$' . number_format($i) . '</option>';
					$i += 500;
					}

					?>

				</select>
			</p>


			<p>Bedrooms:
				<select name = "bdrms" id="bdrms">
					<option value="-1">Any</option>
					<option value="0">Studio</option>
					<option value="1">1 Bedroom</option>
					<option value="1.5">1+ Bedroom</option>
					<option value="2">2 Bedrooms</option>
					<option value="2.5">2+ Bedrooms</option>
					<option value="3">3 Bedrooms</option>
				</select>
			</p>

			<p>Baths:
				<select name="baths" id="baths">
					<option value="-1">Any</option>
					<option value="1">1 Bath</option>	
					<option value="1.5">1 1/2 Baths</option>	
					<option value="1.6">1 1/2+ Baths</option>	
					<option value="2">2 Baths</option>	
					<option value="2.1">2+ Baths</option>	
					<option value="2.5">2 1/2 Baths</option>	
				</select>
			</p><br>
		

			<h2>Building Amenities:</h2>


<!--文字クリックしてもチェックできないバージョン-->
<!--
			<input type="checkbox" name="doorman" value="doorman" class="cbw">
			<label for="doorman">Doorman</label>
-->
<!--文字クリックでチェックできるバージョン-->
<!--			<p><label><input type="checkbox" name="pets" value="pets" class="cbw">Pet-friendly</label></p>-->
			
			
			

			<input type="checkbox" name="doorman" value="doorman" class="cbw">
			<label for="doorman">Doorman</label>

			<input type="checkbox" name="pets" value="pets" class="cbw">
			<label for="doorman">Pet-friendly</label><br><br>
			
			<input type="checkbox" name="parking" value="parking" class="cbw">
			<label for="doorman">Parking</label>
			
			<input type="checkbox" name="gym" value="gym" class="cbw">
			<label for="doorman">Gym</label><br><br>
			
			
<!--			let user choose how results are ordered -->

			<p>Sort by:
				<select name="orderBy" id="orderBy"><br>
					<option value="bdrms">Bedrooms</option>
					<option value="bldgName">Building Name</option>
					<option value="rent" selected>Rent</option>
					<option value="sqft">Square Feet</option>
				</select>&nbsp; &nbsp; &nbsp;
				
				
<!--				let user specify num results per pg-->
				Result Per Page:
				<select name="rowsPerPg" id="rowsPerPg">
					<option value="5">5</option>
					<option value="10" selected>10</option>
					<option value="25">25</option>
					<option value="50">50</option>
				</select>	
			</p>
				
<!--			let user select ASC 昇順 or DESC 降順 order of results-->
			<p>
				<input type="radio" name="ascDesc" class="cbw" value="ASC" id="asc" checked>
				<label for="asc">Ascenidng</label>

				<input type="radio" name="ascDesc" class="cbw" id="desc" value="DESC">
				<label for="desc">Descenidng</label>
			</p>
			
			
			
			<p><button style="width:100%; 
								padding:5px; 
								font-size:1rem; 
								color:#363; 
								font-weight:600; 
								background-color:#8C8; 
								letter-spacing:10px; 
								text-transform:uppercase">Submit</button></p>

		</form>

	</div><!-- close #container -->
	
	<script>
		function validateMinMaxRent(){
			let minRent = (document.querySelector('#minRent').value);
			let maxRent = (document.querySelector('#maxRent').value);
		
			if(minRent >= maxRent){
				alert('Please choose a min rent value that is less than the max rent value');
				return false;
			}
		
		
		}
		
	
	</script>
	
	
	
	
	
	
</body>
</html>