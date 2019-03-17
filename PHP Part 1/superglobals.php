<?php
    /*
        The PHP superglobal variables are:
            $GLOBALS - it is used to access global variables from anywhere in the PHP script.
            $_SERVER - holds information about headers, paths, and script locations.
            $_REQUEST - it is used to collect data after submitting an HTML form.
            $_POST - it is widely used to collect form data after submitting an HTML form with method="post". $_POST is also widely used to pass variables.
            $_GET - can also be used to collect form data after submitting an HTML form with method="get". $_GET can also collect data sent in the URL.
            $_FILES - variables containing information about uploaded files.
            $_ENV - PHP environment variables (e.g, $_ENV['HTTP_HOST'] returns the name of the host server. Which environment variables are available depends on the specific server setup and configuration.
            $_COOKIE - stores the data of the created cookies
            $_SESSION - stires the data of the created session
    */

    //setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
    setcookie('user', 'george', time() * 3600, '/', '', false, true); 
    echo "User Cookie: " . $_COOKIE['user']; // "User Cookie: george
    // Delete cookie
    //setcookie('user', 'george', time() - 3600, '/', '', false, true); 
    echo "<br/>";
    echo "<br/>";
    
    print_r($_SERVER);

    echo "<br/>";
    echo "<br/>";
    echo "<br/>";

    print_r($GLOBALS);

    echo "<br/>";
    echo "<br/>";
    echo "<br/>"; 
?>