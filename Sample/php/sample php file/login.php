<?php
    include 'dbc.php';

    

    if(isset($_POST['pID'])){
        $productID = $_POST['pID'];

        $select = "SELECT * FROM product a 
        JOIN product_size b
        ON a.productID = b.productID
        JOIN product_sizes c 
        ON b.sizeID = c.sizeID
        WHERE a.productID = '$productID'";

        $query = mysqli_query($conn, $select);
           

        if(mysqli_num_rows($query) > 0 ){
            echo '<option value=""> -- Choose size -- </option>';
            while($sizeRow = mysqli_fetch_assoc($query)){
                echo '<option value="'.$sizeRow['productName'].'">'. $sizeRow['sizeName'] .'</option>';
            }
        }
        else{
            echo '<option value=""> -- Choose size -- </option>';
        }
        
    } 

    if(isset($_POST['sID'])){
        $sizeID = $_POST['sID'];
        
        if(empty($sizeID)){
            echo "";
        }
        else{
            echo $sizeID;
        }

    } 
?>