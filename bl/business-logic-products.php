<?php
    require_once 'bl.php';
    require_once '../model/product-model.php';

    class BusinessLogicProducts extends BusinessLogic
    {
        public function get()
        {
            $query = 'SELECT * FROM `products`';
            
            $result = $this->dal->select($query);
            $resultsArray = [];
            
            while ($row = $result->fetch()) {
                array_push($resultsArray, new ProductModel($row));
            }
            
            return $resultsArray;
        }
        public function delete($id) {
     
        }
    
        function deleteProduct($id) {
            $query = "DELETE FROM `products` WHERE product_id=:pid";
            $params = array(
                "pid" => $id
            );
            $this->dal->delete($query, $params);
        }




        public function getByCountry($cid)
        {
            $q = 'SELECT * FROM `airport` WHERE country_id=?';
            
            $params = array(
                $cid
            );

            $results = $this->dal->select($q, $params);
            $resultsArray = [];
    
            while ($row = $results->fetch()) {
                array_push($resultsArray, new AirportModel($row));
            }
    
            return $resultsArray;
        }

        public function getOne($id)
        {
            $q = "SELECT * FROM `products` WHERE product_id= :pid";

            $results = $this->dal->select($q, [
                'pid' => $id
            ]);
            $row = $results->fetch();
            return new ProductModel($row);
        }

        public function set($a)
        {   
            $query = "INSERT INTO `products`(`product_name`, `product_category`, `product_price`, `product_amount`, `product_image`, `product_upload_date`) VALUES  (:pname, :pcategory,:pprice, :pamount, :pimage, :pdate)";

            $params = array(
                'pname' => $a->getProductName(),
                'pcategory' => $a->getProductCategory(),
                'pprice' => $a->getProductPrice(),
                'pamount' => $a->getProductAmount(),
                'pimage' => $a->getProductImage(),
                'pdate' => $a->getProductUploadTime()
            );
            $this->dal->insert($query, $params);
        }

        public function update($newProduct, $id)
        {
            $query = "UPDATE `products` SET `product_name`= :pname,`product_category`= :pcategory,`product_price`= :pprice,
            `product_amount`= :pamount,`product_image`= :pimage,`product_upload_date`= :pdate WHERE `product_id` = $id";
            
            $params = array(
               'pname' => $newProduct->getProductName(),
                'pcategory' => $newProduct->getProductCategory(),
                'pprice' => $newProduct->getProductPrice(),
                'pamount' => $newProduct->getProductAmount(),
                'pimage' => $newProduct->getProductImage(),
                'pdate' => $newProduct->getProductUploadTime() 
            );

            $this->dal->update($query, $params);
        }

   
    }
    
?>