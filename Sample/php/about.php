<?php
   error_reporting(0);
   session_start();
   include "../connection.php";
   include "../process/url.php";
   
   //$movieTitle = $_GET['movie'];  
   $userID = $_SESSION['userID'];

   $_SESSION['url'] = $url;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/mode.css">
    <!-- <link rel="stylesheet" href="../styles/privacy.css"> -->
    <link rel="stylesheet" href="../styles/about.css">
    <title> About Us | FILMIFY Online Ticket Reservation </title>
    
</head>

<!-- IF USER LOGGED IN OR NOT -->
    <?php
        if(!empty($userID)){?>
            <style>
                .login{
                    display: none;
                }
                .isLogin{
                    display: flex;
                }
            </style>
        <?php } elseif(empty($userID)) { ?>
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

    <!-- AJAX FOR SEARCH -->
<script>
   $(document).ready(function(){
        $("#search").keyup(function(){
            var search = $("#search").val();
            $.post("./search.php",{
                suggest: search

            }, function(data, status){
                $("#search-box").html(data);
            });
        });
    });
</script>
<body>


<header>
    <div class="nav-search-area">
        <div class="logo">
            <a href="../index.php"> FILMIFY <br>
                <span class="subtitle">
                    Online Ticket Reservation
                </span>
            </a>   
        </div>

         <!-- SEARCH BAR -->
            <div class="search">
                <input type="search" id="search" placeholder="Search movie">
                <img src="../icon/search.png" class="search-icon">
                
                <div class="search-suggestion" id="search-box">

                </div>
            </div>
        <!-- SEARCH BAR -->
        

        <div class="nav-bar-container">

        <!-- IF USER DIDN'T LOGIN -->  
            <div class="login" id="login">
                <a href="../php/sign-up.php?next=<?=$url?>"> Register </a> 
                <p> | </p> 
                <a href="../php/login.php?next=<?=$url?>"> Login </a>
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
            </div>
        <!-- IF USER IS LOGIN -->
        </div>

            <!-- DARK/LIGHT MODE -->
        <div class="light-mode">
            <input type="checkbox" name="mode" id="mode">
            <label for="mode" class="mode">
                <div class="light">
                    <img src="../icon/brightness.png" alt="">
                </div>
               <div class="night">
                    <img src="../icon/night-mode.png" alt="">
               </div>
                <div class="ball"></div>
            </label>
        </div>

    </div>
    <!-- NAVIGATION LINK -->
    <div class="nav-bar">
        <ul>
            <li><a href="../index.php"> Home </a></li>
            <li><a href="./allMovies.php?query=Allmovies"> Movies </a></li>
            <li class="selected"><a href="./about.php"> About </a></li>
        </ul>
    </div>
    
        <!-- USER MODAL -->
            <div class="user-login-container">
                <ul>
                    <form action="../process/account-process.php?next=<?=$url?>" method="post">
                    <li> <button class="chngePW" name="my-account"> My Account </button> </li>
                    <li> <button class="bkHistory" name="booking-history"> Booking history </button> </li>
                    <li> <button class="fdBack" name="feedbacks"> Feedback </button> </li>
                    <li> <button class="logout" type="submit" name="logout"> Logout  </button> </li>
                    </form>
                </ul>
            </div>
        <!-- USER MODAL -->
</header>

<div class="about-container">
    <div class="faqs-container">
        <h1> FAQs </h1>
        <ul>
            <li> <h3> Do you offer contactless payment and pre-ordering? </h3> 
                <p> Answer: <i> FILMIFY accepts a variety of contactless payment methods including credit cards and Paypal. You may also order tickets and concessions in advance via our website. </i></p>
            </li>
            <li> <h3> How do I cancel an order or request a refund? </h3> 
                <p> Answer: <i>To reserve your seats in advance please visit our website www.filmify.com.ph for your local cinema and select your preferred movie, showtimez date/time and your desire seats. Don't forget - You can only book your tickets If you login your account. If you don't have account, you can sign up at www.register.filmify.com. </i></p>
            </li>
            <li> <h3> How do I pre-order my movie tickets? </h3> 
                <p> Answer: <i> Ticket prices may not vary by location because we are only focusses at Fairview Terraces and may not be change based on time of day as well as available services and options. You will be able to view the total cost of your tickets before completing your purchase online.
 </i></p>
            </li>
            <li> <h3> How much do movie tickets cost at my FILMIFY location? </h3> 
                <p> Answer: <i> When you purchase your tickets online, you will often be presented with the option to choose which seats you'd like to reserve. This eliminates the need to wait in line for popular movies and allows you enough time before the movie to eat or purchase concessions. In addition, knowing exactly where you're sitting eliminates the need to search for the best available seats when entering the theater.
 </i></p>
            </li>
            <li> <h3>How do i get my ticket that i purchased online? </h3> 
                <p> Answer: <i> You will receive an email confirmation upon successful purchase </i></p>
            </li>
          
        </ul>
    </div>

    <div class="team-container">
        <h1> Team </h1>

        <div class="members">
            <div class="member">
                <div class="member-pic">
                    <img src="../img/team/275541108_945117779700859_5660406515882660493_n.png" alt="">
                </div>
                <div class="member-info">
                    <div class="name">
                        <h3> Alliah Sandra Lisbo </h3>
                    </div>
                    <div class="position">
                        <p> UI/UX Designer </p>
                    </div>
                </div>
            </div>

            <div class="member">
                <div class="member-pic">
                    <img src="../img/team/id2x2627da1c26eea90.35706319.jpg" alt="">
                </div>
                <div class="member-info">
                    <div class="name">
                        <h3> Mark Melvin E. Bacabis </h3>
                    </div>
                    <div class="position">
                        <p> Programmer </p>
                    </div>
                </div>
            </div>

            <div class="member">
                <div class="member-pic">
                    <img src="../img/team/EBALLES_MARLON_2 BY 2 ID PICTURE.png" alt="">
                </div>
                <div class="member-info">
                    <div class="name">
                        <h3> Marlon Eballes </h3>
                    </div>
                    <div class="position">
                        <p> Project Manager </p>
                    </div>
                </div>
            </div>

            <div class="member">
                <div class="member-pic">
                    <img src="../img/team/279336967_296251196043953_751724793257930377_n.png" alt="">
                </div>
                <div class="member-info">
                    <div class="name">
                        <h3> Jovilyn Camaya </h3>
                    </div>
                    <div class="position">
                        <p> Database Administrator </p>
                    </div>
                </div>
            </div>

            <div class="member">
                <div class="member-pic">
                    <img src="../img/team/275301289_2123889614428195_7266795276322162415_n.png" alt="">
                </div>
                <div class="member-info">
                    <div class="name">
                        <h3> Rica Mae Galupo </h3>
                    </div>
                    <div class="position">
                        <p> System Analyst </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-container">
        <h1> Contact Us </h1>
        <form action="#">
            <div class="contact-input">
                <label for="email"> Email </label>
                <input type="email" name="email" id="email">
            </div>

            <div class="contact-input">
                <label for="sub"> Subject </label>
                <input type="text" name="sub" id="sub">
            </div>

            <div class="contact-input">
                <label for="mess"> Message </label>
                <textarea name="mess" id="mess"></textarea>
            </div>
            
            <div class="contact-input">
                <input type="submit" name="btnSubmit" value="Send">
            </div>
        </form>
    </div>
</div>


<!-- FOOTER -->
    <footer class="footer-container">
        <div class="About">
            <h3> About </h3>
            <ul>
                <li><a href="./about.php"> About </a></li>
                <li><a href="./terms-and-condition.php"> Terms and agreement </a></li>
                <li><a href="./privacy.php"> Privacy Policy </a></li>
            </ul>
        </div>
        <div class="movies">
                <h3> Movies </h3>
            <ul>
                <li><a href="#slider-container"> All movies </a></li>
                <li><a href="#movie-this-week"> Showing this week </a></li>
                <li><a href="#"> Premiere </a></li>
                <li><a href="#"> Upcoming movie </a></li>
            </ul>
        </div>
        <div class="links">
                 <h3> Links </h3>
            <ul>
                <li><a href="./index.php"> Home </a></li>
                <li><a href="./php/allMovies.php"> Movies</a></li>
                <li><a href="./php/about.php"> About us</a></li>
                <li><a href="./php/contact.php"> Contact Us </a></li>
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
<script src="../javascript/mode.js"></script>
</body>
</html>