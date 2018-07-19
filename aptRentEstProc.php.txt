<?php
// Display all errors, no matter what they are.
error_reporting(-1); // -1 = all errors = E_ALL

// if doorman/riverview was chacked

if(isset($_GET['doorman'])){
	$doorman = $_GET['doorman'];
}
else{
	// 0 = not checked, so it will not affect the final result.
	$doorman = 0;
}

// Was riverview checked
if(isset($_GET['riverview'])){
	$riverview = $_GET['riverview'];
}
else{
	$riverview = 0;
}

$bdrms = $_GET['bdrms'];

// Add the bedroom fee with the riverview addon.
$rent = $bdrms + $riverview;
// Add the doorman fee
$rent += $rent * $doorman;

?><!doctype>

<body>
	
<!--	「number_format($xxx, 2); 」 2 = dicimal 小数点以下の桁数-->
	<h1>Your estimated rent is <?php echo number_format($rent, 2); ?>.
	</h1>

</body>