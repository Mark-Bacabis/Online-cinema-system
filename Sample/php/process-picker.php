<?php
    session_start();
    $conn = mysqli_connect('localhost','root','','online_ticket_reservation');

    if(isset($_POST['book'])){
        $movieID = $_SESSION['movieID'];
        $userID = $_SESSION['userID'];
        $seats = $_POST['seat'];
        $date = $_POST['date'];
        $cinema = $_POST['cinema'];
        $showTime = $_POST['showTime'];
        $priceTicket = $_POST['price'];
        $numberOfSeats = $_POST['nthOfSeats'];
        $seatNumbers = $_POST['seatNo'];
        $totalPrice = $_POST['totalPrice'];

        $userQuery = mysqli_query($conn, "SELECT * FROM user WHERE userID = '$userID'");
        $userResult = mysqli_fetch_assoc($userQuery);

        $query = mysqli_query($conn, "SELECT * FROM show_time WHERE showStart = (SELECT DISTINCT LEFT('$showTime', 8) FROM show_time)");
        $showResult = mysqli_fetch_assoc($query);

        $cinemaQuery = mysqli_query($conn, "SELECT * FROM cinema WHERE cinemaName = '$cinema'");
        $cinemaResult = mysqli_fetch_assoc($cinemaQuery);

        $showID = $showResult['showID'];
        $userEmail = $userResult['email'];
        $cinemaID = $cinemaResult['cinemaID'];

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
    }
?>