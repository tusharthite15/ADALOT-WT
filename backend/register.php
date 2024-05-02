<?php
require ('./config.php');

if (isset($_POST['save'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $c_pass = $_POST['cpass'];


    // email already existing checking



    if ($pass == $c_pass) {
        $query = "SELECT * from `accounts` where email = '$email'";
        $result = mysqli_query($conn,$query);
        if (mysqli_num_rows($result) > 0) {

            echo "Email found";
            
        } else {
            $insert_data = "INSERT INTO `accounts`(`username`, `email`, `password`) VALUES ('$username','$email','$pass')";
            $result1 = mysqli_query($conn, $insert_data);
            if ($result1) {
                echo "<script>alert('data insered successfully')</script>";
                header("Location: ../login.html");

            }

            
        }
    } else {
        echo "Password Doesn't Match..";
    }


}

?>