<?php

//register

function register(){
	
	include('inc/db.php');
	if(isset($_POST['regbtn'])){
		$u_name= $_POST['u_name'];
		$u_email =$_POST['u_email'];
		$u_pwd = mt_rand();
		$u_phone =$_POST['u_phone'];
		$u_city =$_POST['u_city'];
		$u_adrs= $_POST['u_adrs'];
			
		$add_user =$conn->prepare("insert into user (u_name, u_email, u_phone, u_city, u_adrs, u_pwd) values ('$u_name', '$u_email', '$u_phone', '$u_city', '$u_adrs', '$u_pwd')");
		if($add_user->execute()){
			echo"<script>alert('Registration complete')</script>";
			echo"<script>window.open('index.php', '_self');</script>";
		}
		else{
			echo"<script>alert('Registration failed')</script>";
		}
	}
}




// detektovanje ip adrese korisnika
function getIp() {

    $ip = $_SERVER['REMOTE_ADDR'];
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {

        $ip = $_SERVER['HTTP_CLIENT_IP'];

    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

    }
    return $ip;
}


//klasicno ubacivanje u korpu
function addto_cart(){
    include("inc/db.php");
    if(isset($_POST['cartbtn'])){
        $pro_id =$_POST['pro_id'];
        $ip =getIp();
        
        $checkcart=$conn->prepare("select * from cart where pro_id= '$pro_id' AND ip_adrs='$ip'");
        $checkcart->execute();
        $row_check = $checkcart->rowCount();
        
        if($row_check == 1){
        echo"<script>alert('Product already exists in your cart')</script>";
        }else{
        
            $addto_cart=$conn->prepare("insert into cart(pro_id, qty, ip_adrs) values ('$pro_id', '1', '$ip')");

            if($addto_cart ->execute()){
                echo"<script>window.open('index.php', '_self')</script>";
            }
            else{
                echo"<script>alert('Try again')</script>";
        }
    }
  }
}

//lagani brojac proizvoda 
function product_counter(){
    
    include('inc/db.php');
    $ip = getIp();
    $getprocart=$conn->prepare("select * from cart where ip_adrs='$ip'");
    $getprocart->execute();
    
    $countercart= $getprocart->rowCount();
    
    echo $countercart;
}

//prikaz proizvoda u korpi
function cart_display(){
   include('inc/db.php');
    $ip = getIp();
    $get_cart_items = $conn->prepare("select * from cart where ip_adrs ='$ip' ");
    $get_cart_items -> setFetchMode(PDO:: FETCH_ASSOC);
    $get_cart_items ->execute();
    $cart_empty=$get_cart_items->rowCount();
    
    $total=0;
    if($cart_empty == 0){
        echo"<h2>No product found!  <a href='index.php'> Continue Shopping</a> </h2>";
    }else{
        
        if(isset($_POST['upqty'])){
            $quantity =$_POST['qty'];
            
            foreach($quantity as $key=>$value){
                $update_qty = $conn->prepare("update cart set qty='$value' where  cart_id='$key'");
                if($update_qty->execute()){
                    echo"<scirpt>window.open('cart.php', '_self');</script>";
            }
        }
        }
        echo"
         <table>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Quantity</th>   
            <th>Price</th>
            <th>Delete</th>
            <th>Subtotal</th>
        </tr>";
    
while($row=$get_cart_items->fetch()):
    $pro_id=$row['pro_id'];
    
    $get_pro =$conn->prepare("select * from products where pro_id ='$pro_id' ");
    $get_pro->setFetchMode(PDO:: FETCH_ASSOC);
    $get_pro->execute();
    $row_pro=$get_pro->fetch();
    
    
    echo"<tr>
    <td><img src='imgs/pro_image/".$row_pro['pro_image1']."' /></td>
    <td>".$row_pro['pro_name']."</td>
    <td><input type='text' name='qty[".$row['cart_id']."]' value='".$row['qty']."' />
    <input type='submit' name='upqty' value='Update' /></td>
    
    <td>".$row_pro['pro_price']."</td>
    <td><a id='remove' href='delete.php?delete_id=".$row_pro['pro_id']."'>Delete</a></td>
    <td>";
        $qty =$row['qty'];
        $pro_price=$row_pro['pro_price'];
        $sub_total=$pro_price*$qty;
        echo $sub_total;  
    
        $total =$total + $sub_total;
       echo "</td>
    </tr>";
   
    endwhile;
echo"<tr>
 <td></td>
 <td><button id='continue'><a href='index.php'>Continue shopping</a></button></td>
 <td><button id='finish'><a href='https://www.paypal.com/signin?country.x=RS&locale.x=en_RS'>Finish shopping</button></td>
 <td></td><td><td><b> Your final bill: =$total</b></td></td>
</tr>";
    }
}


function delete_itemscart(){
    
    include('inc/db.php');

    if(isset($_GET['delete_id'])){
        
        $pro_id =$_GET['delete_id'];
        
        $delete_cart_pro = $conn->prepare("delete from cart where pro_id='$pro_id'");
        
        if($delete_cart_pro ->execute()){
            echo"<script>alert('Product deleted');</script>";
            echo"<script>window.open('cart.php', '_self');</script>";
        }
    }
}

    
    


