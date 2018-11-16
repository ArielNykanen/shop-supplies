<?php

require_once '../bl/business-logic-products.php';
require_once '../bl/business-logic-category.php';

$bl = new BusinessLogicProducts;
$blc = new BusinessLogicCategory;

?>
 
<?php
    $title = 'Add Products';
    require_once '../html-templates/head.php';
    require_once '../model/product-model.php';
?>
<body>
<?php
    require_once 'main-navbar-view.php';

    if (isset($_POST['addCategory']) && !empty($_POST['newCategory'])) {
        $category = new ProductCategory([
            'category_name' => $_POST['newCategory'],
        ]);
     
        $blc->set($category);
    } else if (!empty($_POST['delete'])) {
        $blc->delete($_POST['deleteid']);
    }

    if (isset($_POST['addProduct']) &&
     !empty($_POST['productName']) &&
     !empty($_POST['productAmount']) &&
     !empty($_POST['categorySelect']) &&
     !empty($_POST['productPrice']) &&
     !empty($_POST['productImage'])
     ) {
        $date = date('c');
        $product = new ProductModel([
            'product_name' => $_POST['productName'],
            'product_category' => $_POST['categorySelect'],
            'product_price' => $_POST['productPrice'],
            'product_amount' => $_POST['productAmount'],
            'product_image' => $_POST['productImage'],
            'product_upload_date' => $date
        ]);
         
        $bl->set($product);
    } else if (!empty($_POST['delete'])) {
        $bl->delete($_POST['deleteid']);
    }
    
    
    
    
    
    
?>
<main class="container-fluid mt-4"> 
    <h2 class="mb-4 text-center">Add Product</h2>
    <section class="container px-5">
        <form class="mx-auto w-50 border border-secondary rounded" action='<?php echo basename($_SERVER['PHP_SELF']); ?>' method='POST'>
            <div class="row justify-content-center my-4">
                <div class="col-md-10 input-group">
                    <label class="pt-2 mr-4" for="flightFrom">Product Name</label>
                    <input name='productName' class="form-control" id="productName" placeholder="product name">
                </div>
            </div>
            <div class="row justify-content-center my-4">
                <div class="col-md-10 input-group">
                    <label class="pt-2 mr-4" for="flightTo">Product Category</label>
                    <select name='categorySelect' class="form-control" id="flightTo">
                    <?php
                    $allCategories = $blc->get();
                    foreach ($allCategories as $category) {
                        echo "<option value=' " . $category->getCategoryId() . " '>" .  $category->getCategoryName() . "</option>";
                    }
                    ?>
                    </select>
                </div>
                <div class="col-md-10 input-group">
                    <label class="pt-2 mr-4" for="newCategory">Add New Category</label>
                    <input name='newCategory' type='text' class="form-control" id="newCategory">
                    <button name='addCategory' class='btn btn-success mx-1'>+</button>
                </div>
               
                <div class="col-md-10 input-group">
                    <label class="pt-2 mr-4" for="productAmount">Amount</label>
                    <input name='productAmount' type='number' class="form-control" id="productAmount">
                </div>
                <div class="col-md-10 input-group">
                    <label class="pt-2 mr-4" for="productPrice">Price</label>
                    <input name='productPrice' type='number' class="form-control" id="productPrice">
                </div>
                <div class="col-md-10 input-group">
                    <label class="pt-2 mr-4" for="productImage">Image Url</label>
                    <input name='productImage' type='number' class="form-control" id="productImage">
                </div>
            </div>
          
            <div class="row justify-content-center my-3">
                <button name='addProduct' type="submit" class="btn btn-primary">Add Product</button>
            </div>
        </form>
    </section>
    <hr>

</main>
<?php
    require_once '../html-templates/footer.php';
?> 