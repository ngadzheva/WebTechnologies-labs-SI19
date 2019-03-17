<?php
    require 'user.php';

    // Start session
    session_start();

    $hash = password_hash('10xFor@llTheFi$h', PASSWORD_DEFAULT);
    $user = new User('ivgerves', $hash);

    $errors = [];

    if($_POST) {
        // Get the data of the post request
        $userName = $_POST['userName'];
        $password = $_POST['password'];

        print_r($_POST);
        echo "<br/>";

        // Verify the data
        if(!$userName) {
            $errors[] = 'User name is required!';
        } 
        if(!$password) {
            $errors[] = 'Password is required!';
        } else {
            if($userName !== $user->getUserName()) {
                $errors[] = 'Wrong user name!';
            } 
            if(!password_verify($password, $user->getPassword())) {
                $errors[] = 'Wrong password!';
            } else {
                // Store the data to the session
                $_SESSION['userName'] = $userName;
                $_SESSION['password'] = $password;
            }
        }      
    }

    foreach($errors as $value) {
        echo $value . '<br/>';
    }

    if($_SESSION) {
        echo "Logged in <br/> User name: " . $_SESSION['userName'] . "<br/> Password: " . $_SESSION['password']; 
    }

    // Destroy the session
    session_unset();
    session_destroy();
?>