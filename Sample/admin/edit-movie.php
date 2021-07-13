<?php
    session_start();
    include "../connection.php";

    $movieID = $_GET['mid'];

    if(isset($_POST['update'])){
        $price = $_POST['price'];
        $query = "UPDATE `movie` SET `Price`='$price' WHERE movieID = '$movieID'";
        $updatePrice = mysqli_query($conn, $query);

        if(!$updatePrice){
            echo mysqli_error($conn);
        }
        else{
            header("location:dashboard.php?query=Update Successful");
        }
    }


    // ALL MOVIES
    $movieQuery = mysqli_query($conn, "SELECT * FROM movie WHERE movieID = '$movieID'");
    $movie = mysqli_fetch_assoc($movieQuery);

    $availableDate = mysqli_query($conn, "SELECT DISTINCT * FROM movie_available_date WHERE movieID = '$movieID'");

    $date = mysqli_fetch_assoc($availableDate);


    // CINEMA
    $cinemaQry = mysqli_query($conn, "SELECT * FROM cinema");
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/edit-movie.css">
    <title> Edit Movie </title>
    
</head>


<body>
    <div class="movie-edit-container">
        <div class="title">
            <h1> EDIT MOVIE </h1>
        </div>

        <div class="movie-container">
            <div class="poster">
                <img src="../img/<?=$movie['Poster']?>" alt="">
            </div>
            <div class="info">
                <table  class="movie-info">
                    <tr>
                        <td> Title </td>
                        <td><h2> <?=$movie['Title']?> </h2></td>
                    </tr>
                    <tr>
                        <td> Year </td>
                        <td> <?=$movie['Year']?></td>
                    </tr>
                    <tr>
                        <td> Genre </td>
                        <td> <?=$movie['Genre']?> </td>
                    </tr>
                    <tr>
                        <td> Duration </td>
                        <td> <?=$movie['Duration']?></td>
                    </tr>
                    <tr>
                        <td> Rating </td>
                        <td> <?=$movie['Rating']?> </td>
                    </tr>
                    <tr>
                        <td> Description </td>
                        <td> <?=$movie['Description']?> </td>
                    </tr>
                    
                </table>

                <table class="movie-update">
                    <form action="edit-movie.php?mid=<?=$movieID?>" method="POST">
                    <tr>
                        <td> Price </td>
                        <td> <input type="text" name="price" value="<?=$movie['Price']?>"></td>
                        <td>
                            <button type="submit" name="update"> Update Movie </button>
                        </td>
                    </tr>
                    </form>
                </table>
            </div>
        </div>
    </div>
<?php

?>
</body>
</html>