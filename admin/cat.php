<section class="mains"> 
 
  <h3>View all categories</h3> 
  
  <form method="POST" action="" class="form2" enctype="multipart/form-data">
      <table>
          
          <tr>
              <th id='rb'>Id</th>
              <th id="katname">Category Name:</th>
              <th id='editkat'>Edit</th>
              <th id="delkat">Delete</th>
          </tr>
          
          
              <?php  include_once("inc/functions.php");
                  echo viewAll_categories()?>
          
      </table>
      
  </form>
  <form method="POST" action="" class="form1">
      <table>
          <tr>
              <td>Enter category name:</td>
              <td><input type="text" name="cat_name" id=""></td>
          </tr>
      </table>
      <button name="add_cat" class="add">Add Category</button>
  </form> 
</section>


<?php

include_once("inc/functions.php");
echo add_cat();
?>