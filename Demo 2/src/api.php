<?php
    require_once "user.php";

    session_start();

    header("Content-type: application/json");

    $requestUri = $_SERVER["REQUEST_URI"];

    if(preg_match("#login$#", $requestUri)){
        login();
    } elseif(preg_match("#dashboard$#", $requestUri)) {
        dashboard();
    } elseif(preg_match("#logout$#", $requestUri)) {
        logout();
    } else {
        echo "Не е намерен такъв URL.";
    }

    function login() {
        $errors = [];

        if($_POST) {
            $data = json_decode($_POST["data"], true);

            if(!$data["userName"]) {
                $errors[] = "Моля, въведете потребителско име.";
            }

            if(!$data["password"]) {
                $errors[] = "Моля, въведете парола.";
            }

            if($data["userName"] && $data["password"]) {
                $user = new User($data["userName"], $data["password"]);
                $isValid = $user->isValid();

                if($isValid["success"]){
                    $_SESSION["userName"] = $user->getUsername();
                    $_SESSION["password"] = $user->getPassword();
                } else {
                    $errors[] = $isValid["error"];
                }
            }
            
            $response;

            if($errors) {
                $response = ["success" => false, "data" => $errors];
            } else {
                $response = ["success" => true];
            }
            echo json_encode($response);
        } else {
            echo "Грешка...";
        }
    }

    function dashboard() {
        if($_SESSION) {
            if($_SESSION["userName"]) {
                $response = ["success" => true, "data" => $_SESSION["userName"]];
            } else {
                $response = ["success" => false, "data" => "Неоторизиран достъп."];
            }
        } else {
            $response = ["success" => false, "data" => "Вашата сесия е изтекла."];
        }
    
        echo json_encode($response);
    }

    function logout() {
        if($_SESSION){
            session_unset();
            session_destroy();
    
            echo "Logged out";
        } else {
            echo "Грешка...";
        }
    }
?>