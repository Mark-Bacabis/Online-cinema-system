<?php
    include "../connection.php";

    $sel = mysqli_query($conn, "SELECT * FROM movie_available_date a
    JOIN movie b
    ON a.movieID = b.movieID WHERE a.movieID = 'movie-07'");

    $selAD = mysqli_query($conn, "SELECT * FROM movie_available_date WHERE movieID = 'movie-07'");

    $movie = mysqli_fetch_assoc($sel);

    $selC = mysqli_query($conn, "SELECT * FROM cinema");


    if(isset($_POST['update-btn'])){
        $cinemaID = $_POST['cinema'];
        $date = $_POST['date'];
        $price = $_POST['price'];
        echo $date."<br>";
        echo $price."<br>";

        //$upd = mysqli_query($conn, "UPDATE movie_available_date SET availableDate = '$date' WHERE movieID = 'movie-07' ");
        //$updM = mysqli_query($conn, "UPDATE movie SET Price = $price WHERE movieID = 'movie-07'");

        foreach($cinemaID as $cinemaValue){
            //$upd = mysqli_query($conn, "UPDATE movie_available_date SET cinemaID = '$cinemaValue' WHERE movieID = 'movie-07'");
            echo $cinemaValue;
        }
    }

   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Movie Edit Test </title>
</head>
<body>
    <form action="test.php" method="post">
        <table border="1">
            <tr>
                <td> Movie Title: </td>
                
                <td> <?=$movie['Title']?> </td>
            </tr>
            <tr>
                <td> Price: </td>
                <td> <input type="text" name="price" id="price" value="<?=$movie['Price']?>"> </td>
            </tr>
            <tr>
                <td> Date: </td>
                <td> <input type="date" name="date" id="date" value="<?=$movie['availableDate']?>"> </td>
            </tr>
            <tr>
                <td> Cinema </td>
                <td>
                <?php while($cinema = mysqli_fetch_assoc($selC)) {?>
                    <label for="<?=$cinema['cinemaID']?>"> <?=$cinema['cinemaID']?> 
                        <input type="checkbox" name="cinema[]" id="<?=$cinema['cinemaID']?>" value="<?=$cinema['cinemaID']?>"> 
                    </label>
                <?php } ?>
                </td>
            </tr>
            <tr>
                <td colspan="2"> <input type="submit" value="Update" name="update-btn" style="width: 100%;"> </td>
            </tr>
        </table>
    </form>    
</body>

<script>
    <?php  while($cinemaSel = mysqli_fetch_assoc($selAD)){ ?>
        document.getElementById('<?=$cinemaSel['cinemaID']?>').checked = true;
    <?php } ?>
</script>
</html>