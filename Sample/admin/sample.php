<?php
        include "../connection.php";


     $countQuery = mysqli_query($conn, "SELECT COUNT(*) AS Count FROM movie");
     $CountResult = mysqli_fetch_assoc($countQuery);
     $movieID = 'movie-0'.($CountResult['Count'] + 1);
     
     echo $movieID;
     
?>