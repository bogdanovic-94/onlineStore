<?php


function add_cat(){
    include("inc/db.php");
    if(isset($_POST['add_cat'])){
    $cat_name=$_POST['cat_name'];
    $add_cat=$conn->prepare("insert into category (cat_name) values('$cat_name')");
    if($add_cat->execute()){
        echo"<script>alert('Category added')</script>";
    }
        else{
         echo"<script>alert('Category not added')</script>";
        }
    }
}



function viewall_cat(){
    include("inc/db.php");
    $fetch_cat = $conn->prepare("select * from category ORDER BY cat_name");
    $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
    $fetch_cat->execute();
    
    while($row=$fetch_cat->fetch()):
        echo"<option value= '".$row['cat_id']."'>".$row['cat_name']."</option>";
     endwhile;
}



function viewAll_categories(){
    include('inc/db.php');
    $fetch_cat = $conn->prepare("select * from category");
    $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
    $fetch_cat->execute();
    $i = 1;

    
    while($row=$fetch_cat->fetch()):
    
    echo"
    <tr>
            <td>".$i++."</td>
            <td>".$row['cat_name']."</td>
            <td><a href='index.php?edit_kat=".$row['cat_id']."'>Edit</a></td>
            <td><a href='delete_cat.php?delete_cat=".$row['cat_id']."'>Delete</a></td>
     </tr>";
            
    endwhile;
    
}


function viewall_products(){
    include("inc/db.php");
    $fetch_products = $conn->prepare("select * from products");
    $fetch_products -> setFetchMode(PDO::FETCH_ASSOC);
    $fetch_products->execute();
    $i = 1;
    
    while($row=$fetch_products->fetch()):
        echo"<tr>
                <td>".$i++."</td>
                <td><a href='index.php?edit_pro=".$row['pro_id']."'>Edit</td>
                 <td><a href='delete_cat.php?delete_pro=".$row['pro_id']."'>Delete</td>
                <td style='min-width:20px;>".$row['pro_name']."</td>
                <td style='min-width:200px;>
                    <img src='../imgs/pro_image/".$row['pro_image1']."'/>
                    <img src='../imgs/pro_image/".$row['pro_image2']."'/>
                  
                </td>
                <td>".$row['pro_price']."</td>
                <td>".$row['pro_war']."</td>
                <td>".$row['pro_keyw']."</td>
                <td>".$row['pro_number']."</td>
			    <td>".$row['date']."</td>

        </tr>";
    endwhile;
}



function edit_cat(){
    
    include("inc/db.php");
    if(isset($_GET['edit_kat'])){
        $cat_id =$_GET['edit_kat'];
        
        $fetch_cat_name= $conn->prepare("select * from category where cat_id= '$cat_id'");
        $fetch_cat_name->setFetchMode(PDO::FETCH_ASSOC);
        $fetch_cat_name->execute();
        $row = $fetch_cat_name->fetch();
        
        echo"<form method='POST' action='' class='edkat'>
      <table>
          <tr>
              <td>Update category name:</td>
              <td><input type='text' name='upcat_name'  value='".$row['cat_name']."'></td>
          </tr>
      </table>
      <button name='update_cat' class='add'>Update Category</button>
  </form> ";
        
        if(isset($_POST['update_cat'])){
            $upcat_name =$POST['upcat_name'];
            
            $updateq = $conn->prepar("update category set cat_name='$upcat_name' where cat_id ='$cat_id'");
            
            if($updateq->execute()){
                echo"<script>alert('Category Updated')";
            }
        }
    }
}




