<?php
    session_start();
    include "../connection.php";
    include "./method/function.php";
    //SESSION
    $transactID = $_SESSION['transactID'];

    sendEmail($transactID);

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

   
    //FOR TRANSACTION 
    $bookQuery = mysqli_query($conn, "SELECT * FROM `booking_tbl` b
    JOIN movie m
    ON b.movieID = m.movieID
    JOIN cinema c
    ON b.cinemaID = c.cinemaID
    JOIN show_time s
    ON b.showID = s.showID
    JOIN user u
    ON b.userID = u.userID
    WHERE b.transactionID = '$transactID'");
    $bookResult = mysqli_fetch_assoc($bookQuery);

    $dateBooked = $bookResult['dateBooked'];

    $cinemaID = $bookResult['cinemaID'];
    $showID =  $bookResult['showID'];

    // GET DATE NAME
    $dateQuery = mysqli_query($conn, "SELECT DAYNAME('$dateBooked') AS Result");
    $dateName = mysqli_fetch_assoc($dateQuery);
    // FOR SEATS 
    $seatQuery = mysqli_query($conn, "SELECT * FROM `seat_tbl` WHERE userID = '$userID' AND movieID = '$movieID' AND date = '$date' AND cinemaID = '$cinemaID' AND showID = '$showID'");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php if(empty($transactID) && empty($movieID) && empty($userID)){
        header("Location:../index.php");
    } else { ?>
    <meta http-equiv="refresh" content="5; url=http://localhost/online-cinema-system/sample/php/booking-history.php">
    <?php } ?>

    <link rel="stylesheet" href="../styles/thankyou.css">
    <title>Document</title>
</head>
<style>
    .message{
        position: absolute;
        bottom: 1%;
        left: 1%;
    }
</style>
<body>
    <div class="container">
        <p class="message"> This page will be redirected in 5secs... </p>
        <div class="thankyou-box">
            <img src="../icon/checked-crimson.png" alt="">
            <h1> THANK YOU!! </h1>
            <p> For choosing <span> NXTFLIX </span></p>
            <hr>
            <p> Your booking for </p>
            <h2>  <?=$bookResult['Title']?> (<?=$bookResult['Year']?>) </h2>
            <p> on </p>
            <h3> <?=$date?> (<?=$showTime?>)</h3>
            <p> at </p>
            <h3> Fairview Terraces, <?=$cinema?></h3>
            <p> are confirm! </p>
            <p> Your transaction ID is <font color="crimson"><b> <?=$transactID?> </font> </b></p>
            <p>  We also send your transaction details to this email <font color="crimson"> <?=$bookResult['email']?> </font></p>
        </div>

        <div class="back-to-home">
            <a href="../index.php"> BACK TO HOME </a>
        </div>
    </div>

    <footer>
        <div class="copyright">
            &copy; NxtGen &bullet; 2021  &bullet; &copy;
        </div>

        <div class="nav-links">
            <ul>
                <li> <a href="#"> Home </a> </li>
                <li> <a href="#"> Terms and agreements </a> </li>
                <li> <a href="#"> Services </a> </li>
                <li> <a href="#"> Privacy policy</a> </li>
            </ul>
        </div>
    </footer>
   
    
</body>
</html>