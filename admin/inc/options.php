<aside class="aleft">
    <h2>Content Management </h2>
    <ul class="func">
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php?insert_cat">Insert Categories</a></li>
        <li><a href="index.php?insert_products">Insert Products</a></li>
        <li><a href="index.php?viewall_products">View all products</a></li>
        <li><a href="index.php?view_all_orders">View all orders</a></li>
    </ul>
</aside>

<?php
if(isset($_GET['insert_cat'])){
    include("cat.php");
}

if(isset($_GET['insert_products'])){
    include("products.php");
}

if(isset($_GET['viewall_products'])){
    include("viewall_products.php");
}
?>