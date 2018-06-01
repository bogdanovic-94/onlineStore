<!DOCTYPE HTML>
<html lang = "en">
<head>
  <title>MIXR</title>
  <link href="https://fonts.googleapis.com/css?family=Arimo" rel="stylesheet">
  <link rel="stylesheet" href="css/master.css">
  <meta charset = "UTF-8" />
</head>
<body>

<?php include("inc/header.php");?>

 
    <div class='cartable'>
     <form method='post'  enctype="multipart/form-data">
        <table>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Quantity</th>   
            <th>Price</th>
            <th>Delete</th>
            <th>Subtotal</th>
        </tr>
        <?php
            include_once('inc/functions.php');
        echo cart_display(); ?>
      </table>    
    </form>  
     </div>
   
</body>
</html>