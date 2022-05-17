<?php
   session_start();
   include "../connection.php";
   $userID = $_SESSION['userID'];
 

   if(isset($_POST['btnSubmit'])){
      $feedback = $_POST['feedback'];
      $ins = 'INSERT INTO `user_feedbacks` (`userID`, `feedback`) VALUES ("'.$userID.'", "'.$feedback.'")';

      $insDone = mysqli_query($conn, $ins);
      
      if($insDone){
         header("location: ../php/feedbacks.php");
      }
   }
  

 
?>