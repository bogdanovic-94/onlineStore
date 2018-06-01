<section class="mains">
    <form method="POST" action="" class="form1" enctype="multipart/form-data">
        <table id='prods'>
           <td>Select a product category:</td>
            <td>
             <select>
               <?php include("inc/functions.php"); echo viewall_cat();?>
             </select>
             </td>
                       
            <tr>
                <td>Enter a product name:</td>
                <td><input type="text" name="pro_name" id=""></td>
			</tr>

                <tr>
                    <td>Enter a product price:</td>
                    <td><input type="text" name="pro_price" id=""></td>
                </tr>

                <tr>
                    <td>Upload a product image:</td>
                    <td><input type="file" name="pro_image1" id=""></td>
                </tr>

                <tr>
                    <td>Upload a product image:</td>
                    <td><input type="file" name="pro_image2" id=""></td>
                </tr>


                <tr>
                    <td>Upload a product image:</td>
                    <td><input type="file" name="pro_image3" id=""></td>
                </tr>

                <tr>
                    <td>Enter a product waranty:</td>
                    <td><input type="text" name="pro_war" id=""></td>
                </tr>

                <tr>
                    <td>Enter a product keyword:</td>
                    <td><input type="text" name="pro_keyw" id=""></td>
                </tr>

                <tr>
                    <td>Enter a product number:</td>
                    <td><input type="text" name="pro_number" id=""></td>
                </tr>

        </table>
        <button name="add_product" class="add">Add Product</button>
    </form>
</section>

<?php
include_once('inc/functions.php'); 
echo add_pro();
?>