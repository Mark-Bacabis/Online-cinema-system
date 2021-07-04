<?php
   
    session_start();
    include "../connection.php";

    $movieID = $_SESSION['movieID'];
    $userID = $_SESSION['userID'];

    $movieSelected = mysqli_query($conn, "SELECT * FROM `movie` WHERE movieID = '$movieID'");

    $result = mysqli_fetch_assoc($movieSelected);


    if(isset($_POST['submit'])){
        $movieUrl = $_SESSION['url'];

        if(!empty($userID)){
            $date = $_POST['availableDate'];
            $cinema = $_POST['availableCinema'];
            $show = $_POST['showTime'];
            $price = $_POST['price'];

            $cinemaQuery = mysqli_query($conn, "SELECT cinemaID FROM cinema WHERE cinemaName = '$cinema'");
            $cinemaResult = mysqli_fetch_assoc($cinemaQuery);

            $cinemaID = $cinemaResult['cinemaID'];
        }
        elseif(empty($userID)){
            header("location:login.php?next=".$movieUrl);
        }
    }



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/seat-picker.css">
    <link rel="stylesheet" href="../styles/style.css">
    <title> Pick your seat(s) | <?=$result['Title']?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<!--HEADER-->
<!-- IF USER LOG IN OR NOT -->
    <?php
        if($userID != null){?>
            <style>
                .login{
                    display: none;
                }
                .isLogin{
                    display: flex;
                }
            </style>
        <?php } elseif($userID == null) { ?>
            <style>
                .login{
                    display: flex;
                }
                .isLogin{
                    display: none;
                }
            </style>

    <?php } ?>
<!-- IF USER LOG IN OR NOT -->


<!-- AJAX CODES -->
<script>
     $(document).ready(function(){
        
        $('.seat').click(function(){
            var price = $('#ticketPrice').val();
            var text = "";
            $('.seat:checked').each(function(){
                text += $(this).val() + ',';
            });
            text = text.substring(0, text.length - 1);
            $("#selectedSeats").val(text);
           
            var count = $('.seat:checked').length;

            $("#seatCount").val(count);

            $("#totalPriceOfseats").val((count * price) + '.00');
        });
    });

</script>

<body>

<header>
    <div class="nav-search-area">
        <div class="logo">
            <a href="../index.php"> NXTFLIX <br>
                <span class="subtitle">
                    Online Ticket Reservation
                </span>
            </a>   
        </div>

        <div class="search">
            <input type="search" placeholder="Search movie">
            <img src="../icon/search.png" clas="search-icon">
        </div>
        

        <div class="nav-bar-container">

        <!-- IF USER DIDN'T LOGIN -->  
            <div class="login" id="login">
                <a href="#"> Register </a> 
                <p> | </p> 
                <a href="#"> Login </a>
            </div>
        <!-- IF USER DIDN'T LOGIN -->          
        
        <!-- IF USER IS LOGIN -->        
            <div class="isLogin">
                <?php
                    $userQry = mysqli_query($conn, "SELECT * FROM user WHERE userID = '$userID'");

                    $user = $userQry->fetch_assoc();
                ?>
             

                <div class="profile"  id="isLogin">
                    <p> <?=$user['firstName']?> <?=$user['lastName']?></p>
                    <img src="../user-profile/<?=$user['profile']?>" alt="">

                    <img src="../icon/down-filled-triangular-arrow.png" alt="" class="drop-down-icon">
                </div>
                
                   
                <div class="wishlist">
                    <img src="../icon/playlist.png" alt="">
                </div>
            </div>
        <!-- IF USER IS LOGIN -->
        </div>

        <!-- 
        <div class="light-and-dark" id="light-dark">
            <div class="light-mode">
                <p> Light </p>
                <img src="./icon/light-icon.png" alt="" id="icon">
            </div>
        </div>
        -->

    </div>

    <!-- NAVIGATION LINK -->
    <div class="nav-bar">
        <ul>
            <li><a href="../index.php"> Home </a></li>
            <li><a href="../php/allMovies.php?query=Allmovies"> Movies </a></li>
            <li><a href="../php/contact.php"> Contact us</a></li>
            <li><a href="../php/service.php"> Services </a></li>
        </ul>
    </div>

    <!-- LOGIN MODAL -->
        <div class="login-container">
            <form action="../process/login.php" method="POST">
                <table border="0">
                    <th> Login </th>
                    <tr>
                        <td> <input type="email" name="email" placeholder="Email"></td>
                    </tr>
                    <tr>
                        <td> <input type="password" name="password" placeholder="Password"></td>
                    </tr>
                    <tr>
                        <td> <input type="submit" name="login-btn" placeholder="Password" value="Sign in"></td>
                    </tr>

                    <tr>
                        <td> <a href="#"> Forgot password? </a></td>
                    </tr>
                </table>
            </form>

            <div class="other-account">
                <p> or </p>
                <button> <img src="../icon/google.png" alt=""> </button>
                <button> <img src="../icon/facebook.png" alt=""> </button>
            </div>
            <div class="reg"> 
                <p> Don't have an account? </p> 
                <a href="#"> Register now </a>
            </div>
        </div>
    <!--   LOGIN MODAL 
    --> 

    
    <!-- USER MODAL -->
        <div class="user-login-container">
            <ul>
                <li> <button class="chngePW"> My Account </button> </li>
                <li> <button class="chngePW"> Change password </button> </li>
                <li> <button class="bkHistory"> Booking history </button> </li>
                <form action="./process/login.php" method="post">
                    <li> <button class="logout" type="submit" name="logout"> Logout  </button> </li>
                </form>
            </ul>
        </div>
    <!-- USER MODAL -->