function mixers(){
include("inc/db.php");
    
$fetchcat = $conn->prepare("select * from category where cat_id='15' LIMIT 0,2");  

$fetchcat-> setFetchMode(PDO:: FETCH_ASSOC);
    
$fetchcat->execute();

$row_cat =$fetchcat->fetch();
$cat_id = $row_cat['cat_id'];
    
echo"<h2>".$row_cat['cat_name']."</h2>";

    
$fetchpro=$conn->prepare("select * from products where cat_id='$cat_id'");
$fetchpro->setFetchMode(PDO:: FETCH_ASSOC);
$fetchpro->execute();
    
    
while($row_pro=$fetchpro->fetch()):
    echo"<li>
    <form method='post' enctype='multipart/form-data'>
    <a class='product' href='#'>
        <h4>".$row_pro['pro_name']."</h4>
        <img class='mixers' src='imgs/pro_image/".$row_pro['pro_image1']."'/>
        <center>
        <input type='hidden' value='".$row_pro['pro_id']."' name='pro_id'/>
        <button class='buy' name='cartbtn'> Add to cart</button> 
        </center>
        </a>
        </form>
        </li>";
        endwhile;
}



function headphones(){
include("inc/db.php");
    
$fetchcat = $conn->prepare("select * from category where cat_id='13'");  

$fetchcat-> setFetchMode(PDO:: FETCH_ASSOC);
    
$fetchcat->execute();

$row_cat =$fetchcat->fetch();
$cat_id = $row_cat['cat_id'];
    
echo"<h2 class='hp'>".$row_cat['cat_name']."</h2>";

    
$fetchpro=$conn->prepare("select * from products where cat_id='$cat_id'");
$fetchpro->setFetchMode(PDO:: FETCH_ASSOC);
$fetchpro->execute();
    
    
while($row_pro=$fetchpro->fetch()):
    echo"<li>
     <form method='post' enctype='multipart/form-data'>
    <a class='product' href='#'>
        <h4>".$row_pro['pro_name']."</h4>
        <img class='mixers' src='imgs/pro_image/".$row_pro['pro_image1']."'/>
        <center>
         <input type='hidden' value='".$row_pro['pro_id']."' name='pro_id'/>
        <button class='buy'> Add to cart</button> 
        </center>
        </a>
        </li>";
        endwhile;
}



function speakers(){
include("inc/db.php");
    
$fetchcat = $conn->prepare("select * from category where cat_id='17'");  

$fetchcat-> setFetchMode(PDO:: FETCH_ASSOC);
    
$fetchcat->execute();

$row_cat =$fetchcat->fetch();
$cat_id = $row_cat['cat_id'];
    
echo"<h2>".$row_cat['cat_name']."</h2>";

    
$fetchpro=$conn->prepare("select * from products where cat_id='$cat_id'");
$fetchpro->setFetchMode(PDO:: FETCH_ASSOC);
$fetchpro->execute();
    
    
while($row_pro=$fetchpro->fetch()):
    echo"<li>
     <form method='post' enctype='multipart/form-data'>
    <a class='product' href='#'>
        <h4>".$row_pro['pro_name']."</h4>
        <img class='mixers' src='imgs/pro_image/".$row_pro['pro_image1']."'/>
        <center>
         <input type='hidden' value='".$row_pro['pro_id']."' name='pro_id'/>
        <button class='buy' name='cartbtn'>Add to cart</button> 
        </center>
        </a>
       </form>
         </form>
        </li>";
        endwhile;
}


function readallcats(){
    include("inc/db.php");
    
    $allcats = $conn->prepare("select * from category");
    $allcats-> setFetchMode(PDO:: FETCH_ASSOC);
    $allcats->execute();
    
    while($row=$allcats->fetch()):
    echo"<li><a class='cats' href='categorypage.php?cat_id=".$row['cat_id']."'>".$row['cat_name']."</a></li>";
    endwhile;   
}


//zamrsena strana kategorije
function displaycatpage(){
    include('inc/db.php');
    
    if(isset($_GET['cat_id'])){
        $cat_id =$_GET['cat_id'];
        $cat_pro= $conn->prepare("select * from products where cat_id ='$cat_id'");
        $cat_pro->setFetchMode(PDO::FETCH_ASSOC);
        $cat_pro->execute();
        
        $cat_name= $conn->prepare("select * from category where cat_id ='$cat_id'");
        $cat_name->setFetchMode(PDO:: FETCH_ASSOC);
        $cat_name->execute();
        
        $row= $cat_name->fetch();
        $row_mcat=$row['cat_name'];
        echo"<h4>$row_mcat</h4>";
        
        
        
   while($row_cat=$cat_pro->fetch()):
    echo"<li>
    <a class='product' href='categorypage.php?pro_id=".$row_cat['pro_id']."'>
        <h4>".$row_cat['pro_name']."</h4>
        <img class='mixers' src='imgs/pro_image/".$row_cat['pro_image1']."'/>
        <center>
        <button class='buy'><a href='#'> Add to cart</a></button> 
         <button class='wish'><a href='#'> Wishlist</a></button> 
        </center>
        </a>
        </li>";
        endwhile;
    }
}


//fina pretraga 
function search(){
    
    include('inc/db.php');
    if(isset($_GET['search'])){
    $userq = $_GET['user_q'];
    
    $search = $conn->prepare("select * from products where pro_keyw like '%$userq%' or pro_name like '%$userq%' ");
    
    $search->setFetchMode(PDO:: FETCH_ASSOC);
    $search->execute();
    
        
    echo"<div id='bleft'><ul>";
    if($search->rowCount() ==0){
        
        echo"<h1>Product not found</1>";
    }
    else{
        
    while($row=$search->fetch()): 
     echo"<li>
        <a class='product' href='#'>
        <h4>".$row['pro_name']."</h4>
        <img class='mixers' src='imgs/pro_image/".$row['pro_image1']."'/>
        <center>
        <button class='buy'><a href='#'> Add to cart</a></button> 
        </center>
        </a>
        </li>";
    endwhile;
    echo"</ul></div>";
}
}
}   
?>