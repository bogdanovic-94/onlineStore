<!DOCTYPE HTML>
<html lang = "en">
<head>
  <title>MIXR</title>
  <link href="https://fonts.googleapis.com/css?family=Arimo" rel="stylesheet">
  <link rel="stylesheet" href="css/master.css">
  <meta charset = "UTF-8" />
</head>
<body>
<?php
include("inc/header.php");
include("inc/bleft.php");
include("inc/features.php");
include("inc/footer.php");
include_once('inc/functions.php');
    echo addto_cart();
	echo register();
?>

</body>

</html>