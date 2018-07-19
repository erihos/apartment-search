<?php

	// 1.) There is no form to process, so skip the POST / GET vars part
	$bdrms = $_GET['bdrms'];
	$baths = $_GET['baths'];
	$minRent = $_GET['minRent'];
	$maxRent = $_GET['maxRent'];
	$bldgID = $_GET['bldgID']; // from dynamic bldg menu (Any==-1)
	$orderBy = $_GET['orderBy']; // how user wants to sort the result
	$ascDesc = $_GET['ascDesc']; // radio button choice of ASC or DESC




	//2+3.) Connect to mysql, and select the databese
	require_once("conn/connApts.php");

	// 4.) write out the CRUD "order" (query)  -- what you want to do
	$query = "SELECT * from apartments, buildings, neighborhoods 
	WHERE apartments.bldgID = buildings.IDbldg 
	AND buildings.hoodID = neighborhoods.IDhood 
	AND  rent BETWEEN '$minRent' AND '$maxRent'";
	
	// concat query if user chose a bldg from dynamic bldg menu
if($bldgID !=  -1){ // if user chose a bldg (not ANY)
	$query .= " AND bldgID = '$bldgID'";
}


	// concat query if user typed something into search box
	if($_GET['search'] != ""){ // true if user typed something
		$search = $_GET['search'];
		$query .= " AND (aptDesc LIKE '%$search%' 
						OR bldgDesc LIKE '%$search%' 
						OR hoodDesc LIKE '%$search%' 
						OR bldgName LIKE '%$search%' 
						OR aptTitle LIKE '%$search%' 
						OR address LIKE '%$search%')";									
	} // LIKE means 'includes' - % = 'どんな言葉がきてもいい'





	// concat query for bdrms and baths if menu choice is NOT "Any"
	if($bdrms != -1){ // if bdrms menu choice is not "Any"
		// filter for bdrms (concat query)
		// is it a plus sign hoice or not (1+, 2+) .. ??
		// if rounding off berms does NOT change value, then
		// bdrms is an integer already (NOT 1.1 or 2.1)
		if($bdrms == round($bdrms)){
			$query .= " AND bdrms='$bdrms'";
		}else{ // rounding off DID change the value, so
				// bdrms is NOT an integer, but rather 1.1 or 2.1
				// lose the point-1
			$bdrms = round($bdrms);
			$query .= " AND bdrms >='$bdrms'";
		}// end if-else
	}// end if
		
	if($baths != -1){ // if bdrms menu choice is not "Any"
			// filter for bdrms (concat query)
			// multiply baths by 10 to get rid of pesky decimals
		$baths10 = $baths * 10; // 1.5 becomes 15; 1.6 becomes 16
		// do we get a remainder when dividing by 5? If so, it is a plus-sign choice value (16, 21)
		if($baths10 % 5 == 0){ // if value is 15, 20, 25
			$query .=" AND baths='$baths'";
		}else{ // has reminader, hence plus-sign choice
			$baths -= 0.1;
			$query .= " AND baths >= '$baths'";
		}
	}




//	AND bdrms = '$bdrms' 
//	AND baths = '$baths' 
	// すべてAnyにした場合に、すべての結果が出るようにするために上記のAND 2行消す（元はAND building...の下にあった）

	// concat query for checkboxes -- "check" to see, one by one, if the checkboxes are actually checked
		
	if(isset($_GET['doorman'])){ // is the doorman variable set. if so it came over from the form. meaning doorman was checked
		$query .= " AND isDoorman=1";
	}
	
	if(isset($_GET['pets'])){
		$query .= " AND isPets=1";
	}

	if(isset($_GET['parking'])){
		$query .= " AND isParking=1";
	}

	if(isset($_GET['gym'])){
		$query .= " AND isGym=1";
		
	}

//	$query .=" AND isDoorman=1"; // show only the apts that doorman is 1(yes)
//	$query .=" AND isPets=1"; // show only the apts that pet is 1(yes)
		
	$query .= " ORDER BY $orderBy $ascDesc"; // ORDER の前のスペースは必要、なかったら上記のisGym=1とくっついてることになるから - this line MUST be LAST!! この行が最後にこなかん

	//WHERE - myadmin の apartment からとってくる情報 = buildings の IDbldg  からとってくる
	//AND - 
	//AND - 
	//AND - 
	//// Order by *columnName* *ASC/DESC* <-- Sort based on a column - 


	// 5.) insert the new record into members rtable
	$result = mysqli_query($conn, $query); // resultじゃなくても名前ならなんでもいい、けど通常result使う

?>

<!DOCTYPE html>
<html lang="en-us">
<head>

	<meta charset="utf-8">
	<title>Lfty Hts Apts</title>

</head>

<body>
    
    
    
    <table width="800" border="1" cellpadding="5" background-color="azure">
    
    <tr>
        <td colspan="14" align="center">
            <h1 align="center">Lofty Heights Apartments</h1>
        	<h2><?php echo mysqli_num_rows($result); ?> Results Found</h2>    
		</td>
        </tr>
		
		<?php
			if(mysqli_num_rows($result) == 0){ // no results
				echo '<tr>
						<td>
							<h3 align="center">
								Sorry! No results found! Please Search Again!
								<button onclick="window.history.back()">
									Search Again</button></br>
									Redirecting...</h3></td></tr>';
				
				// if user does not click the search Again button,
				// redirect to search page after 5 seconds
				header("Refresh:5; url=searchApts.php", true, 303);
				
			}else{ // we got at least 1 result, so output header row
				echo '<tr>		
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
					</tr>';
			
				
			} // end if-else
		?>
		
		
		
		
		<?php
        while($row = mysqli_fetch_array($result)){ ?>
		
		<tr>
		
			<td><?php echo $row['IDapt']; ?></td>
			<td>
				<?php 
					echo '<a href="aptDetails.php?IDapt=' 
						. $row['IDapt'] . '">' 
						. $row['apt'] . '</a>';						
				?>
			</td>
			
			<td>
			
				<?php
					echo '<a href="bldgDetails.php?bldgID='
						. $row['bldgID'] . '">'
						. $row['bldgName'] . '</a>';
				?>

			</td>

			
			
			<td>
				<?php
				
//				if($row['bdrms'] == 0){
//					echo 'Studio';
//				}else{
//					echo $row['bdrms'];
//				}
												  
//				↑ same ↓							  
												  
				echo $row['bdrms'] == 0 ? 'Studio' : $row['bdrms'];		  
				
				?>
			</td>
			
			<td><?php echo $row['baths']; ?></td>
			<td><?php echo number_format($row['rent']) ?></td>
			<td><?php echo $row['floor']; ?></td>
			<td><?php echo number_format($row['sqft']); ?></td>
			<td>
				<?php 
												  
					if($row[isAvail] == 0){
						echo "occupied";
					}else{
						echo "Available";
					}
				?>
			</td>
			
			<td><?php echo $row['hoodName']; ?></td>
			<td>
				<?php 
              
                if($row['isDoorman'] == 0){
                  echo 'No'; 
                }else{ // value is 1 
                  echo 'Yes';
                }
              
              ?>
			</td>
			
			<td>
				<?php echo $row['isPets'] == 0 ? 'No' : 'Yes'; ?>
			</td>
			<td>
				<?php echo $row['isParking'] == 0 ? 'No' : 'Yes'; ?>
			</td>
			<td>
				<?php echo $row['isGYm'] == 0 ? 'No' : 'Yes'; ?>
			</td>


		</tr>	
		
		
		<?php } ?>
		
	</table>
	

</body>

</html>