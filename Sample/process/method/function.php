<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

   
function sendEmail($transactID) {
   $conn = mysqli_connect('localhost','root','','online_ticket_reservation');

   include "../include/PHPMailer.php";
   include "../include/SMTP.php";
   include "../include/Exception.php";


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

   $email = $bookResult['userEmail'];
   $dateBooked = $bookResult['dateBooked'];
   $cinemaID = $bookResult['cinemaID'];
   $showID =  $bookResult['showID'];
   $movieID = $_SESSION['movieID'];
   $userID = $_SESSION['userID'];
   $date = $_SESSION['date'];
   


   // GET DATE NAME
   $dateQuery = mysqli_query($conn, "SELECT DAYNAME('$dateBooked') AS Result");
   $dateName = mysqli_fetch_assoc($dateQuery);
   // FOR SEATS 
   $seatQuery = mysqli_query($conn, "SELECT * FROM `seat_tbl` WHERE userID = '$userID' AND movieID = '$movieID' AND date = '$date' AND cinemaID = '$cinemaID' AND showID = '$showID'");

 
   //echo $bookResult['transactionID'];

  // FUNCTION FOR SENDING A MESSAGE TO STUDENT'S EMAIL   
   // SERVER 
   $mail = new PHPMailer();
   $mail -> isSMTP();
   $mail ->isHTML(true);
   $mail -> Host = 'smtp.gmail.com';
   $mail -> SMTPAuth = 'true';
   $mail ->Username = 'nxtflix.online.system.demo@gmail.com';
   $mail ->Password = '123456789Abc!';
   $mail -> SMTPSecure = 'tls';
   $mail -> Port = 587;

   
   // RECEPIENTS
   $mail ->Subject = 'NXTFLIX';
   $mail ->setFrom("nxtflix.online.system.demo@gmail.com", "NXTFLIX");
   $mail ->addAddress($email);
   $mail ->addReplyTo("nxtflix.online.system.demo@gmail.com", "Tickets");
   $mail ->Body = "<h2 style='color: black;'>Hello! ".$bookResult['firstName']." ".$bookResult['lastName'].", the image attached below is/are your ticket for movie reservation </h2>";
   $mail ->Body .= '<html> <body style="display: block;">';
   while ($selSeats = mysqli_fetch_assoc($seatQuery)) {
      $mail ->Body .= '  <div class="tickets" style="margin: 5px 0;">
      <div class="ticket-container" style="
          font-family: poppins;
          width: 600px;
          height: 200px;
          background: rgb(37, 37, 37);
          display: flex;
          overflow: hidden;
          margin: 0;">

          <div class="info" style=" background: whitesmoke;
          margin: 0;
          padding: 2% 5%;
          width: 80%;
          color: black;
          line-height: 30px;">
              <p style="margin:0; padding: 0;"> Transaction ID: '.$transactID.'</p>
              <h1 style="margin: 0; color: black;">'.$bookResult['Title'].' ('.$bookResult['Year'].')</h1>
              <h2 style="margin: 0; color: black;">'.$bookResult['dateBooked'].', '.$dateName['Result'].'</h2>
              <h4 style="margin: 0; color: black;"> Fairview Terraces, '.$bookResult['cinemaName'].'</h4>
              <h4 style="margin: 0; color: black;">'.$bookResult['showName'].','.$bookResult['showStart'].' - '.$bookResult['showEnd'].' </h4>
              
              <p style="font-size: 14px; margin: 0; padding: 0;"> 2021-07-12, 5:05PM </p>
          </div>
          <div class="seat-number" style="
              position: relative; 
              width: 10%;
              padding: 4% 9%;">
              
              <h1 style="font-size: 60px; 
              color: white;"> 
              '.$selSeats['seatNumber'].'
              </h1>

          </div>
      </div>
         </div>';
   }
   $mail ->Body .= '</body> </html>';



   $mail ->Send();

   if($mail){
     
   }
   else{
      echo "Error!";
   }

   $mail ->smtpClose();
}




function send($email, $subject, $message) {
    session_start();
    include "../include/PHPMailer.php";
    include "../include/SMTP.php";
    include "../include/Exception.php";
 
    // FUNCTION FOR SENDING A MESSAGE TO USER'S EMAIL   
    // SERVER 
    $mail = new PHPMailer();
    $mail -> isSMTP();
    $mail ->isHTML(true);
    $mail -> Host = 'smtp.gmail.com';
    $mail -> SMTPAuth = 'true';
    $mail ->Username = "nxtflix.online.system.demo@gmail.com";
    $mail ->Password = '123456789Abc!';
    $mail -> SMTPSecure = 'tls';
    $mail -> Port = 587;
 
    
    // RECEPIENTS
    $mail ->Subject = ("$email ($subject)");
    $mail ->setFrom($email);
    $mail ->addAddress("nxtflix.online.system.demo@gmail.com");
    $mail ->addReplyTo($email);
    $mail ->Body = "$message";
 
 
 
    $mail ->Send();
 
    if($mail){
        $_SESSION['status'] = "Send";
    }
    else{
        $_SESSION['status'] = "Error";
    }
 
    $mail ->smtpClose();
 }
?>