</header>


<!-- SEAT PICKER -->
    <div class="picker-container">
        <div class="container movie-details">  
            <div class="poster-movie">
                <img src="../img/<?=$result['Poster']?>" alt="<?=$result['Title']?>">
                <h3> <?=$result['Title']?> (<?=$result['Year']?>) </h3>
            </div>
        </div>

        <div class="container seat-picker-container">
    <form action="../payment-page.php" method="post">
            <div class="legend-container">
                <div class="seat-legend">
                    <p> N/A </p>
                    <div class="vacant">

                    </div>
                </div>
                <div class="seat-legend">
                    <p> Selected </p>
                    <div class="selected">

                    </div>
                </div>
                <div class="seat-legend">
                <p> Occupied </p>
                    <div class="occupied">

                    </div>
                </div>
            </div>

            <div class="seat-picker">
                <table class="picker-1">
                    <tr class="head">
                        <td></td>
                        <th> 1 </th>
                        <th> 2 </th>
                        <th> 3 </th>
                        <th> 4 </th>
                        <th> 5 </th>
                        <th> 6 </th>
                        <th> 7 </th>
                        <th> 8 </th>
                    </tr>
                    
                    <tr>
                        <th> A </th>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="A1" value="A1"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="A2" value="A2"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="A3" value="A3"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="A4" value="A4"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="A5" value="A5"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="A6" value="A6"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="A7" value="A7"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="A8" value="A8"></td>

                    </tr>
                    <tr>
                        <th> B </th>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="B1" value="B1"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="B2" value="B2"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="B3" value="B3"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="B4" value="B4"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="B5" value="B5"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="B6" value="B6"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="B7" value="B7"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="B8" value="B8"></td>
                    </tr>
                    <tr>
                        <th> C </th>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="C1" value="C1"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="C2" value="C2"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="C3" value="C3"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="C4" value="C4"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="C5" value="C5"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="C6" value="C6"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="C7" value="C7"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="C8" value="C8"></td>
                    </tr>
                    <tr>
                        <th> D </th>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="D1" value="D1"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="D2" value="D2"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="D3" value="D3"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="D4" value="D4"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="D5" value="D5"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="D6" value="D6"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="D7" value="D7"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="D8" value="D8"></td>
                    </tr>
                    <tr>
                        <th> E </th>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="E1" value="E1"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="E2" value="E2"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="E3" value="E3"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="E4" value="E4"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="E5" value="E5"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="E6" value="E6"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="E7" value="E7"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="E8" value="E8"></td>
                    </tr>
                    <tr>
                        <th> F </th>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="F1" value="F1"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="F2" value="F2"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="F3" value="F3"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="F4" value="F4"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="F5" value="F5"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="F6" value="F6"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="F7" value="F7"></td>
                        <td> <input class="seat" type="checkbox" name="seat[]" id="F8" value="F8"></td>
                    </tr>
                </table> 
            </div>
        </div>

        
        <div class="container output-container"> 
                <table border="0">
                    <tr>
                        <td> Date </td>
                        <td> <input type="text" name="date" value="<?=$date?>"></td>
                    </tr>
                    <tr>
                        <td> Cinema </td>
                        <td> <input type="text" name="cinema" value="<?=$cinema?>"></td>
                    </tr>
                    <tr>
                        <?php
                            $qry = "SELECT * FROM show_time WHERE showID = '$show'";
                            $res = mysqli_query($conn, $qry);
                            $result = mysqli_fetch_assoc($res);
                        ?>
                        <td> Show time </td>
                        <td> <input type="text" name="showTime" value="<?=$result['showStart']?> - <?=$result['showEnd']?>"></td>
                    </tr>
                    <tr>
                        <td> Ticket price </td>
                        <td> <input type="text" name="price" id="ticketPrice" value="<?=$price?>"></td>
                    </tr>
                    <tr>
                        <td> Number of seat/s </td>
                        <td> <input type="text" name="nthOfSeats" id="seatCount"></td>
                    </tr>
                    <tr>
                        <td> Seat number </td>
                        <td> <input type="text" name="seatNo" id="selectedSeats"></td>
                    </tr>
                    <tr>
                        <td> Total Price </td>
                        <td> <input type="text" name="totalPrice" id="totalPriceOfseats"></td>
                    </tr>
                </table>
                <div class="overlay">

                </div>
                <div class="buttons">
                    <button type="submit" name="cancel" class="cancel"> Cancel </button>
                    <button type="submit" name="book" class="book"> Book </button>
                </div>
    </form>
        </div>
    </div>
