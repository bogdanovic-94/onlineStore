<?php
include("inc/functions.php");

if(isset($_GET['delete_cat'])){
    echo delete_cat();
}



if(isset($_GET['delete_pro'])){
    echo delete_pro();
}

?>