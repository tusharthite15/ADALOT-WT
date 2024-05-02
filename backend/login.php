<?php
require ('./config.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Check email exists in the database
    $query = "SELECT * FROM `accounts` WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);
        $stored_pass = $row['password'];

        if ($stored_pass ==  $pass) {
            
            // storing the login param in the session 
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            echo "<script>alert('Login successful');</script>";
            // Redirecting to dashboard page
            header("Location: ../dashboard.php");
            exit();
        } else {
            echo "<script>alert('Incorrect password');</script>";
        }
    } else {
        echo "<script>alert('Email not found');</script>";
    }
}
?>