<!-- SEAT PICKER -->




<!-- FOOTER -->
    <footer class="footer-container">
        <div class="About">
            <h3> About </h3>
            <ul>
                <li><a href="#"> About us</a></li>
                <li><a href="#"> Terms and agreement </a></li>
                <li><a href="#"> Privacy Policy </a></li>
                <li><a href="#"> Services </a></li>
            </ul>
        </div>
        <div class="movies">
                <h3> Movies </h3>
            <ul>
                <li><a href="#"> Now showing </a></li>
                <li><a href="#"> New release </a></li>
                <li><a href="#"> Premiere </a></li>
                <li><a href="#"> Upcoming movie </a></li>
            </ul>
        </div>
        <div class="links">
                 <h3> Links </h3>
            <ul>
                <li><a href="#"> Home </a></li>
                <li><a href="#"> Movies</a></li>
                <li><a href="#"> Contact Us </a></li>
                <li><a href="#"> Services </a></li>
            </ul>
        </div>
        <div class="contactUs">
                <h3> Contact us </h3>
                <input type="text" placeholder="juandelacruz@email.com">
                <textarea name="message" id="" cols="0" rows="4" placeholder="Message us..." resize="none"></textarea>
                <button> Submit </button>
        </div>
        <div class="followUs">
            <h3> Follow us </h3>
            <ul>
                <li><a href="#"><img src="../icon/facebook.png" alt=""></a></li>
                <li><a href="#"><img src="../icon/twitter.png" alt=""></a></li>
                <li><a href="#"><img src="../icon/instagram.png" alt=""></a></li>
            </ul>
        </div>
        <div class="copyright">
            <p> &copy; NXTGen 2021 </p>
        </div>
    </footer>
<!-- FOOTER -->



<!-- CUSTOM JS -->
    <script src="./scripts/main.js"> </script>
</body>

<?php
    
    $selectSeatsQuery = mysqli_query($conn, "SELECT seatNumber FROM seat_tbl 
    WHERE movieID = '$movieID' AND date = '$date' AND cinemaID = '$cinemaID' AND showID = '$show'");

    while($seatRows = $selectSeatsQuery->fetch_assoc()){
        $seatNumber = $seatRows['seatNumber'];

        echo "   
        <script>
            document.getElementById('$seatNumber').style.background = '#bcbfd3';
            document.getElementById('$seatNumber').disabled = 'True';
            document.getElementById('$seatNumber').style.cursor = 'Default';
        </script>
        ";
        

    }

?>

</html>