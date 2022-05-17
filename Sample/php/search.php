<?php
    include "../connection.php";

   
    if(isset($_POST['suggest'])){
        $dateToday = DATE('Y-m-d');

        $name = $_POST['suggest'];

        $searchQuery = mysqli_query($conn, "SELECT DISTINCT a.movieID, a.Title, a.Year, a.Poster, a.Genre, a.Rating, b.availableDate FROM movie a
        JOIN movie_available_date b
        ON a.movieID = b.movieID 
        WHERE Title LIKE '%$name%' AND b.availableDate >= '$dateToday' AND a.isAvailable = 1 LIMIT 5;");
       

        if(!empty($name)){
            while($search = mysqli_fetch_assoc($searchQuery)){
                echo '
                <a href="../php/movie.php?movie='.$search['Title'].'">
                    <div class="img-poster">
                        <img src="../img/'.$search['Poster'].'" class="poster">
                    </div>
                    <div class="title">
                        <h3>'.$search['Title'].' ('.$search['Year'].')</h3>
                        <p>'.$search['Genre'].'</p>
                        <p>'.$search['Rating'].'</p>
                    </div>
                </a>';
            }
        }
    }

    
    if(isset($_POST['rPassword'])){
        $rePass = $_POST['rPassword'];
        $newPass = $_POST['nPassword'];

       
        
        if($rePass === $newPass && strlen($rePass) >= 4){
            echo "<p style='color: green; font-size: 14px'> *Password match </p>";

        }else{
            echo "<p style='color: red; font-size: 14px'> Password not match </p>";
            
        }
        
    }

    if(isset($_POST['newPassword'])){
        session_start();
        $userID = $_SESSION['userID'];
        
        $sel = mysqli_query($conn, "SELECT password FROM user WHERE userID = '$userID' ");

        $pass = mysqli_fetch_assoc($sel);
        $newPass = $_POST['newPassword'];

        if($newPass === $pass['password']){
            echo "<p style='color: red; font-size: 10px'> Your new password must not be <br> same to your old password. </p>";
        }
        else{
            echo "";
        }
    }

    if(isset($_POST['pressEm'])){
        $email = $_POST['pressEm'];

        $sel = mysqli_query($conn, "SELECT email FROM user");

        while($user = mysqli_fetch_assoc($sel)){
            if($email == $user['email']){
                echo "<p class='message'> * This email is already taken </p>";
            }
        }
    } 
?>