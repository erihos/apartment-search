<?php
    $pet = $_GET['pet'];

    if ($pet == 'Dog') {
        $sound = 'Woof';
    }
    elseif ($pet == 'Cat') {
        $sound = 'Meow';
    }
    else {
        $sound = 'Unknown';
    }
?><!doctype html>
<body>
    <!-- Php creates a global array named "$_GET" with the names and values from the query string, that is the name-value pairs in the URL after the "?" character. -->
    <h1><?php echo $sound; ?>! So, you're a <?php echo $pet; ?> Person!</h1>
</body>