<?php

    require_once 'model.php';
    require_once '../bl/business-logic-products.php';
    require_once '../bl/business-logic-category.php';
  
    class ProductModel implements IModel
    {
        private $product_id;    //auto increment
        private $product_name;
        private $product_category;
        private $product_price;
        private $product_amount;
        private $product_image;
        private $product_upload_date;
        private $categoryModel;
        
        function __construct($arr) {
            if (!empty($arr['product_id'])) {
                $this->product_id = $arr['product_id'];
            }
            $this->product_name = $arr['product_name'];
            $this->product_category = $arr['product_category'];
            $this->product_price = $arr['product_price'];
            $this->product_amount= $arr['product_amount'];
            $this->product_image = $arr['product_image'];
            $this->product_upload_date = $arr['product_upload_date'];
        }

        function getProductId() {
            return $this->product_id;
        }
       
        function getProductName() {
            return $this->product_name;
        }
        function getProductCategory() {
            return $this->product_category;
        }
        function getProductPrice() {
            return $this->product_price;
        }
        function getProductAmount() {
            return $this->product_amount;
        }
        function getProductImage() {
            return $this->product_image;
        }
        function getProductUploadTime() {
            return $this->product_upload_date;
        }

       

       
        // Lazy load
        function getCategoryModel() {
            if (empty($this->categoryModel)) {
                $cbl = new BusinessLogicCategory();
                $this->categoryModel = $cbl->getOne($this->product_category);
            }
            return $this->categoryModel;
        }
    }

?>