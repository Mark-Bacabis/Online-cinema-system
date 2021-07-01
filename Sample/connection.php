<?php
    $conn = mysqli_connect('localhost','root','','online_ticket_reservation');

    if(!$conn){ 
        echo error_log($conn);
    }