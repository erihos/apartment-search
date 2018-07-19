<?php
	require_once("conn/connApts.php");
	
	// Get the Variable passed in via the anchor link/URL
	$IDapt = $_GET['IDapt'];
	
	$query = "SELECT * FROM apartments WHERE IDapt = '$IDapt'";
	$result = mysqli_query($conn, $query);

	// Test the resul, expecting '1'
//	echo mysqli_affected_rows($conn);

	// Store the row retrieved from the database
	$row = mysqli_fetch_array($result);

	//	echo $row['bldgName'];
	//	echo $row['address'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Apartments Details</title>
	<link href="css/apts.css" rel="stylesheet">
</head>

<body>
	
<!--	Create 4 rows, 3 columns table -->
<!--
	NAME NAME NAME
	IMG FLOORS YEARBUILT
	IMG DESC DESC
	ADDRESS PHONE EMAIL
-->
	<table border="1px">
		
		<tr>
			<td colspan="3">
			<h1>Apartments Details</h1>
			</td>
		</tr>
		<tr>
			<td rowspan="2">
			<img src="images/propPics/<?php echo $row['bldgPic']; ?>">
			</td>
			<td>Floor: <?php echo $row['floor']; ?></td>
			<td>Rent: <?php echo $row['rent']; ?></td>
		</tr>
		<tr>
			<td colspan="2"><?php echo $row['aptDesc']; ?></td>
		</tr>
		<tr>
			<td>Bedrooms: <?php echo $row['bdrms']; ?></td>
			<td>Baths: <?php echo $row['baths']; ?></td>
			<td>Square Feet: <?php echo $row['sqft']; ?></td>
		</tr>
	
	</table>

</body>
</html>