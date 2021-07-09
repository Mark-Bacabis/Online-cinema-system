<?php
    
    include "../connection.php";
    //$movieID = $_GET['mid'];

    // ALL MOVIES
    $movieQuery = mysqli_query($conn, "SELECT * FROM movie");

    // ALL CUSTOMERS
    $userQuery = mysqli_query($conn, "SELECT * FROM user");

    
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/dashboard.css">
    <title> NXTFLIX DASHBOARD </title>

    <!-- aJax jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
</head>


<body>

    <div class="admin-container">
        <div class="admin-panel">
            <div class="admin-header">
                <h1> NXTFLIX </h1><br>
                <p> Dashboard </p>
            </div>
           <div class="admin">
                <h3> ADMIN </h3>
                <ul>
                    <li><a class="dashboard" style="color: crimson"> Dashboard </a></li>
                    <li><a class="movie"> Movies </a></li>
                    <li><a class="customer"> Customers </a></li>
                    <li><a class="booking"> Bookings </a></li>
                    <li><a class="ticket"> Tickets </a></li>
                    <li><a class="feedback"> Feedback </a></li>
                </ul>
           </div>
           <div class="settings">
                <h3> Settings </h3>
                <ul>
                    <li><a href="#"> Settings </a></li>
                    <li><a href="#"> My Account </a></li>
                </ul>
           </div>


           <div class="admin-footer">
               <p> &copysr; NXTFLIX &bullet; 2021 </p>
           </div>

        </div>


        <div class="content-container">

            <div class="admin-header">
                <div class="title">
                    <h2> DASHBOARD </h2>
                </div>

                

                <div class="admin-logo">
                    <p> Welcome Admin! </p>
                    <div class="admin-profile">
                    
                    </div>
                </div>
            </div>

            <!-- FOR SUMMARY DASHBOARD -->
            <div class="admin-content">
                <div class="content-summary">
                    <div class="summary-box">
                        <?php
                            $bookQuery = mysqli_query($conn, "SELECT COUNT(*) as Count FROM booking_tbl");

                            $bookCnt = mysqli_fetch_assoc($bookQuery);
                        ?>
                        <div class="count-box">
                        <h1> <?=$bookCnt['Count']?> </h1>
                        </div>
                        <div class="label">
                            <h3> Bookings </h3>
                        </div>
                    </div>
                    <div class="summary-box">
                        <?php
                            $customerQuery = mysqli_query($conn, "SELECT COUNT(*) as Count FROM user");

                            $customerCount = mysqli_fetch_assoc($customerQuery);
                        ?>
                        <div class="count-box">
                        <h1> <?=$customerCount['Count']?> </h1>
                        </div>
                        <div class="label">
                            <h3> Customers </h3>
                        </div>
                    </div>
                    <div class="summary-box">
                        <?php
                            $movieCntQuery = mysqli_query($conn, "SELECT COUNT(*) as Count FROM movie");

                            $movieCount = mysqli_fetch_assoc($movieCntQuery);
                        ?>
                        <div class="count-box">
                            <h1> <?=$movieCount['Count']?> </h1>
                        </div>
                        <div class="label">
                            <h3> Movies </h3>
                        </div>
                    </div>
                    <div class="summary-box">
                        <div class="count-box">
                            <h1> 7 </h1>
                        </div>
                        <div class="label">
                            <h3> Tickets </h3>
                        </div>
                    </div>
                </div>
                <!--
                <div class="content-sales">
                    <div class="sales">

                    </div>
                    <div class="sales user-feedbacks">
                        <h2> Users </h2>
                    </div>

                </div> --> 
            </div>


            <!-- FOR MOVIE -->
            <div class="movie-container">
                
                <div class="add-movie-container">
                    <button> Add new movie </button>
                </div>

                <h1 class="title"> All Movies </h1>
                <table border="0">
                    <tr>
                        <th> ID </th>
                        <th> Title </th>
                        <th> Year </th>
                        <th> Duration </th>
                        <th> Director </th>
                        <th> Cast </th>
                        <th> Price </th>
                        <th> Action </td>
                    </tr>
                    <?php while($movie = mysqli_fetch_assoc($movieQuery)){?>
                        <tr>
                            <td> <?=$movie['movieID']?> </td>
                            <td> <?=$movie['Title']?>  </td>
                            <td> <?=$movie['Year']?></td>
                            <td> <?=$movie['Duration']?>  </td>
                            <td> <?=$movie['Director']?></td>
                            <td> <?=$movie['Cast']?>  </td>
                            <td> <?=$movie['Price']?>  </td>
                            
                            <td class="click edit"> <a href="?mid=<?=$movie['movieID']?>"> Edit </a> </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

            <!-- CUSTOMER -->
            <div class="customer-container">
                 <h1 class="title"> Customer </h1>
                <table border="0">
                    <tr>
                        <th> Fullname </th>
                        <th> Email </th>
                        <th> Contact </th>
                        <th> Gender </th>
                        <th> Birthday </th>
                    </tr>
                    <?php while($user = mysqli_fetch_assoc($userQuery)) {?>
                        <tr>
                            <td> <?=$user['firstName']?> <?=$user['lastName']?> </td>
                            <td> <?=$user['email']?>  </td>
                            <td> <?=$user['contactNumber']?> </td>
                            <td> <?=$user['Gender']?>  </td>
                            <td> <?=$user['Birthday']?>  </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>


             <!-- BOOKINGS -->
             <div class="booking-container">
                 <h1 class="title"> Bookings </h1>
                <?php
                    // ALL BOOKINGS
                    $bookQuery = mysqli_query($conn, "SELECT * FROM `booking_tbl` b 
                    JOIN user u 
                    ON b.userID = u.userID
                    JOIN movie m
                    ON b.movieID = m.movieID
                    JOIN cinema c
                    ON b.cinemaID = c.cinemaID
                    JOIN show_time s
                    ON b.showID = s.showID");                  
                ?>
                <table border="0">
                    <tr>
                        <th> Transaction ID </th>
                        <th> Movie Title </th>
                        <th> Email </th>
                        <th> Date </th>
                        <th> Cinema No</th>
                        <th> Show </th>
                        <th> No. of seat/s </th>
                        <th> Total Price </th>
                    </tr>
                    <?php while($book = mysqli_fetch_assoc($bookQuery)) {?>
                        <tr>
                            <td> <?=$book['bookID']?> </td>
                            <td> <?=$book['Title']?> </td>
                            <td> <?=$book['email']?> </td>
                            <td> <?=$book['dateBooked']?> </td>
                            <td> <?=$book['cinemaID']?> </td>
                            <td> <?=$book['showID']?> </td>
                            <td> <?=$book['numberOfSeats']?> </td>
                            <td> <?=$book['totalPrice']?> </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

        </div>
    </div>

    <div class="adding-movie-container">
        <div class="movie-box">
            <div class="close">
                +
            </div>
            <h2> Add movie </h2>

            <form action="./dashboard-process.php" method="POST" enctype="multipart/form-data">
            <table border="0" class="movie-info">
                <tr>
                    <td> Movie Title </td>
                    <td> <input type="text" name="title" id="title"></td>
                    <td> Director </td>
                    <td> <input type="text" name="director" id="director"></td>
                </tr>
                <tr>
                    <td> Year </td>
                    <td> <input type="text" name="year" id="year"></td>
                    <td> Cast </td>
                    <td> <input type="text" name="cast" id="cast"></td>
                </tr>
                <tr>
                    <td> Genre </td>
                    <td> <input type="text" name="genre" id="genre"></td>
                    <td> Price </td>
                    <td> <input type="text" name="price" id="price"></td>
                </tr>
                <tr>
                    <td> Duration </td>
                    <td> <input type="text" name="duration" id="duration"></td>
                    <td> Trailer Link </td>
                    <td> <input type="text" name="trailer" id=""> </td>
                </tr>
                <tr>
                    <td> Rating </td>
                    <td> <input type="text" name="rating" id=""></td>
                    <td> Poster </td>
                    <td> <input type="file" name="poster" id=""> </td>
                </tr>
                <tr>
                    <td> Description </td>
                    <td> <input type="text" name="desc" id=""></td>
                    <td> Banner </td>
                    <td> <input type="file" name="banner" id=""></td>
                </tr>
                <!--
                <tr>
                    <td colspan="2"> <button type="submit" name="add-movie" class="add-movie"> Add movie </button></td>
                </tr>-->
            </table>
            
            <br>
            <hr> 
            <br>
            <table border="0" class="table-date" id="table-date">
                <tr>
                    <td> Choose Date: </td>
                    <td> <input type="date" name="date"></td>
                    <td> Cinema: </td>
                    <td class="cinema-holder">
                    
                    <?php
                        $cinemaQuery = mysqli_query($conn, "SELECT * FROM cinema");
                        while($cinema = mysqli_fetch_assoc($cinemaQuery)){
                    ?>
                       <div class="cinema">
                            <p> <?=$cinema["cinemaID"]?> </p>
                            <input type="checkbox" name="cinema[]" value="<?=$cinema["cinemaID"]?>">
                       </div>
                    <?php } ?>
                    </td>
                   <!-- <td> <button type="button" class="add" id="add-movie"> Add </button></td>-->
                </tr>
            </table>

            <br>
            <hr> 
            <input type="submit" name="add-movie" value="Add movie">
        </form>
         
        </div>
    </div>

<script src="../javascript/dashboard.js"></script>
<script>
     $(document).ready(function(){
        var html = '<tr><td> Choose Date: </td><td> <input type="date" name="date"></td><td> Cinema: </td><td class="cinema-holder"><?php $cinemaQuery = mysqli_query ($conn, "SELECT * FROM cinema");
                        while($cinema = mysqli_fetch_assoc($cinemaQuery)){
                    ?><div class="cinema"><p> <?=$cinema["cinemaID"]?> </p><input type="checkbox" name="cinema[]" value="<?=$cinema["cinemaID"]?>"></div> <?php } ?> </td> <td> <button type="button" class="remove" id="remove-movie"> Remove </button></td> </tr>';

        let x = 1;
        let max = 4;

        $("#add-movie").click(function(){
            if(x <= max){
                $("#table-date").append(html);
                x++;
            }
        });

        $("#table-date").on('click', '#remove-movie', function(){
            $(this).closest('tr').remove();
            x--;
        });
        
    });

</script>
</body>
</html>