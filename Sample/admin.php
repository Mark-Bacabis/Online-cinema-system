<?php
    session_start();
    include "./connection.php";

    if(isset($_POST['login'])){
        $username = $_POST['uname'];
        $password = $_POST['pword'];

        if(empty($username) || empty($password)){
            echo "Please type your username/password";
        }
        else{
            $select = mysqli_query($conn, "SELECT * FROM admin");

            while($admin = mysqli_fetch_assoc($select)){
                if($admin['username'] == $username && $admin['password'] == $password){
                    header("Location:./admin/dashboard.php");
                    $_SESSION['ID'] = $admin['adminID'];
                }
                else{
                    header("Location:admin.php?query=failed");
                }
            }
        }

        


    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/admin-login.css">
    <title> ADMIN | FILMIFY </title>
</head>
<body>
    <header>
        <div class="logo">
            <h1> FILMIFY <br>
                <span class="subtitle">
                    Online Dashboard
                </span>
            </h1>   
        </div>
    </header>
    <div class="login-container">
      
        <form action="admin.php" method="POST">
            <img src="./icon/admin.png" alt="" class="logo">
            <label for="uname"> Username </label> <br>
            <input type="text" name="uname" id="uname"> <br>

            <label for="pword"> Password </label> <br>
            <input type="password" name="pword" id="pword"> <br>
            <input type="submit" name="login" value="Login">
        </form>
        <div class="copyright">
            <h3> FILMIFY </h3>
        </div>
    </div>
</body>
</html>