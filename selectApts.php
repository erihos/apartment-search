<?php

	// 1.) tThere is no form to process, so skip the POST / GET vars part 

	//2+3.) Connect o
require_once("conn/")



	// 4.) SELECT apts that bdrms are 1 from apartments
// $query = SELECT * FROM apartments";
// $query = SELECT * FROM apartments"; where bdrms = 1"
// Every column from apartments that have exactly 1 bedroom
//$query = "SELECT *  FROM apartments
//				WHERE  bdrms  >= 1
//				AND    rent   <= 3000";
				// get everything from apartments
				// Every column from apartments that have 1 or more bedrooms, and the rent is 3000 or less
	
// Select everything from the apartments table AND the buildings table. where the doreign key of apartments matches the primary key of buildings
//$query = "SELECT * FROM apartments, buildings WHERE apartments.bldgID = buildings.IDbldg"


// Select evertything from the apartments, buildings AND neighborhoods table, where the foreign key of aoartments matches the primary key of buildings and the foreign key of buildings matches the primary ley of neighborhoods.
$query = "SELECT * from apartments, buildings, neighborhoods WHERE
  apartments.bldgID = buildings.IDbldg AND
  buildings.hoodID = neighborhoods.IDhood";


/* lab:
	Create the neighborhoods table from page 26
	Add the hoodID column to buildings table
	Add the isParking column from page 35(isParking, not isAvail)

*/

	// 5.) insert the new record into members rtable
	$result = mysqli_query($conn, $query); // resultじゃなくても名前ならなんでもいい、けど通常result使う

	// 6.) "peel off" the first row of data
//	$row = mysqli_fetch_array($result); // fetch = go get
//　　↑ 「$row...」はwhile loopの中に移動したから消さなかん

// testing -- did we get any data
//	echo $row['rent']; // should be the rent of apt 1

?>

<!DOCTYPE html>
<html lang="en-us">

<head>

	<meta charset="utf-8">
	<title>Member Join Processor</title>

</head>

<body>
    
    
    
    <table width="800" border="1" cellpadding="5">
    
    <tr>
        <td colspan="14" align="center">
            <h1 align="center">Lofty Heights Apartments</h1>
            </td>
        </tr>
		
		<tr>
		
			<th>ID</th>
			<th>Apt</th>
			<th>Building</th>
			<th>Bdrms</th>
			<th>Baths</th>
			<th>Rent</th>
			<th>Floor</th>
			<th>sqft</th>
			<th>Status</th>
			<th>Neighborhood</th>
			<th>Doorman</th>
			<th>Pets</th>
			<th>Parking</th>
			<th>Gym</th>

		
		</tr>
		
		<?php
        while($row = mysqli_fetch_array($result)){ ?>
		
		<tr>
		
			<td><?php echo $row['IDapt']; ?></td>
			<td><?php echo $row['apt']; ?></td>
			<td><?php echo $row['bldgName']; ?></td>
			<td><?php echo $row['bdrms']; ?></td>
			<td><?php echo $row['baths']; ?></td>
			<td><?php echo $row['rent']; ?></td>
			<td><?php echo $row['floor']; ?></td>
			<td><?php echo $row['sqft']; ?></td>
			<td><?php echo $row['isAvail']; ?></td>
			<td><?php echo $row['hoodName']; ?></td>
			<td><?php 
              
                if($row['isDoorman'] == 0){
                  echo 'No'; 
                }else{
                  echo 'Yes';
                }
              
              ?></td>
			<td><?php
				if($row['isPet'] == 0){
                  echo 'No'; 
                }else{
                  echo 'Yes';
                }								  
			?></td>
			<td><?php
				if($row['isParking'] == 0){
                  echo 'No'; 
                }else{
                  echo 'Yes';
                }								  
			?></td>
			<td><?php
				if($row['isGym'] == 0){
                  echo 'No'; 
                }else{
                  echo 'Yes';
                }								  
			?></td>


		</tr>	
		
		
		<?php } ?>
		
	</table>
	

</body>

</html>