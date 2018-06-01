 
<?php 
if(!isset($_GET['insert_cat'])){
if(!isset($_GET['insert_products'])){
if(!isset($_GET['viewall_products'])){
?>       
 <section class="mains">
 
 <?php 
     if(isset($_GET['edit_kat'])){
         include("editkat.php");
     }
        if(isset($_GET['edit_pro'])){
         include("editpro.php");
     }
     ?>
 
 </section>
<?php } } } ?>

