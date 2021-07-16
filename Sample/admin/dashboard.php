<?php
    session_start();
    include "../connection.php";
    //$movieID = $_GET['mid']; // Hello

    $adminID = $_SESSION['ID'];
    


    if(isset($_POST['logout-btn'])){
        session_destroy();
        session_destroy();
        header("location:../admin.php");
    }
    
    if(empty($adminID)){
        header("location:../admin.php");
    }

    // ADMIN 
    $adminQuery = mysqli_query($conn, "SELECT * FROM admin WHERE adminID = $adminID");
    $admin = mysqli_fetch_assoc($adminQuery);

    // ALL MOVIES
    $movieQuery = mysqli_query($conn, "SELECT * FROM movie");

    // ALL CUSTOMERS
    $userQuery = mysqli_query($conn, "SELECT * FROM user");

    // SUM OF TOTAL BOOKING
    $bookingQry = mysqli_query($conn, "SELECT SUM(totalPrice) AS total FROM booking_tbl");
    $bookResult = mysqli_fetch_assoc($bookingQry);

    $bookTotal = $bookResult['total'];

    
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/dashboard.css">
    <title> NXTFLIX DASHBOARD </title>
    <!-- PIE CHART -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    
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
                    <!-- <li><a class="cinema"> Cinema </a></li> -->
                 
                   
                </ul>
           </div>
           <div class="settings">
                <h3> Settings </h3>
                <ul>
                    <!--<li><a href="#"> My Account </a></li>-->
                    <form action="dashboard.php" method="POST">
                    <li><button name="logout-btn" class="logout"> Logout </button></li>
                    </form>
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
                    <p> Welcome Admin <?=$admin['fullname']?>! </p>
                    <div class="admin-profile">
                        <img src="./admin-profile/admin.png" alt="">
                    </div>
                </div>
            </div>




            <!-- FOR SUMMARY DASHBOARD -->
            <div class="admin-content">
                <h1> DASHBOARD </h1>
                <div class="content-summary">
                    <div class="summary-box booking">
                        <?php
                            $bookQuery = mysqli_query($conn, "SELECT COUNT(*) as Count FROM booking_tbl");

                            $bookCnt = mysqli_fetch_assoc($bookQuery);
                        ?>
                        <div class="count-box">
                        <h1> <?=$bookCnt['Count']?> </h1>
                        </div>
                        <div class="label">
                            <img src="../icon/booking.png">
                            <h3> Bookings </h3>
                        </div>
                    </div>
                    <div class="summary-box customer">
                        <?php
                            $customerQuery = mysqli_query($conn, "SELECT COUNT(*) as Count FROM user");

                            $customerCount = mysqli_fetch_assoc($customerQuery);
                        ?>
                        <div class="count-box">
                        <h1> <?=$customerCount['Count']?> </h1>
                        </div>
                        <div class="label">
                            <img src="../icon/customer.png">
                            <h3> Customers </h3>
                        </div>
                    </div>
                    <div class="summary-box movie">
                        <?php
                            $movieCntQuery = mysqli_query($conn, "SELECT COUNT(*) as Count FROM movie");

                            $movieCount = mysqli_fetch_assoc($movieCntQuery);
                        ?>
                        <div class="count-box">
                            <h1> <?=$movieCount['Count']?> </h1>
                        </div>
                        <div class="label">
                            <img src="../icon/video-camera.png">
                            <h3> Movies </h3>
                        </div>
                    </div>
                    <div class="summary-box total-income">
                        <div class="count-box">
                            <h1> &#8369; <?=$bookTotal?> </h1>
                        </div>
                        <div class="label">
                            <img src="../icon/coin-stack.png">
                            <h3> Total Income </h3>
                        </div>
                    </div>
                </div>
                
                
                <div class="content-sales">
                    <!-- CHARTS -->
                    <div class="sales charts">
                        <div id="piechart" style="width: 100%; height: 100%;"></div>

                    </div>


                    <div class="sales user-feedbacks">
                        <h3> New customer </h3>
                        <?php
                            $newCustomerQuery = mysqli_query($conn, "SELECT * FROM user ORDER BY userID DESC LIMIT 4"); 
                            while($newCustomer = mysqli_fetch_assoc($newCustomerQuery)) {
                        ?>
                        <div class="new-customer">
                            <div class="user-profile">
                                <img src="../user-profile/<?=$newCustomer['profile']?>" alt="">
                            </div>
                            <div class="user-name">
                                <h5> <?=$newCustomer['firstName']?> <?=$newCustomer['lastName']?> </h5>
                                <h6> <?=$newCustomer['email']?> </h6>
                            </div>
                        </div>
                        <?php } ?>
                    </div>

                </div> 

                <!--
                <div class="sales-report">
                        
                </div>-->
            </div>


            <!-- FOR MOVIE -->
            <div class="movie-container">
                
                <div class="add-movie-container">
                    <button id="add-movie-btn"> Add new movie </button>
                </div>

                <h1 class="title"> All Movies </h1>
                <table border="0">
                    <tr>
                        <th> ID </th>
                        <th> Title </th>
                        <th> Year </th>
                        <th> Duration </th>
                        <th> Director </th>
                        <th> Price </th>
                        <th> Action </td>
                    </tr>
                    <?php while($movie = mysqli_fetch_assoc($movieQuery)){?>
                        <tr>
                            <td> <?=$movie['movieID']?> </td>
                            <td> <?=$movie['Title']?>  </td>   
                            <td> <?=$movie['Year']?></td>
                            <td> <?=$movie['Duration']?></td>
                            <td> <?=$movie['Director']?></td>
                            <td> <?=$movie['Price']?>  </td>
                            
                            <td class="click edit"> <a href="./edit-movie.php?mid=<?=$movie['movieID']?>"> Edit </a> </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

            <!-- CUSTOMER -->
            <div class="customer-container">
                 <h1 class="title"> Customer </h1>
                <table border="0">
                    <tr>
                        <th> ID </th>
                        <th> Fullname </th>
                        <th> Email </th>
                        <th> Contact </th>
                        <th> Gender </th>
                        <th> Birthday </th>
                    </tr>
                    <?php while($user = mysqli_fetch_assoc($userQuery)) {?>
                        <tr>
                            <td> <?=$user['userID']?></td>
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
                        <th> Customer Name </th>
                        <th> Date of booking </th>
                        <th> Cinema No</th>
                        <th> Show </th>
                        <th> No. of seat/s </th>
                        <th> Total Price </th>
                    </tr>
                    <?php while($book = mysqli_fetch_assoc($bookQuery)) {?>
                        <tr>
                            <td> <?=$book['bookID']?> </td>
                            <td> <?=$book['Title']?> </td>
                            <td> <?=$book['firstName']?> <?=$book['lastName']?> </td>
                            <td> <?=$book['dateToday']?> </td>
                            <td> <?=$book['cinemaID']?> </td>
                            <td> <?=$book['showID']?> </td>
                            <td> <?=$book['numberOfSeats']?> </td>
                            <td> <?=$book['totalPrice']?> </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

            <!-- CINEMA -->
            <div class="cinema-container" id="cinema-container">
                 <h1 class="title"> Cinema </h1>

                 <table class="add-cinema-tbl" id="add-cinema-tbl" border="0">
                     <tr>
                         <th colspan="2"> Add Cinema </th>
                     </tr>
                    <tr>
                        <td> Cinema name </td>
                        <td> <input type="text" name="cinemaName" id="cinemaName"> </td>
                    </tr>
                    <tr>
                        <td> Capacity </td>
                        <td> <input type="text" name="capacity" id="capacity"> </td>
                    </tr>
                    <tr>
                        <td colspan="2"> <button type="button" class="add-cinema" id="add-cinema"> Add Cinema </button></td>
                    </tr>
                </table>

                <?php
                    
                    $cinemaQry = mysqli_query($conn, "SELECT * FROM cinema");                  
                ?>

                <table border="0" id="cinema-result">
                    <tr>
                        <th> ID </th>
                        <th> Cinema name </th>
                        <th> Capacity </th>
                    </tr>
                    <?php while($cinemaRslt = mysqli_fetch_assoc($cinemaQry)){?>
                        <tr>
                            <td> <?=$cinemaRslt['cinemaID']?> </td>
                            <td> <?=$cinemaRslt['cinemaName']?> </td>
                            <td> <?=$cinemaRslt['Capacity']?> </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
                    
    <!-- ADDING MOVIE CONTAINER -->
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
                    <td> <input type="text" name="title" id="title" required></td>
                    <td> Director </td>
                    <td> <input type="text" name="director" id="director" required></td>
                </tr>
                <tr>
                    <td> Year </td>
                    <td> <input type="text" name="year" id="year" required></td>
                    <td> Cast </td>
                    <td> <input type="text" name="cast" id="cast" required></td>
                </tr>
                <tr>
                    <td> Genre </td>
                    <td> <input type="text" name="genre" id="genre" required></td>
                    <td> Price </td>
                    <td> <input type="text" name="price" id="price" required></td>
                </tr>
                <tr>
                    <td> Duration </td>
                    <td> <input type="text" name="duration" id="duration" required></td>
                    <td> Trailer Link </td>
                    <td> <input type="text" name="trailer" id="trailer" required> </td>
                </tr>
                <tr>
                    <td> Rating </td>
                    <td> <input type="text" name="rating" id="rating" required></td>
                    <td> Poster </td>
                    <td> <input type="file" name="poster" id="poster" required> </td>
                </tr>
                <tr>
                    <td> Description </td>
                    <td> <textarea name="desc" class="description" maxlength="255" id="desc" required></textarea> </td>
                    <td> Banner </td>
                    <td> <input type="file" name="banner" id=""></td>
                </tr>
               
            </table>
            
            <br>
            <hr> 
            <br>
            <table border="0" class="table-date" id="table-date">
                <tr>
                    <td> Choose Date: </td>
                    <td> <input type="date" name="date" required></td>
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


<!-- SCRIPT -->
<script src="../javascript/dashboard.js"></script>


<!-- PIE CHART -->
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Transaction', 'Counts'],
          ['Movies',     <?=$movieCount['Count']?>],
          ['Bookings',    <?=$bookCnt['Count']?>],
          ['Customers',  <?=$customerCount['Count']?>],
         
        ]);

        var options = {
          title: 'OVERALL SUMMARY'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
</script>

</body>
</html>