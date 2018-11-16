<?php 
    require_once '../bl/bl.php';
    require_once '../bl/business-logic-products.php';
    $products = new BusinessLogicProducts();
    if (isset($_POST["delete"]))
              $products->deleteProduct($_POST["delete"]);
              
    if (isset($_POST["save"])) {
          $date = date('c');
          $chosenProduct = $_POST["pid"];
        $updatedProduct = new ProductModel([
            'product_name' => $_POST['productName'],
            'product_category' => $_POST['categorySelect'],
            'product_price' => $_POST['productPrice'],
            'product_amount' => $_POST['productAmount'],
            'product_image' => $_POST['productImage'],
            'product_upload_date' => $date
            ]);
            
            $products->update($updatedProduct, $chosenProduct);
}
?>
    
<?php  
    $title = "All Products";
    require_once '../html-templates/head.php';
?>
<body>
<?php
    require_once 'main-navbar-view.php';
?>
    <main class="container-fluid my-4">
        <h1 class="mb-5 text-center"><u>All Products</u></h1>
   
    <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Category</th>
      <th scope="col">Price</th>
      <th scope="col">Amount</th>
      <th scope="col">Image</th>
      <th scope="col">Upload Time</th>
    </tr>
  </thead>
  <tbody>
  <?php 
 
$allProducts = $products->get();
foreach ($allProducts as $key => $product ) {
  
    if (isset($_POST["update"])) {
        ?>
         <form method="POST">
        <tr>
        <th scope="row" >Product ID <input type="hidden" name='pid' value='<?php echo $product->getProductId(); ?>'></th> 
        <td><input name='productName' type="text" value='<?php  echo $product->getProductName(); ?>'></td>
        <td><input name='categorySelect' type="hidden" value='<?php  echo $product->getCategoryModel()->getCategoryId(); ?>'><?php  echo $product->getCategoryModel()->getCategoryName(); ?></td>
        <td><input name='productPrice' type="text" value='<?php  echo $product->getProductPrice(); ?>'></td>
        <td><input name='productAmount' type="text" value='<?php  echo $product->getProductAmount(); ?>'></td>
        <td><input name='productImage' type="text" value='<?php  echo $product->getProductImage(); ?>'></td>
        <td><?php  echo $product->getProductUploadTime(); ?></td>
       
            <td><button class='btn btn-success' type='submit' name="save" value='<?php echo $product->getProductId(); ?>'>Save</button></td>
            <td><button class='btn btn-danger' type='submit' name="cancel" value='<?php echo $product->getProductId(); ?>'>Cancel</button></td>   
      </form>
      </tr>

    <?php } else { ?>
    <tr>
      <th scope="row">1</th>
      <td><?php  echo $product->getProductName(); ?></td>
      <td><?php  echo $product->getCategoryModel()->getCategoryName(); ?></td>
      <td><?php  echo $product->getProductPrice(); ?></td>
      <td><?php  echo $product->getProductAmount(); ?></td>
      <td><?php  echo $product->getProductImage(); ?></td>
      <td><?php  echo $product->getProductUploadTime(); ?></td> 
      <form method="POST">
          <td><button class='btn btn-danger' type='submit' name="delete" value='<?php echo $product->getProductId(); ?>'>Delete</button></td>
          <td><button class='btn btn-warning' type='submit' name="update" value='<?php echo $product->getProductId(); ?>'>Update</button></td>
         
    </form>
    </tr>
    <?php 
    }
}?>
  </tbody>
</table>

   

    </main>

<?PHP //Close tag for <body> inside the footer template
    require_once '../html-templates/footer.php';
?>
 
