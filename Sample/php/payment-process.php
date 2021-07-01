<?php
        session_start();
        include "../connection.php";

            //SESSION
        $movieID = $_SESSION['movieID'];
        $userID = $_SESSION['userID'];
        $seats = $_SESSION['seats'];
        $date = $_SESSION['date'];
        $cinema = $_SESSION['cinema'];
        $showTime = $_SESSION['showTime'];
        $priceTicket = $_SESSION['priceTicket'];
        $numberOfSeats = $_SESSION['numberOfseats'];
        $seatNumbers = $_SESSION['seatNumbers'];
        $totalPrice = $_SESSION['totalPrice'];

        $userQuery = mysqli_query($conn, "SELECT * FROM user WHERE userID = '$userID'");
        $userResult = mysqli_fetch_assoc($userQuery);

        $query = mysqli_query($conn, "SELECT * FROM show_time WHERE showStart = (SELECT DISTINCT LEFT('$showTime', 8) FROM show_time)");
        $showResult = mysqli_fetch_assoc($query);

        $cinemaQuery = mysqli_query($conn, "SELECT * FROM cinema WHERE cinemaName = '$cinema'");
        $cinemaResult = mysqli_fetch_assoc($cinemaQuery);

        $showID = $showResult['showID'];
        $userEmail = $userResult['email'];
        $cinemaID = $cinemaResult['cinemaID'];

        echo $cinema;

        
        foreach($seats as $seatSelected){
            $insertIntoSeats = "INSERT INTO `seat_tbl`
            (`userID`, `movieID`, `date`, `cinemaID`, `showID`, `seatNumber`) 
            VALUES 
            ('$userID','$movieID', '$date','$cinemaID','$showID','$seatSelected')";
            
            $seatQuery = mysqli_query($conn, $insertIntoSeats);
        }

        

        $insertIntoBook = "INSERT INTO `booking_tbl`
        (`dateBooked`, `userID`, `userEmail`, `movieID`, `dateToday`, `cinemaID`, `showID`, `ticketPrice`, `numberOfSeats`, `seatNumber`, `totalPrice`) 
        VALUES 
        ('$date','$userID','$userEmail','$movieID',CURRENT_DATE(),'$cinemaID','$showID', $priceTicket,$numberOfSeats,'$seatNumbers', $totalPrice)";

        $bookQuery = mysqli_query($conn, $insertIntoBook);

        if(!$bookQuery){
            echo error_log($bookQuery);
        }
        else{
            header("location:../process/thankyou.php");
        }
?>