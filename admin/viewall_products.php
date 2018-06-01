<section class="mains">
    <form method="POST" action="" class="form3" enctype="multipart/form-data">
        <table class="viewall">
            <tr class="viewallp">
                <th>ID</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Product image</th>
                <th>Pro price</th>
                <th>Product warranty</th>
                <th>Pro keywords</th>
                <th>Product Number</th>
                <th>Date added</th>

            </tr>
            <?php
include('inc/functions.php'); 
echo viewall_products();
?>
            
        </table>

</section>

