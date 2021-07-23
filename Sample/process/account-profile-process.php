<?php
    session_start();
    include "../connection.php";

    $userID = $_SESSION['userID'];



    // UPDATE USER INFO
    if(isset($_POST['update'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $cnum = $_POST['cnum'];

        

        echo $userID;

        $updateQuery = "UPDATE `user`
        SET 
        `firstName` = '$fname',
        `lastName` = '$lname',
        `contactNumber` = '$cnum' WHERE userID = '$userID' ";

        $update = mysqli_query($conn, $updateQuery);

        if(!$update){
            echo mysqli_error($conn);
        }
        else{
            header("location:../php/my-account.php?$userID");
        }
    }





    // UPDATE PROFILE PIC
    if(isset($_POST['profile-btn']) && isset($_FILES['image'])) {
        $files = $_FILES['image'];
        print_r($files);

        
        $profile_name = $_FILES['image']['name'];
        $profile_size = $_FILES['image']['size'];
        $profile_tmpName = $_FILES['image']['tmp_name'];
        $profile_error = $_FILES['image']['error'];

        if($profile_error === 0){
            $profile_ext = pathinfo($profile_name, PATHINFO_EXTENSION);
            $profile_ext_lc = strtolower($profile_ext);

            $allowed_ext = array("jpg","jpeg", "png");

            if(in_array($profile_ext_lc, $allowed_ext)){
                $new_profile_name = uniqid("profile -").'.'.$profile_ext_lc;
                $img_profile_path = "../user-profile/".$new_profile_name;

                move_uploaded_file($profile_tmpName, $img_profile_path);

                // UPDATE PROFILE
                $profileUpdateQuery = "UPDATE `user` SET `profile` = '$new_profile_name' WHERE userID = '$userID' ";

                $profileUpdate = mysqli_query($conn, $profileUpdateQuery);

                if(!$profileUpdate){
                    echo mysqli_error($conn);
                }
                else{
                    header("location:../php/my-account.php?Update Profile");
                }
                
            }
        }
        else{
            header("location:../php/my-account.php?");
        }
    }
    else{
        header("location:../php/my-account.php?");
    }


  
?>