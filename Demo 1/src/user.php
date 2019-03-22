<?php
    session_start();

    if($_SESSION) {
        if($_SESSION['userName']) {
            $response = ["success" => true, "data" => $_SESSION['userName']];
        } else {
            $response = ["success" => false, "data" => "Session expired."];
        }
    } else {
        $response = ["success" => false, "data" => "Session expired."];
    }

    echo json_encode($response);
?>