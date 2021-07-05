<?php
    include "../connection.php";

    if(isset($_POST['suggest'])){
        $name = $_POST['suggest'];

        $searchQuery = mysqli_query($conn, "SELECT * FROM movie WHERE Title LIKE '%$name%' OR Genre LIKE '%$name%' LIMIT 5");
       

        if(!empty($name)){
            while($search = mysqli_fetch_assoc($searchQuery)){
                echo '
                <a href="./movie.php?movie='.$search['Title'].'">
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
?>