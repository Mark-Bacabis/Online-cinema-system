<?php
    session_start();
    include "../connection.php";

    $movieID = $_GET['mid'];

    if(isset($_POST['update'])){
        $price = $_POST['price'];
        $isAvailable = $_POST['isAvailable'];
        $query = "UPDATE `movie` SET `Price`='$price', isAvailable = '$isAvailable' WHERE movieID = '$movieID'";
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
        <div class="background-movie">
            <div class="bg-overlay">

            </div>
        </div>
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
                            <label for="isAvailable"> Available: </label>
                            <select name="isAvailable" id="isAvailable">
                                <option value="1"> Yes </option>
                                <option value="0"> No </option>
                            </select>    
                        </td>
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
<style>
    .background-movie{
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: white;
        z-index: -1;
        background-image: url('../img/<?=$movie['Banner']?>');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        filter: blur(5px);
    }

    .background-movie .bg-overlay{
        position: absolute;
        background-color: black;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        opacity: .5;
    }

    .movie-edit-container{
        position: relative;
    }
</style>
</html>