<?php
    include "../connection.php";
   

    if(isset($_POST['date'])){
        $date = $_POST['date'];
        $movieID = $_POST['movieIdentifier'];

        $select = "SELECT c.Title, a.availableDate, b.cinemaName 
        FROM movie_available_date a 
        JOIN cinema b 
        ON a.cinemaID = b.cinemaID
        JOIN movie c
        ON c.movieID = a.movieID
        WHERE a.availableDate = '$date' AND c.movieID = '$movieID'";

        $query = mysqli_query($conn, $select);
        

        if(mysqli_num_rows($query) > 0 ){
            echo '<option value=""> Select Available Cinema </option>';
            while($sizeRow = mysqli_fetch_assoc($query)){
                echo '<option value="'.$sizeRow['cinemaName'].'">'.  $sizeRow['cinemaName'] .'</option>';
            }
        }
        else{
            echo '<option value=""> Select Available Cinema </option>';
        }
        
        
    } 

    if(isset($_POST['cinemaID'])){
        $cinemaID = $_POST['cinemaID'];
        $select = "SELECT * FROM show_time";
        $query = mysqli_query($conn, $select);
        echo '<option value=""> Select Available Show </option>';

        while($row = mysqli_fetch_assoc($query)){
            if(empty($cinemaID)){
               
            }
            else{
                echo ' <option value="'.$row['showID'].'">'. $row['showName'].' '.$row['showStart'].' - '.$row['showEnd'] .'</option>';
            }
           
        }
    }


    if(isset($_POST['showID'])){
        $showID = $_POST['showID'];
        $movieID = $_POST['movieIdentifier'];

        $selectPrice = "SELECT price FROM movie WHERE movieID = '$movieID'";
        $getPrice = mysqli_query($conn, $selectPrice);
        $price = mysqli_fetch_assoc($getPrice);

        $selectShowPrice = "SELECT showPrice FROM show_time WHERE showID = '$showID'";
        $getShowPrice = mysqli_query($conn, $selectShowPrice);
        $showPrice = mysqli_fetch_assoc($getShowPrice);

        if(empty($showID)){
            echo '<input type="text" name="price" value="0.00">';
        }
        else{
            $price = $price['price'] + $showPrice['showPrice'];
            echo '<input type="text" name="price" value="'.$price.'.00">';
        }

      
    }


    if(isset($_POST['submit'])){
        $date = $_POST['availableDate'];
        $cinema = $_POST['availableCinema'];
        $showTime = $_POST['showTime'];
        $price = $_POST['price'];

        if(empty($date) || empty($cinema) || empty($showTime) || $price == '0.00'){
            
        }
        else{
            echo $date.' '.$cinema.' '.$showTime.' '.$price;
        }
    }

    if(isset($_POST['confirm'])){

        $seat = $_POST['seatNum'];
        echo "<p>". $seat ."</p>";
    }


?>