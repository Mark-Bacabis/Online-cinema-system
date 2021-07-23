<?php
    include "../connection.php";
    

    if(isset($_POST['suggest'])){
        $dateToday = DATE('Y-m-d');

        $name = $_POST['suggest'];

        $searchQuery = mysqli_query($conn, "SELECT DISTINCT a.movieID, a.Title, a.Year, a.Poster, a.Genre, a.Rating, b.availableDate FROM movie a
        JOIN movie_available_date b
        ON a.movieID = b.movieID 
        WHERE Title LIKE '%$name%' AND b.availableDate >= '$dateToday' LIMIT 5");
       

        if(!empty($name)){
            while($search = mysqli_fetch_assoc($searchQuery)){
                echo '
                <a href="./php/movie.php?movie='.$search['Title'].'">
                    <div class="img-poster">
                        <img src="./img/'.$search['Poster'].'" class="poster">
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