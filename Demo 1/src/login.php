<?php
    session_start();

    header('Content-type: application/json');

    $errors = [];

    if($_POST) {
        $data = json_decode($_POST['data'], true);

        if(!$data['userName']) {
            $errors[] = 'User name is required!';
        }

        if(!$data['password']) {
            $errors[] = 'Password is required!';
        }

        if($data['userName'] && $data['password']) {
            $_SESSION['userName'] = $data['userName'];
            $_SESSION['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
    } else {
        echo 'Error';
    }

    $response;

    if($errors) {
        $response = ["success" => false, "data" => $errors];
    } else {
        $response = ["success" => true];
    }

    echo json_encode($response);
?>