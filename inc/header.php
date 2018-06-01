<? php
session_start();
?>
 <header class="main-h group">
    <h1 class="logo-h"><a id="back" href="index.php">MIXR</a></h1>
<nav class="action">
    <ul>
        <li><a href="#" id='btn_popup'>Register</a></li> 
           <div class="window_pop">
            <div class="wp_content">
              <form class='regform' method='POST' enctype= "multipart/form-data">
             <table>
                 <tr>
                     <td>Your name:</td>
                     <td><input type="text" name='u_name' required></td>
                 </tr>
                 
                  <tr>
                     <td>Your email:</td>
                     <td><input type="email" name='u_email' required></td>
                 </tr>
                 
                  <tr>
                     <td>Your password:</td>
                     <td><input type="password" name='u_pwd' required></td>
                 </tr>
                 
                  <tr>
                     <td>Your phone:</td>
                     <td><input type="text" name='u_phone' required></td>
                 </tr>
                 
                  <tr>
                     <td>City:</td>
                     <td><input type="text" name='u_city' required></td>
                 </tr>
                 
                 <tr>
                     <td>Address:</td>
                     <td><input type="text" name='u_adrs' required></td>
                 </tr>
             </table>   
             <a href="#" id='btn_close'>X</a>
             <button class="success" name='regbtn'><a href="#">Finish registration</a></button> 
         </form>                  
            </div>     
        </div> 
        <?php
		if(isset($_SESSION['u_id'])){
			echo'<form action="inc/logout.inc.php" method="POST">
			<button type="submit" name="submit">Logout</button>
			</form>';
		}else{
			echo'<li><a href="#" id="btnl_pop">Log In</a></li>
        <div class="windowsl_pop">
            <div class="wpl_content">
              <form class="logform" method="POST" action="inc/login.inc.php" enctype= "multipart/form-data">
             <table>  
                  <tr>
                     <td>Your email:</td>
                     <td><input type="email" name="u_email"required></td>
                 </tr>
                 
                  <tr>
                     <td>Your password:</td>
                     <td><input type="password" name="u_pwd" required></td>
                 </tr>
				  </table>
				   <button class="success" name="logbtn"><a href="#">Login</a></button> 
				    <a href="#" id="btnl_close">X</a>
				</form>
			</div>
		</div>';
			}   

		?>
    </ul>
</nav>

<div class="opts">
    <form method="get" action="search.php" name="srch" class="s-form" enctype="multipart/form-data">
        <input id="pretraga" type="text"  name="user_q" placeholder="Search...">
        <button name="search" class="search">Search</button>
        <button class="cart"> <a href='cart.php'>Cart <?php include_once('inc/functions.php'); echo product_counter();?></a></button>
    </form>
</div>

<nav class="navbar">
    <ul class="navlinkz">
        <li><a class="catlink" href="">Categories</a>
            <ul class="categories">
                <?php 
                include_once('inc/functions.php');
               echo readallcats();
                ?>
            </ul>
        </li>
        <li><a class="navlinks" href="">Brands</a></li>
        <li><a class="navlinks" href="">Aritsts</a></li>
    </ul>
</nav>

</header>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/myscript.js"></script>
