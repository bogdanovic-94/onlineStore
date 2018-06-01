<div class="slider">                                               <h3>Deals of the day</h3>
</div>  
<!--    end slider-->


<div id='bleft'>

<?php 

if(!isset($_GET['cat_id']))  {?>


<ul>
    <?php include_once('inc/functions.php'); echo mixers(); ?>
</ul><br clear='all'/>
<ul>
    <?php require_once('inc/functions.php'); 
    echo headphones(); ?>
</ul><br clear='all'/>

<ul>
    <?php require_once('inc/functions.php'); 
    echo speakers(); ?>
</ul><br clear='all'/>
<?php }?>
</div>