function add_pro(){
    include("inc/db.php");
    if(isset($_POST["add_product"])){
        $pro_name =$_POST['pro_name'];
        $pro_price =$_POST['pro_price'];
        $pro_war = $_POST['pro_war'];
        $pro_keyw = $_POST['pro_keyw'];
        $pro_number = $_POST['pro_number'];
        
         
        $pro_image1 = $_FILES['pro_image1']['name'];
        $pro_image1_tmp = $_FILES['pro_image1'] ['tmp_name'];
        
        $pro_image2 = $_FILES['pro_image2'] ['name'];
        $pro_image2_tmp = $_FILES['pro_image2'] ['tmp_name'];
        
        $pro_image3 = $_FILES['pro_image3']['name'];
        $pro_image3_tmp = $_FILES['pro_image3'] ['tmp_name'];
        
        move_uploaded_file($pro_image1_tmp, "../imgs/pro_image/$pro_image1");
        move_uploaded_file($pro_image2_tmp, "../imgs/pro_image/$pro_image2");
        move_uploaded_file($pro_image3_tmp, "../imgs/pro_image/$pro_image3");
        
        $add_pro=$conn->prepare("insert into products(pro_name, pro_price, pro_war,  pro_keyw, pro_number, pro_image1, pro_image2, pro_image3, date) values('$pro_name', '$pro_price', '$pro_war', '$pro_keyw', '$pro_number', ' $pro_image1', '$pro_image2', '$pro_image3', NOW())");
        
          
        if($add_pro->execute()){
            echo"<script>alert('Product added successfuly')</script>";
            
        }
        else{
             echo"<script>alert('Product added successfuly)</script>";
        }

    }
}


function edit_pro(){
    
    include("inc/db.php");
    if(isset($_GET['edit_pro'])){
        $pro_id=$_GET['edit_pro'];
        
        $fetch_pro = $conn->prepare("select * from products where pro_id='$pro_id'");
        $fetch_pro = setFetchMode(PDO::FETCH_ASSOC);
        $fetch_pro->execute();
        $row=$fetch_pro->fetch();
        
        echo"<form method='POST' action='' class='form1' enctype='multipart/form-data'>
        <table>
            <tr>
                <td>Update a product name:</td>
                <td><input type='text' name='pro_name''></td>
            </tr>
            <tr>
                <td>Update a product category:</td>
                <td>
             <select>;
              ";echo viewall_cat();echo"
             </select>
                </td>


                <tr>
                    <td>Update a product price:</td>
                    <td><input type='text' name='pro_price'></td>
                </tr>

                <tr>
                    <td>Update a product image:</td>
                    <td><input type='file' name='pro_image1'></td>
                </tr>

                <tr>
                    <td>Update a product image:</td>
                    <td><input type='file' name='pro_image2'></td>
                </tr>

                <tr>
                    <td>Update a product image:</td>
                    <td><input type='file' name='pro_image3'></td>
                </tr>

                <tr>
                    <td>Update a product waranty:</td>
                    <td><input type='text' name='pro_war'></td>
                </tr>

                <tr>
                    <td>Updtae a product keyword:</td>
                    <td><input type='text' name='pro_keyw'></td>
                </tr>

                <tr>
                    <td>Update a product number:</td>
                    <td><input type='text' name='pro_number'></td>
                </tr>

        </table>
        <button name='add_product' class='add'>Update Product</button>
    </form>;
    }
}";
    }
}
   

function delete_cat(){
        include("inc/db.php");
        
        $delete_cat_id = $_GET['delete_cat'];
        $delete_cat = $conn->prepare("delete FROM category WHERE cat_id='$delete_cat_id'");
        
	if($delete_cat->execute()){
            echo"<script>alert('Category deleted')</script>";
            echo"<script>window.open('index.php?viewall_cat', '_self')</script>";
        }
        
    }
    


function delete_pro(){
    
    include("inc/db.php");
    $delete_product_id = $_GET['delete_pro'];
    
    $delete_pro =$conn->prepare("delete from products where pro_id ='$delete_product_id'");
    
    if($delete_pro->execute()){
            echo"<script>alert('Product deleted')</script>";
            echo"<script>window.open('index.php?viewall_cat' '_self')</script>";

        }
        
}
?>