<?php
//custom error handeling
set_error_handler(function ($severity, $message, $file, $line) {
    throw new ErrorException($message, $severity, $severity, $file, $line);
});

//XSS prevention
function escape($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

try {

    // CREATE DATABASE CONNECTION
    $db = mysqli_connect('localhost', 'root', '', 'reservation') or die("connection failed" . mysqli_error());


    // SELECT FORM FIELD DATA
    if(isset($_POST['submit_appointment'])){
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $phone = mysqli_real_escape_string($db, $_POST['phone']);
        $location = mysqli_real_escape_string($db, $_POST['location']);
        $date = mysqli_real_escape_string($db, $_POST['date']);
        $time = mysqli_real_escape_string($db, $_POST['time']);

// QUERY
        $query = mysqli_query($db, "INSERT INTO appointments(username,email,phone,location,date,time) VALUES('$username','$email','$phone','$location','$date','$time') ");
        if ($query) {
            $_SESSION['success'] = "Your Reservation has been Submitted";
            $_SESSION['id'] = $db->inser_id;
            header('location: signup.php');
            exit();
        } else {
            echo "niet gelukt";
            $_SESSION['error'] = "Sorry, check your inputs for errors";
        }
    }



//Login logica
    if(isset($_POST['submit_login'])) {
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = mysqli_real_escape_string($db, $_POST['password']);


        $loginQuery = mysqli_query($db, "SELECT * FROM users WHERE email='$email'");
        print_r($loginQuery );
        if ($query) {
            $_SESSION['success'] = "You've logged in succesfull";
            $_SESSION['id'] = $db->inser_id;
            header('location: afspraak-maken/index.php');
            exit();
        } else {
            echo "niet gelukt";
            $_SESSION['error'] = "Sorry, check your inputs for errors";
        }
    }
//registreren
    if(isset($_POST['submit_registration'])) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $confirmPass = mysqli_real_escape_string($db, $_POST['confirmpass']);

        $loginQuery = mysqli_query($db, "SELECT * FROM  users WHERE 1 = $username");
        print_r($loginQuery );
        if ($query) {
            $_SESSION['success'] = "You've logged in succesfull";
            $_SESSION['id'] = $db->inser_id;
            header('location: afspraak-maken/index.php');
            exit();
        } else {
            echo "niet gelukt";
            $_SESSION['error'] = "Sorry, check your inputs for errors";
        }
    }




} catch (Exception $e) {
    //Set error
    //$errors[] = "Oops, try to fix your error please: " . $e->getMessage() . " on line " . $e->getLine() . " of " . $e->getFile();
}

//Login logica
if(isset($_POST['submit_login'])) {

    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password1']);
    $confirmPass = mysqli_real_escape_string($db, $_POST['password2']);


//QUERY
$query = mysqli_query($db, "INSERT INTO users(user,email,pass) VALUES('$username','$email','$password') ");
if ($query) {
    $_SESSION['success'] = "Your Reservation has been Submitted";
//    $_SESSION['id'] = $db->inser_id;
    header('location: signup.php');
    exit();
} else {
    $_SESSION['error'] = "Sorry, check your inputs for errors";
}
}

