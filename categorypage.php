<!DOCTYPE HTML>
<html lang = "en">
<head>
  <title>Category</title>
  <link href="https://fonts.googleapis.com/css?family=Arimo" rel="stylesheet">
  <link rel="stylesheet" href="css/master.css">
  <meta charset = "UTF-8" />
</head>
<body>
<?php
include("inc/header.php");

echo"<div id='bleft'><ul>"; include_once('inc/functions.php');
    displaycatpage();echo"</ul></div>";
include("inc/footer.php");
?>
</body>
</html>